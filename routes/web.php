<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [NavigationController::class, "welcome"])->name('welcome')->middleware('guest');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'dologin']);

Route::get('/signup', [AuthController::class, 'showSignUpForm'])->name('auth.signup');
Route::post('/signup', [AuthController::class, 'dosignUp'])->name('auth.signup');

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::middleware(['auth'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('profile.delete');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('homepage')->middleware('auth');
