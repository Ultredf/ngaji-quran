<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = User::findOrFail($request->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');

            if ($file) {
                $fileName = Str::random(80) . '.' . $file->getClientOriginalExtension();
                $filePath = 'assets/profile/' . $fileName;

                // Move the file to the designated folder
                $file->move(public_path('assets/profile/'), $fileName);
            } else {
                return back()->with('error', 'File upload failed');
            }
        } else {
            $filePath = $user->foto_profile;
        }
        $user->foto_profile = $filePath;

        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }
        $user->save();


        // $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
