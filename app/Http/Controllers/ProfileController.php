<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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
  public function edit(Request $request)
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
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'email' => 'required|email|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = $request->user();

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('user_images', 'public');
        $user->image = $imagePath;
    }

    $user->name = $request->name;
    $user->address = $request->address;
    $user->email = $request->email;
    $user->save();

      return back()->with('status', 'profile-updated');
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

        return Redirect::to('/register'); // Redirect to register page after account deletion
    }
    
}
