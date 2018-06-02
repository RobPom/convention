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
Route::get('/profile', 'ProfileController@dashboard');

Route::get('/users/add', 'ContactController@add');
Route::post('/users/add', 'ContactController@store');

