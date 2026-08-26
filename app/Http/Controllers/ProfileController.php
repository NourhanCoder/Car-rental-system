<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
    public function update(ProfileUpdateRequest $request, ImageUploadService $imageService): RedirectResponse
    {
        $user = $request->user();

        // 1. Fill the checked data (name, email)
        $user->fill($request->validated());

        // 2. If the email changes, reset the verification field to null
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }


        // 3. Check if the user uploaded a new image file in the request
        if($request->hasFile('image')){
            $oldImage = $user->getOriginal('image') ?? $user->image;

            $user->image = $imageService->uploadImage(
                file: $request->file('image'),
                folder: 'users',
                oldImagePath: $oldImage
            );
        }

        $user->save();

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
