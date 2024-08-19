<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
                $name = sprintf("%s.%s", Str::uuid()->toString(), $input['avatar']->extension());
                $filepath = Storage::disk("public")->putFileAs("users", $input['avatar'], $name);
            } else {
                $filepath = $user->avatar;
            }

            $update = [
                'first_name' => $input['first_name'] ?? $user->first_name,
                'last_name' => $input['last_name'] ?? $user->last_name,
                'avatar' => $filepath,
            ];

            $user->update($update);

            Alert::toast('Profile updated successfully!', 'success');
        } catch (\Exception $e) {
            Log::error($e);

            Alert::toast('Profile updation failed!', 'error');
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
