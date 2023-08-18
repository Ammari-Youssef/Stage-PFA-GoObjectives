<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

   

    public function login()
    {
        return view('auth.login');
    }
    public function signup()
    {
        return view('auth.signup');
    }

    public function home(){
        return view('home');
    }

    public function dologin(LoginRequest $req){

        $credentials = $req->validated();
        // dd($credentials); //les données qui sont validées vont etre affichées

        // dd(Auth::attempt($credentials));

        if(Auth::attempt($credentials)){
            $req->session()->regenerate();
          return redirect()->intended(route('homepage')); //redirect user to the page he tried to access else go to homepage
        }
        return to_route('auth.login')->withErrors([
            "email_pwd" => "Email or password are invalid ."
        ])->onlyInput('email_pwd');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        $request->session()->invalidate(); // Invalidate the user's session

        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect('/'); // Redirect to the home page after logout
    }

}
