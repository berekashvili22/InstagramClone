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


Auth::routes(['verify' => true]);

Route::post('follow/{user}', 'FollowsController@store');

Route::get('/', 'PostController@index')->name('posts.index');
Route::get('/p/create', 'PostController@create')->name('posts.create');
Route::post('/p', 'PostController@store')->name('posts.store');

Route::post('/p/comment', 'CommentsController@store')->name('comments.create');

Route::get('/p/{post}', 'PostController@show')->name('posts.show');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
