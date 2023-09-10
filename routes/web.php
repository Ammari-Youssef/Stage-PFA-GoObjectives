<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MotiveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ResultController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'dologin']);

    Route::get('/signup', [AuthController::class, 'showSignUpForm'])->name('auth.signup');
    Route::post('/signup', [AuthController::class, 'dosignUp'])->name('auth.signup');
});

Route::middleware(['web','auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('profile.delete');
    });

    //App
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/progress', ProgressController::class);
    Route::post('/progress/update_single_rating', [ProgressController::class, 'update_single_rating'])->name('progress.update_single_rating');

    Route::resource('/objective', ObjectiveController::class);
    Route::post('objective/{objective}/toggleStatus', 'ObjectiveController@toggleStatus')->name('objective.toggleStatus');

    Route::resource('/task', TaskController::class);
    Route::resource('/motive', MotiveController::class);
    Route::resource('/result', ResultController::class);
});
