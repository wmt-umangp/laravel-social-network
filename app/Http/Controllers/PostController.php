<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Like;

class PostController extends Controller
{
    public function getdashboard(){
        $posts=Post::orderBy('created_at','desc')->get();
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
        // dd($request->user());
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
    public function postLikePost(Request $request){
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
}
