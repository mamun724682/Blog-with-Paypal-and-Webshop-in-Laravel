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

Route::get('/', 'PublicController@index')->name('welcome');
Route::get('post/{post}', 'PublicController@singlePost')->name('singlePost');
Route::get('about', 'PublicController@about')->name('about');
Route::get('contact', 'PublicController@contact')->name('contact');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

// User
Route::group(['prefix' => 'user'], function() {
    Route::get('/dashboard', 'UserController@dashboard')->name('userDashboard');

    Route::get('/comments', 'UserController@comments')->name('userComments');
    	Route::post('/new-comment', 'UserController@newComment')->name('newComment');
    	Route::post('/comment/{id}/delete', 'UserController@commentDelete')->name('commentDelete');

    Route::get('/profile', 'UserController@profile')->name('userProfile');
    Route::post('/profile', 'UserController@profilePost')->name('userProfilePost');
});

// Author
Route::group(['prefix' => 'author'], function() {
    Route::get('/dashboard', 'AuthorController@dashboard')->name('authorDashboard');

    Route::get('/posts', 'AuthorController@posts')->name('authorPosts');
    Route::get('/post/new', 'AuthorController@newPost')->name('newPost');
    	Route::post('/post/new', 'AuthorController@storePost')->name('storePost');
    Route::get('/post/{id}/edit', 'AuthorController@postEdit')->name('postEdit');
    	Route::post('/post/{id}/edit', 'AuthorController@updatePost')->name('updatePost');
    	Route::post('/post/{id}/delete', 'AuthorController@postDelete')->name('postDelete');

    Route::get('/comments', 'AuthorController@comments')->name('authorComments');
});

// Admin
Route::group(['prefix' => 'admin'], function() {
    Route::get('/dashboard', 'AdminController@dashboard')->name('adminDashboard');

    Route::get('/posts', 'AdminController@posts')->name('adminPosts');
    Route::get('/post/{id}/edit', 'AdminController@postEdit')->name('adminPostEdit');
    	Route::post('/post/{id}/edit', 'AdminController@updatePost')->name('adminUpdatePost');
    	Route::post('/post/{id}/delete', 'AdminController@postDelete')->name('adminPostDelete');

    Route::get('/comments', 'AdminController@comments')->name('adminComments');
    	Route::post('/comment/{id}/delete', 'AdminController@commentDelete')->name('adminCommentDelete');

    Route::get('/users', 'AdminController@users')->name('adminUsers');
    Route::get('/user/{id}/edit', 'AdminController@userEdit')->name('adminUserEdit');
    	Route::post('/user/{id}/edit', 'AdminController@updateUser')->name('adminUpdateUser');
    	Route::post('/user/{id}/delete', 'AdminController@userDelete')->name('adminUserDelete');
});