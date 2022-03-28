<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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
Route::get('/',[UserController::class,'showsignin'])->name('showsignin');
Route::post('/postsignin',[UserController::class,'postSignIn'])->name('signin');

//for dashboard
Route::get('/dashboard',[PostController::class,'getdashboard'])->name('dashboard')->middleware('auth');


//for post creation
Route::post('/createpost',[PostController::class,'postCreatePost'])->name('post.create')->middleware('auth');

//for post deletion
Route::get('/postdelete/{post_id}',[PostController::class,'getDeletePost'])->name('post.delete')->middleware('auth');


//for logout
Route::get('/logout',[UserController::class,'getLogout'])->name('logout');
