<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;

// for registration
Route::get('/signup',[UserController::class,'showsignup'])->middleware('access');
Route::post('/postsignup',[UserController::class,'postSignUp'])->name('signup');

//for login
Route::get('/',[UserController::class,'showsignin'])->name('showsignin')->middleware('access');
Route::post('/postsignin',[UserController::class,'postSignIn'])->name('signin');


Route::middleware('auth')->group(function () {
    //for dashboard
    Route::get('/dashboard',[PostController::class,'getdashboard'])->name('dashboard');

    //for post creation
    Route::post('/createpost',[PostController::class,'postCreatePost'])->name('post.create');

    //for post deletion
    Route::get('/postdelete/{post_id}',[PostController::class,'getDeletePost'])->name('post.delete');

    //for account view
    Route::get('/account',[UserController::class,'getAccount'])->name('account');

    //for editaccount view
    Route::get('/editaccount',[UserController::class,'editaccount'])->name('editaccount');


     //for account update
     Route::post('/updateaccount',[UserController::class,'postSaveAccount'])->name('account.save');

    //for edit
    Route::post('/edit',[PostController::class,'postEditPost'])->name('edit');



});


//for logout
Route::get('/logout',[UserController::class,'getLogout'])->name('logout');




//for final like and dislike
Route::get('/like/{id}',[PostController::class,'save_like'])->name('reply.like');
Route::get('/dislike/{id}',[PostController::class,'save_dislike'])->name('reply.dislike');
