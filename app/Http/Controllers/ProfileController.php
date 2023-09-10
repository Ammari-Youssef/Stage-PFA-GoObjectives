<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('profile.show', ['user' => auth()->user()]);
    }



    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => [
                'required', 'string', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($request->only('firstname', 'lastname', 'username', 'email'));

        return redirect()->route('profile.show')->with('success', 'Profile information updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Check if the old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => ['The provided old password is incorrect.'],
            ]);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->new_password),
            'real_password' => $request->new_password,
        ]);

        // Redirect back with a success message
        return redirect()->route('profile.show')->with('success', 'Password updated successfully.');
    }


    public function destroy()
    {
        $user = auth()->user();
        auth()->logout();
        $user->delete();

        return redirect()->route('welcome')->with('success', 'Account deleted successfully.');
    }
}
