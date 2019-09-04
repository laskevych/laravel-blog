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

Route::get('/', 'HomeController@home')->name('home');


Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/secret', 'HomeController@secret')
        ->name('secret')
        ->middleware('can:home.secret');

Route::get('/about', 'HomeController@about')->name('about');

Route::get('/docs', 'HomeController@docs')->name('docs');

Route::resource('posts', 'PostController');

Route::patch('/posts/{post}/restore', 'PostController@restore')->name('posts.restore');

Route::get('/posts/tag/{tag}', 'PostTagController@index')->name('posts.tags.index');

Route::resource('posts.comments', 'PostCommentController')->only(['store', 'destroy']);

Route::resource('users', 'UserController')->only(['show', 'edit', 'update', 'index']);

Route::resource('users.comments', 'UserCommentController')->only(['store', 'destroy']);

Auth::routes();

// Testing emails
Route::get('mailable', function() {
        $comment = App\Comment::find(1);
        return new App\Mail\CommentPostedMarkdown($comment);
});