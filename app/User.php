<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Auth;
use App\Post;
use App\Comments;
use App\Notifications\MailResetPasswordToken;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'userphoto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function comments(){
        return $this->hasMany(Comments::class);
    }

    // public function addComment($comment_body){
    //     return $this->comments()->create(['comment_body'=>$comment_body]);
    // }
    public function createPost($post_title, $post_body)
    {
        return $this->posts()->create(['post_title' => $post_title, 'post_body' => $post_body, 'user_id' => $this->user_id]);
    }
}
