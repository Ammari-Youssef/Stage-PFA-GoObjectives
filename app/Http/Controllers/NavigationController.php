<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavigationController extends Controller
{
    //

    public function login(){
        return view('auth.login');
    }
    public function signup(){
        return view('auth.signup');
    }
    public function welcome(){
        return view('welcome');
    }

    public function home(){
        return view('dashboard');
    }
   

    
}
