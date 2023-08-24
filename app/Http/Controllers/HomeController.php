<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        // dd(Auth::user());
        $domainLabels = [
            'Health & fitness',   'Relationships',   'Spirituality',   'Environnement',   'FreeTime',   'Work & business',   'Feelings',     'Money & finance',
        ];

        return view('dashboard', compact('domainLabels'));
    }
}
