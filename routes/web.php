<?php

use App\Http\Middleware\IsAdmin;
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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/posts/create', 'PostController@showCreateForm')->name('create-post-form');
    Route::post('/posts', 'PostController@create')->name('create-post');
    Route::get('/posts/{slug}/update', 'PostController@showUpdateForm')->name('update-post-form');
    Route::put('/posts/{slug}', 'PostController@update')->name('update-post');
    Route::delete('/posts/{slug}', 'PostController@delete')->name('delete-post');

    Route::middleware([IsAdmin::class])->group(function () {
        Route::get('/users/create', 'UserController@showCreateForm')
             ->name('create-user-form');
        Route::get('/users', 'UserController@index')->name('users');
        Route::post('/users', 'UserController@create')->name('create-user');
        Route::delete('/users/{id}', 'UserController@delete')
             ->name('delete-user');
    });

    Route::get('/users/{id}', 'UserController@show')->name('user');
    Route::get('/users/{id}/update', 'UserController@showUpdateForm')
         ->name('update-user-form');
    Route::put('/users/{id}', 'UserController@update')->name('update-user');

    // Routes for Comments
    Route::post('/comments', 'CommentController@create')->name('create-comment');
});

Route::get('/', 'PostController@index')->name('index');
Route::get('/posts/{slug}', 'PostController@show')->name('post');
