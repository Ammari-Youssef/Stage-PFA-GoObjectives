<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


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

    public function updatePassword(EditPasswordRequest $request)
    {
        $user = auth()->user();

        

        $user->update([
            'password' => Hash::make($request->input('new_password')),
            'real_password' => $request->input('new_password'),
        ]);

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
