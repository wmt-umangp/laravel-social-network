<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Like;
use Session;

class PostController extends Controller
{
    public function getdashboard(){
        $posts=Post::orderBy('created_at','desc')->paginate(3);
        return view('dashboard',['posts'=>$posts]);
    }
    public function postCreatePost(Request $request){
        $request->validate([
            'body'=>'required|max:1000'
        ],[
            'body.required'=>'Please Enter Text in Field!!',
            'body.max'=>'maximum 1000 character allowed!!',
        ]);
        $post=new Post;
        $post->body=$request->input('body');
        $message="There was an error while creating post";
        if($request->user()->posts()->save($post)){
            $message="Post Created Successfully!!";
        }
        return redirect()->route('dashboard')->with(['message'=>$message]);
    }

    public function getDeletePost($post_id){
        $post=Post::where('id',$post_id)->first();
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message'=>'Successfully Deleted!!']);
    }
    public function postEditPost(Request $request){
        $request->validate([
            'body'=>'required'
        ],[
            'body.required'=>'Please Enter Text'
        ]);
        $post=Post::find($request['postId']);
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->body=$request['body'];
        $post->update();
        return response()->json(['new-body'=>$post->body],200);
    }
    // Save Likes
    public function save_like(Request $request,$id){
        $like= new Like;
        $like->post_id=$id;
        $like->user_id=Auth::id();
        $like->like=1;
        $like->save();
        Session::flash('success','you liked the post');
        return redirect()->back();
    }
    //delete desilikes
    public function save_dislike($id){
        $like=Like::where('post_id',$id)->where('user_id', Auth::id())->first();
        $like->delete();
        Session::flash('success','You Disliked The Post');
        return redirect()->back();
    }
}
