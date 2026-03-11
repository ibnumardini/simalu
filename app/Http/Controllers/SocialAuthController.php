<?php

namespace App\Http\Controllers;

use App\Constants\RBAC;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialAuthController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable) {
            return redirect()->route('login')->withErrors([
                'email' => __('auth.google_login_failed'),
            ]);
        }

        $googleId = $googleUser->getId();
        $email = $googleUser->getEmail();
        $googleAvatar = $googleUser->getAvatar();
        $emailVerified = $this->isGoogleEmailVerified($googleUser->user ?? []);

        if (!$email) {
            return redirect()->route('login')->withErrors([
                'email' => __('auth.google_email_missing'),
            ]);
        }

        $user = User::where('google_id', $googleId)->first();

        if (!$user) {
            if (!$emailVerified) {
                return redirect()->route('login')->withErrors([
                    'email' => __('auth.google_email_not_verified'),
                ]);
            }

            $user = User::where('email', $email)->first();
        }

        if (!$user) {
            [$firstName, $lastName] = $this->splitName($googleUser->getName());

            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'avatar' => $this->storeGoogleAvatar($googleAvatar),
                'email' => $email,
                'password' => Hash::make(Str::random(40)),
                'google_id' => $googleId,
                'email_verified_at' => Carbon::now(),
            ]);

            $user->assignRole(RBAC::ROLE_USER);
        } else {
            if (!$user->google_id) {
                $user->google_id = $googleId;
            }

            if (!$user->email_verified_at) {
                $user->email_verified_at = Carbon::now();
            }

            if (!$user->avatar) {
                $user->avatar = $this->storeGoogleAvatar($googleAvatar);
            }

            $user->save();

            if (!$user->hasAnyRole()) {
                $user->assignRole(RBAC::ROLE_USER);
            }
        }

        Auth::login($user, true);

        return redirect()->intended(route('dashboard'));
    }

    private function splitName(?string $name): array
    {
        if (!$name) {
            return ['Google', 'User'];
        }

        $normalizedName = preg_replace('/\s+/', ' ', trim($name));

        if (!$normalizedName) {
            return ['Google', 'User'];
        }

        $parts = explode(' ', $normalizedName, 2);

        return [
            $parts[0],
            $parts[1] ?? '-',
        ];
    }

    private function isGoogleEmailVerified(array $rawUser): bool
    {
        if (array_key_exists('verified_email', $rawUser)) {
            return (bool) $rawUser['verified_email'];
        }

        if (array_key_exists('email_verified', $rawUser)) {
            return (bool) $rawUser['email_verified'];
        }

        return true;
    }

    private function storeGoogleAvatar(?string $avatarUrl): ?string
    {
        if (!$avatarUrl) {
            return null;
        }

        try {
            $response = Http::timeout(10)->get($avatarUrl);

            if (! $response->ok()) {
                return null;
            }

            $extension = $this->resolveAvatarExtension((string) $response->header('Content-Type'), $avatarUrl);

            if (! $extension) {
                return null;
            }

            $path = sprintf('users/%s.%s', Str::uuid()->toString(), $extension);
            Storage::disk('public')->put($path, $response->body());

            return $path;
        } catch (Throwable $exception) {
            Log::warning('Failed to fetch Google avatar.', [
                'avatar_url' => $avatarUrl,
                'error' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    private function resolveAvatarExtension(string $contentType, string $avatarUrl): ?string
    {
        $mime = strtolower(trim(explode(';', $contentType)[0] ?? ''));

        $map = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
        ];

        if (isset($map[$mime])) {
            return $map[$mime];
        }

        $path = parse_url($avatarUrl, PHP_URL_PATH);
        $extension = strtolower(pathinfo((string) $path, PATHINFO_EXTENSION));

        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
            return $extension === 'jpeg' ? 'jpg' : $extension;
        }

        return null;
    }
}
