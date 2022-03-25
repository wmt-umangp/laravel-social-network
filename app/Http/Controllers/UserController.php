<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;

class UserController extends Controller
{
    public function showsignup(){
        return view('signup');
    }
    public function showsignin(){
        return view('login');
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
        $name=$request->input('name');
        $email=$request->input('email');
        $password=Hash::make($request->input('password'));

        $user=new User;

        $user->name=$name;
        $user->email=$email;
        $user->password=$password;
        $user->save();

        // Auth::login($user);
        return redirect()->route('dashboard')->with('rmsg','Great! You have Successfully loggedin');;
    }
    public function postSignIn(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ],[
            'email.required' => 'Please Enter Email',
            'email.email'=>'Please Enter Valid Email',
            'password.required' => 'Please Enter Password',
            'password.min'=>'Password must be 6 character long',
        ]);
        $email=$req->input('email');
        $password=$req->input('password');
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect()->route('dashboard')->with('logined','You have Successfully loggedin');;
        }
        return redirect()->back();
    }

    public function getdashboard(){
        return view('dashboard');
    }
}
