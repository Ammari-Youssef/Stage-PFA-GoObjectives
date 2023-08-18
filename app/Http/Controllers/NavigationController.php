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
        return view('home');
    }
    public function test(){
        $ppl= [
            ["name"=>"ysf","height"=>"175", "age"=>"22"],
            ["name"=>"rcd","height"=>"185","age"=> "20"],
            ["name"=>"ch","height"=>"165", "age"=>"17"],
        ];
        $data=["22","laravel",'zozo'];
        return view('test',compact('ppl' , 'data'));

    
    }

    
}
