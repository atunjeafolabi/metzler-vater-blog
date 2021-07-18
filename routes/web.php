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

Auth::routes();

Route::get('/posts/create', 'PostController@showCreateForm')->name('create-form');
Route::get('/posts/{slug}', 'PostController@show')->name('post');
Route::get('/posts/recent', 'PostController@recentPosts')->name('recent-posts');
Route::get('/posts', 'PostController@index')->name('index');
Route::post('/posts', 'PostController@create')->name('create-post');
Route::get('/posts/{slug}/update', 'PostController@showUpdateForm')->name('update-form');
Route::put('/posts/{slug}', 'PostController@update')->name('update-post');
Route::delete('/posts/{slug}', 'PostController@delete')->name('delete-post');
