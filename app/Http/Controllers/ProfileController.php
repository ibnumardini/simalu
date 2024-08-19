<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return view('dashboard.pages.settings.profiles.index', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5120'],
        ]);

        try {
            $user = User::findOrFail(Auth::id());

            if ($request->hasFile('avatar')) {
                $storage = Storage::disk('public');

                $name = sprintf("%s.%s", Str::uuid()->toString(), $input['avatar']->extension());
                $filepath = $storage->putFileAs("users", $input['avatar'], $name);

                if ($user->avatar) {
                    $storage->delete($user->avatar);
                }
            } else {
                $filepath = $user->avatar;
            }

            $update = [
                'first_name' => $input['first_name'] ?? $user->first_name,
                'last_name' => $input['last_name'] ?? $user->last_name,
                'avatar' => $filepath,
            ];

            $user->update($update);

            Alert::toast('Profile updation successfully!', 'success');
        } catch (\Exception $e) {
            Log::error($e);

            Alert::toast('Profile updation failed!', 'error');
        }

        return back();
    }

    /**
     * Show the form for update password.
     */
    public function changePassword()
    {
        return view('dashboard.pages.settings.profiles.change-password');
    }

    /**
     * Update the user password.
     */
    public function updatePassword(Request $request)
    {
        $input = $request->validate([
            'current_password' => ['required', 'string', 'min:6', 'max:255'],
            'password' => ['required', 'string', 'confirmed', 'min:6', 'max:255', 'different:current_password'],
        ]);

        try {
            $user = User::findOrFail(Auth::id());

            if (!Hash::check($input['current_password'], $user->password)) {
                throw ValidationException::withMessages(['current_password' => 'Current password is invalid']);
            }

            $user->update([
                'password' => Hash::make($input['password']),
            ]);

            Alert::toast('User password change successful!', 'success');
        } catch (\Exception $e) {
            Log::error($e);

            Alert::toast('User password change failed: ' . $e->getMessage(), 'error');
        }

        return back();
    }
}
