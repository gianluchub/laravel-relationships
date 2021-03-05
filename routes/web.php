<?php

use Illuminate\Support\Facades\Route;

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
// CRUD (non protetta da autenticazione)
Route::resource('posts', 'PostController');

// rotte pubbliche
Route::get('/blog', 'BlogController@index')->name('blog');
Route::get('/blog/{slug}', 'BlogController@show')->name('post');
Route::get('/blog/tags/{slug}', 'BlogController@tag')->name('tag');

Route::post('/blog/{id}/comment', 'BlogController@addComment')->name('add-comment');

// redirect al blog, in mancanza di una home page
Route::redirect('/', '/blog');