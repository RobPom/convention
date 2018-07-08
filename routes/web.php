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

Auth::routes();
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/', 'PagesController@checkCookie');
Route::get('/home', 'PagesController@home');
Route::get('/welcome', 'PagesController@welcome');

Route::get('/profile/dashboard', 'ProfileController@dashboard');
Route::get('/profile/show/{id}', 'ProfileController@show');

Route::get('/profile/{id}/edit', 'ProfileController@edit');
Route::put('/profile/{id}', 'ProfileController@update');
Route::get('/profiles/all', 'ProfileController@index');

Route::get('/users/add', 'ContactController@add');
Route::post('/users/add', 'ContactController@store');
Route::delete('/users/{id}', 'ContactController@destroy');

Route::get('/post/{id}' , 'BlogPostController@show');
Route::get('/posts' , 'BlogPostController@index');
Route::get('/posts/new' , 'BlogPostController@create');
Route::get('/posts/latest' , 'BlogPostController@latest');
Route::post('/post' , 'BlogPostController@store');

// are these both necessary?
Route::get('/posts/category/{id}' , 'BlogPostController@categoryIndex');
Route::get('/posts/categories' , 'BlogCategoryController@index');
