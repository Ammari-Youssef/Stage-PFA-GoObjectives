<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;

class AuthController extends Controller
{



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('dashboard');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showSignUpForm()
    {
        return view('auth.signup');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function dologin(LoginRequest $req)
    {
        $credentials = $req->validated();

        // dd($credentials); //les données qui sont validées vont etre affichées

        // dd(Auth::attempt($credentials));

        // Retrieve the value of the "Remember Me" checkbox from the request
        $remember = $req->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $req->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->route('auth.login')
            ->withErrors(["email_pwd" => "Email or password are invalid."])
            ->withInput($req->only('email', 'remember')); // Retain the email and "Remember Me" status
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        $request->session()->invalidate(); // Invalidate the user's session

        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect('/'); // Redirect to the welcome page after logout
    }

    public function dosignUp(SignUpRequest $req)
    {
        $validatedData = $req->validated();

        // Create a new user record in the database
        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($validatedData['password']),
            'real_password' => $validatedData['password'],
            'remember_token' => Str::random(10),
        ]);

        // Log in the user after successful signup
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
