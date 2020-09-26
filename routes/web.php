<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('layouts.app');})->name("home")->middleware('auth','verified');

Auth::routes(['verify' => true]);




Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit')->middleware('auth','verified');//edit
Route::put('/users/{id}', 'UserController@update')->name('users.update')->middleware('auth','verified');//edit
Route::get('/users/{id}', 'UserController@show')->name('users.show')->middleware('auth','verified');//profile


Route::get('/follows/{id}', 'FollowController@followU')->name('follows.follow')->middleware('auth','verified');
Route::get('/follows/follower/{id}', 'FollowController@follower')->name('follows.follower')->middleware('auth','verified');
Route::get('/follows/following/{id}', 'FollowController@following')->name('follows.following')->middleware('auth','verified');//following


Route::get('/saves', 'SaveController@index')->name('saves.index')->middleware('auth','verified');//save List
Route::get('/saves/{id}', 'SaveController@saved')->name('saves.saved')->middleware('auth','verified');//remove like


Route::get('/posts/create', 'PostController@create')->name('posts.create')->middleware('auth','verified');//create post
Route::post('/posts', 'PostController@store')->name('posts.store')->middleware('auth','verified');
Route::get('/posts/{id}/edit', 'PostController@edit')->name('posts.edit')->middleware('auth');
Route::put('/posts/{id}', 'PostController@update')->name('posts.update')->middleware('auth');
Route::delete('/posts/{id}', 'PostController@destroy')->name('posts.destroy')->middleware('auth','verified');
Route::get('/posts/{id}', 'PostController@show')->name('posts.show')->middleware('auth','verified');//post


Route::post('/comments', 'CommentController@store')->name('comments.store')->middleware('auth','verified')->middleware('auth','verified');//

Route::delete('/comments/{id}', 'CommentController@destroy')->name('comments.destroy')->middleware('auth','verified');//delete comment
Route::get('/comments/{id}', 'CommentController@show')->name('comments.show')->middleware('auth','verified');//auth comment 



Route::get('/likes/{id}', 'LikeController@liked')->name('likes.liked')->middleware('auth','verified');//remove like


Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('register/{provider}', 'Auth\RegisterController@redirectToProvider')->name('social.register');
Route::get('register/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth','verified');

Route::post('/search','SearchController@index')->name('search.index')->middleware('auth','verified');

Route::fallback(function() {
    return 'This page is not avialable now';
});

