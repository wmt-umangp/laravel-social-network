<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\FileFormRequest;
use Session;

class UserController extends Controller
{
    public function showsignup(){
        return view('signup');
    }
    public function showsignin(){
        return view('login');
    }
    public function postSignUp(RegisterFormRequest $request){
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
    public function postSignIn(LoginFormRequest $req){
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
    public function editAccount(){
        return view('editaccount',['user'=>Auth::user()]);
    }

    public function postSaveAccount(FileFormRequest $request){
            $request->validated();
            $user=Auth::user();
            $files = $request->file('image');
            // $folder = public_path('../../../../images/' . 'User-'.Auth::user()->id . '/');
            $folder='public/images/User-'.Auth::user()->id.'/';
            $filename=$files->getClientOriginalName();


            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            if (!empty($files)) {
                $files->storeAs($folder,$filename);
                $files->move('uploads/images/User-'.Auth::user()->id.'/',$filename);
                $user->name=$request->input('name');
                $user->image=$files->getClientOriginalName();
                $user->update();
            }

            return redirect()->route('account');
        }
}
