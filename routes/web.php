<?php

use App\Http\Controllers\NavigaitionController;
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

Route::get('/', [NavigaitionController::class , "welcome"] )->name('welcome');
Route::get('/login', [NavigaitionController::class , "login"] )->name('login');
Route::get('/signup', [NavigaitionController::class , "signup"] )->name('signup');
