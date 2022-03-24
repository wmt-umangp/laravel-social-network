<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserController extends Controller
{
    public function showsignup(){
        return view('signup');
    }
    public function postSignUp(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password|min:6',
        ],[
            'name.required' => 'Please Enter Name',
            'email.required' => 'Please Enter Email',
            'email.email'=>'Please Enter Valid Email',
            'email.unique'=> 'Email Already Exists!!',
            'password.required' => 'Please Enter Password',
            'password.min'=>'Password must be 6 character long',
            'cpassword.required' => 'Please Enter Confirm Password',
            'cpassword.same'=>'Confirm Password must be same as Password',
            'cpassword.min'=>'Confirm Password must be 6 character long',
        ]);
        // $name=$req->input('name');
        // $email=$req->input('email');
        // $password=Hash::make($req->input('password'));

        // $user=new User;

        // $user->name=$name;
        // $user->email=$email;
        // $user->password=$password;
        // $user->save();
    }
    public function postSignIn(Request $req){

    }
}
