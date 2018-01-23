<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comments;
use \Auth;

class Post extends Model
{
    protected $fillable = ['post_title', 'post_body', 'user_id', 'post_photo'];

    public function comments(){
        return $this->hasMany(Comments::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function addComment($comment_body){
        $user = Auth::user();
    	return $this->comments()->create(['comment_body'=>$comment_body, 'user_id' => $user->id]);
    }
}
