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

Route::get('/', 'FrontPageController@checkCookie');
Route::get('/home', 'FrontPageController@home');
Route::get('/welcome', 'FrontPageController@welcome');

Route::get('/profile/dashboard', 'ProfileController@dashboard');
Route::get('/profile/show/{id}', 'ProfileController@show');

Route::get('/profile/{id}/edit', 'ProfileController@edit');
Route::put('/profile/{id}', 'ProfileController@update');
Route::get('/profiles/all', 'ProfileController@index');

Route::get('/users/add', 'ContactController@add');
Route::post('/users/add', 'ContactController@store');
Route::delete('/users/{id}', 'ContactController@destroy');

Route::get('/post/{id}' , 'BlogPostController@show');
Route::delete('/post/{id}', 'BlogPostController@destroy');
Route::get('/post/{id}/edit' , 'BlogPostController@edit');
Route::patch('/post/{id}' , 'BlogPostController@update');
Route::patch('/post/{id}/publish' , 'BlogPostController@publish');

Route::get('/posts' , 'BlogPostController@index');
Route::get('/posts/new' , 'BlogPostController@create');
Route::get('/posts/latest' , 'BlogPostController@latest');
Route::post('/post' , 'BlogPostController@store');

Route::get('/game/{id}' , 'GameController@show');

// are these both necessary?
Route::get('/posts/category/{id}' , 'BlogPostController@categoryIndex');
Route::get('/posts/categories' , 'BlogCategoryController@index');

//dev - calendar
Route::get('/calendar/convention/' , 'Calendar\ConventionController@show');
Route::get('/calendar/convention/timeslot/{id}' , 'Calendar\CalendarController@show');
Route::get('/calendar/convention/gamesession/{id}' , 'Calendar\GameSessionController@show');

//Route::get('/calendar/timeslots' , 'Calendar\CalendarController@index');
//Route::get('/calendar/timeslot/{id}' , 'Calendar\CalendarController@show');
//Route::get('/session/game/{id}' , 'Calendar\GameSessionController@show');