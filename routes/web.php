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

// Route::get('/', function () {
//     return view('login');
// });

// Route::get('/signup', function () {
//     return view('signup');
// });
Route::get('/signup',[UserController::class,'showsignup']);
Route::post('/postsignup',[UserController::class,'postSignUp'])->name('signup');
