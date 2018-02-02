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
    public function edit(User $user)
    {
        if($user != Auth::user())
        {
            return redirect()->route('view', ['user' => $user]);
        }

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
        //save user data, because image has already been uploaded to uploadcare.com
        $user = Auth::user();
        if(isset($request->image))
        {
            $user->user_photo = "https://ucarecdn.com/".$request->image."/";
        }
        $user->update();
        
        //validate request data
        $this->validate($request, [
            'name' => 'bail|unique:users',
            'email' => 'bail|nullable|email|unique:users',
            'password' => 'bail|confirmed'
        ]
        );

        if(isset($request->name)){
            $user->name = $request->name;
        }
        if(isset($request->email)){
            $user->email = $request->email;
        }
        if(isset($request->password)){
            $user->password = bcrypt($request->password);
        }
        if(isset($request->bio)){
            $user->bio = $request->bio;
        }

        $user->update();
        session()->flash('message', 'Your account has been updated!');

        //redirect user to profile view
        return redirect()->route('view', ['user' => User::find($user->id)]);
    }

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
        //this method would normally be called when a user is 
        //deleting their account
    }
}
