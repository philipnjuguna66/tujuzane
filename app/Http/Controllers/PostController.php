<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\User;
use App\Comments;
use Auth;
use \Storage;
use \File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request data
        $this->validate($request, [
            'post_title' => "required",
            'post_body' => 'required',
            'image' => 'mimes:jpeg,png,bmp,tiff |max:4096'
        ],
            $messages = [
                'required' => 'The :attribute field is required.',
                'mimes' => 'Only JPEG or PNG images are allowed.'
            ]
        );

        //if image is given, upload
        $file = $request->file('image');
        $filename = '';
        if($file){
            $filename = '/postsimages/'.rand(100000, 999999).'.'.$file->extension();
            Storage::put('public'.$filename, File::get($file));
        }

        //save post
        $user = Auth::user();
        if($user->posts()->create([
            'post_title' => $request->post_title,
            'post_body' => $request->post_body,
            'post_photo' => $filename
        ])){
            session()->flash('message', "Your post has been published");
        }

        return redirect()->route('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function commentOnPost(Post $post, Request $request){
        //validate comment data
        $this->validate($request, [
            'comment_body' => 'required'
        ]);

        //add comment to the post
        if($post->addComment(request('comment_body'))){
            $message = "Your comment has been added";
        }

        return redirect()->back()->with(['message' => $message]);
    }

    public function postAddComment(Request $request){
        $post = Post::find($request->postid);
        if($post->addComment($request->comment_body)){
            return "Added";
        }else{
            return "Failed";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'post_title' => "required",
            'post_body' => 'required',
            'image' => 'mimes:jpeg,png,bmp,tiff |max:4096'
        ],
            $messages = [
                'required' => 'The :attribute field is required.',
                'mimes' => 'Only JPEG or PNG images are allowed.'
            ]
        );

        //process image, if given
        $file = $request->file('image');
        if($file){
            $filename = '/postsimages/'.rand(100000, 999999).'.'.$file->extension();
            Storage::put('public'.$filename, File::get($file));
        }

        //save the post
        $post = Post::find($post->id);
        $post->post_title = $request->post_title;
        $post->post_body = $request->post_body;
        if(isset($filename))
        {
            $post->post_photo = $filename;
        }

        $post->update();

        session()->flash('message', 'Changes have been saved.');

        return redirect()->route('post', ['post' => $post]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('message', 'Post has been deleted');
        return redirect()->route('posts');
    }

    public function commentEdit(Request $request){
        $comment = Comments::find($request->id);
        $comment->comment_body = $request->comment_body;
        if($comment->update()){
            return $comment->comment_body;
        }else{
            return "Failed";
        }
        //return "request->comment_body ".$request->comment_body." Comment->comment_body ".$comment->comment_body;
    }

    public function commentDelete(Request $request){
        $comment = Comments::find($request->id);
        if($comment->delete()){
            return "Success";
        }
        return "Failed";
    }
}
