<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use \Storage;
use \File;
use \Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if($user == Auth::user()){
            $user = User::find($user->id);
        }
        return view('user.view', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $pass_confirmed = "false")
    {
        if($user != Auth::user())
        {
            return $this->show($user);
        }

        $user->pass_confirmed = $pass_confirmed;
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        //validate request data
        $this->validate($request, [
            'name' => 'bail|unique:users',
            'email' => 'bail|nullable|email|unique:users',
            'password' => 'bail|confirmed',
            'image' => 'mimes:jpeg,png,bmp,tiff |max:4096'
        ],
            $messages = [
                'required' => 'The :attribute field is required.',
                'unique' => 'That :attribute has already been taken.',
                'email' => 'Please enter a valid email address.',
                'confirmed' => 'Password confirmation does not match.',
                'mimes' => 'Only JPEG or PNG images are allowed.'
            ]
        );
        
        //upload profile image, if given
        $file = $request->file('image');
        
        if($file){
            $filename = '/userprofileimages/'.rand(100000, 999999).'.'.$file->extension();
            Storage::put('public'.$filename, File::get($file));
        }

        //save user data
        $user = Auth::user();
        if(isset($filename))
        {
            $user->user_photo = $filename;
        }
        if(isset($request->name)){
            $user->name = $request->name;
        }
        if(isset($request->email)){
            $user->email = $request->email;
        }
        if(isset($request->password)){
            $user->name = bcrypt($request->password);
        }
        if(isset($request->bio)){
            $user->bio = $request->bio;
        }

        $user->update();
        session()->flash('message', 'Your account has been updated!');

        //redirect user to profile view
        return redirect()->route('view', ['user' => User::find($user->id)]);
    }

    // public function confirmPassFirst(Request $request){
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->passwordFirst])) {
    //         //return "Authentication passed";
    //         return $this->edit(Auth::user(), "true");
    //     }else{
    //         return $this->edit(Auth::user())->withErrors([
    //             'message' => 'Wrong password'
    //         ]);
    //     }
    // }

    public function confirmPass(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return 'true';
        }else{
            return 'false';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
