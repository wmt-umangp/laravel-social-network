<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Http\Requests\signupvalidation;
use App\Http\Requests\signinvalidation;
use App\Http\Requests\filevalidation;
use Session;

class UserController extends Controller
{
    public function showsignup(){
        return view('signup');
    }
    public function showsignin(){
        return view('login');
    }
    public function postSignUp(signupvalidation $request){
        $request->validated();
        $name=$request->input('name');
        $email=$request->input('email');
        $password=Hash::make($request->input('password'));

        $user=new User;

        $user->name=$name;
        $user->email=$email;
        $user->password=$password;
        $user->save();

        Auth::login($user);
        Session::put('log',$email);
        return redirect()->route('dashboard')->with('rmsg','Great! You have Successfully loggedin');;
    }
    public function postSignIn(signinvalidation $req){
        $req->validated();
        $email=$req->input('email');
        $password=$req->input('password');
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            Session::put('log',$email);
            return redirect()->route('dashboard')->with('logined','You have Successfully loggedin');;
        }
        return redirect()->back()->with('logerror','Invalid User Credentials');
    }
    public function getLogout(){
        Auth::logout();
        session::flush();
        return redirect()->route('showsignin');
    }
    public function getAccount(){
        return view('account',['user'=>Auth::user()]);
    }
    public function postSaveAccount(filevalidation $request){
        $request->validated();
        $user=Auth::user();
        $user->name=$request->input('name');
        $user->update();
        $file=$request->file('image');
        // $extension = $file->getClientOriginalExtension();
        $filename=$request['name'].'-'.$user->id.'.jpg';
        if($file){
            Storage::disk('local')->put($filename,File::get($file));
        }
        return redirect()->route('account');
    }
    public function getUserImage($filename){
        $file= Storage::disk('local')->get($filename);
        return new Response($file,200);
    }
}
