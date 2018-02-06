<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/newlogin', function() {
//     return view('user.newview');
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'PostController@index')->name('home');
Route::get('/posts', [
	'uses' => 'PostController@index',
	'as' => 'posts'
]);

Route::get('posts/{post}/{where?}', [
	'uses' => 'PostController@show',
	'as' => 'post'
]);

Route::get("/posts/{post}/comment", [
	'uses' => 'PostController@loginToComment',
	'as' => 'login.to.comment',
	'middleware' => 'auth'
]);

Route::get('/post/create', [
	'uses' => 'PostController@create',
	'as' => 'newpost', 
	'middleware' => 'auth'
]);

Route::post('/post/create', [
	'uses' => 'PostController@store',
	'as' => 'post.create',
	'middleware' => 'auth'
]);

Route::get('posts/{post}/edit', [
	'uses' => 'PostController@edit',
	'as' => 'post.edit',
	'middleware' => 'auth'
]);

Route::post('posts/{post}/edit', [
	'uses' => 'PostController@update',
	'as' => 'post.edit.save',
	'middleware' => 'auth'
]);

Route::get('posts/{post}/delete', [
	'uses' => 'PostController@destroy',
	'as' => 'post.delete',
	'middleware' => 'auth'
]);

Route::post('posts/{post}/comment', [
	'uses' => 'PostController@commentOnPost',
	'as' => 'comment',
	'middleware' => 'auth'
]);

Route::post('posts/comment', [
	'uses' => 'PostController@postAddComment',
	'as' => 'add.comment',
	'middleware' => 'auth'
]);

Route::post('/comment/edit', [
	'uses' => 'PostController@commentEdit',
	'as' => 'edit.comment',
	'middleware' => 'auth'
]);

Route::post('/comment/delete', [
	'uses' => 'PostController@commentDelete',
	'as' => 'delete.comment',
	'middleware' => 'auth'
]);

Route::get('/users/{user}', [
	'uses' => 'UserController@show',
	'as' => 'view',
	'middleware' => 'auth'
]);

Route::get('/users/{user}/edit', [
	'uses' => 'UserController@edit',
	'as' => 'editme',
	'middleware' => 'auth'
]);

Route::post('/password/confirm', [
	'uses' => 'UserController@confirmPass',
	'as' => 'confirm.pass',
	'middleware' => 'auth'
]);

// Route::get('/confirmpassfirst', 'UserController@edit');
// Route::post('/confirmpassfirst', 'UserController@confirmPassFirst');

Route::post('user/update', [
	'uses' => 'UserController@update',
	'as' => 'update.me',
	'middleware' => 'auth'
]);