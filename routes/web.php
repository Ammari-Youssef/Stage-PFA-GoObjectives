<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [NavigationController::class , "welcome"] )->name('welcome');
// Route::get('/login', [NavigationController::class , "login"] )->name('login');
// Route::get('/signup', [NavigationController::class , "signup"] )->name('signup');
Route::get('/test', [NavigationController::class , "test"] )->name('test');

Route::middleware('guest')->group(function(){

    Route::get('/login',[AuthController::class , 'login'])->name('auth.login')->middleware('guest');
    Route::post('/login',[AuthController::class , 'dologin']);
});

Route::middleware('auth')->group(function () {

    Route::get('/logout',[AuthController::class , 'logout'])->name('auth.logout');
    
    Route::get('/home', [HomeController::class, 'index'])->name('homepage');
});

Route::get('/signup',[AuthController::class , 'signup'])->name('auth.signup');
