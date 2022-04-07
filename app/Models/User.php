<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory;
    public function posts(){
        return $this->hasMany(Post::class);
    }

    //accessor for image path
    public function getImageAttribute($image){
        $folder='public/images/User-'.Auth::user()->id.'/';
        if($image){
            if($image=='dummy-image.jpg'){
                $image=Storage::disk('local')->url('public/'.$image);
            }else{
                $image = Storage::disk('local')->url($folder.$image);
            }
        }
        return $image;
    }
}
