<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// for registration
Route::get('/signup',[UserController::class,'showsignup']);
Route::post('/postsignup',[UserController::class,'postSignUp'])->name('signup');

//for login
Route::get('/',[UserController::class,'showsignin']);
Route::post('/postsignin',[UserController::class,'postSignIn'])->name('signin');

//for dashboard
Route::get('/dashboard',[UserController::class,'getdashboard'])->name('dashboard')->middleware('auth');
