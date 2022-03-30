<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;

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

//for edit
Route::post('/edit',[PostController::class,'postEditPost'])->name('edit');


//for account view
Route::get('/account',[UserController::class,'getAccount'])->name('account');

//for account update
Route::post('/updateaccount',[UserController::class,'postSaveAccount'])->name('account.save');

//for image display
Route::get('/userimage{filename}',[UserController::class,'getUserImage'])->name('account.image');


//for like
Route::post('/like',[PostController::class,'postLikePost'])->name('like');
