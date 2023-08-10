<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigaitionController extends Controller
{
    //

    public function login(){
        return view('login');
    }
    public function signup(){
        return view('signup');
    }
    public function welcome(){
        return view('welcome');
    }
}
