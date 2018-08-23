<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Auth::routes();
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/', 'FrontPageController@checkCookie');
Route::get('/home', 'FrontPageController@checkCookie');
Route::get('/welcome', 'FrontPageController@welcome');
Route::patch('/frontpage/{id}' , 'FrontPageController@update');

Route::get('/profile/', 'ProfileController@dashboard');
Route::get('/admin/', 'ProfileController@admin');
Route::get('/organizer/', 'ProfileController@organizer');
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

Route::get('/games/new' , 'GameController@create');
Route::post('/games/new' , 'GameController@store');
Route::post('/game/{id}/copy' , 'GameController@copy');
Route::get('/profile/game/{id}' , 'GameController@show');
Route::get('/profile/game/{id}/edit' , 'GameController@edit');
Route::delete('/profile/game/{id}', 'GameController@destroy');
Route::patch('/profile/game/{id}' , 'GameController@update');

// are these both necessary?
Route::get('/posts/category/{id}' , 'BlogPostController@categoryIndex');
Route::get('/posts/categories' , 'BlogCategoryController@index');

Route::get('/calendar/convention/' , 'Calendar\ConventionController@showActive');
Route::get('/calendar/convention/new' , 'Calendar\ConventionController@create');
Route::post('/calendar/convention/new' , 'Calendar\ConventionController@store');
Route::delete('/calendar/convention/{id}' , 'Calendar\ConventionController@destroy');

Route::get('/calendar/convention/attendees' , 'Calendar\ConventionController@Attendees');
Route::post('/calendar/convention/attendees' , 'Calendar\ConventionController@storeAttendees');

Route::get('/calendar/convention/sessions/{id}' , 'Calendar\GameSessionController@userCalendar');
Route::get('/calendar/convention/session/{id}/edit' , 'Calendar\GameSessionController@setGameSession');
Route::post('/calendar/convention/session/save' , 'Calendar\GameSessionController@updateUserGameSession');
Route::get('/calendar/convention/timeslot/game/{id}' , 'Calendar\GameSessionController@show');

Route::get('/calendar/convention/game/submit' , 'Calendar\ConventionController@submitGame');
Route::post('/calendar/convention/game/submit' , 'Calendar\ConventionController@submit');

Route::get('/calendar/convention/timeslot/{id}' , 'Calendar\CalendarController@show');
Route::get('/calendar/convention/{id}/timeslots' , 'Calendar\TimeslotController@manage');
Route::get('/calendar/convention/{id}/timeslot/new' , 'Calendar\TimeslotController@add');
Route::get('/calendar/convention/timeslot/{id}/edit' , 'Calendar\TimeslotController@edit');
Route::post('/calendar/convention/timeslot/store' , 'Calendar\TimeslotController@store');

Route::delete('/calendar/convention/timeslot/{id}/', 'Calendar\TimeslotController@destroy');
Route::patch('/calendar/convention/timeslot/{id}/' , 'Calendar\TimeslotController@update');

Route::get('/calendar/convention/submissions/{id}' , 'Calendar\ConventionController@submissions');
Route::delete('/calendar/convention/submission/{id}', 'Calendar\ConventionController@rejectSubmission');
Route::post('/calendar/convention/submission', 'Calendar\ConventionController@acceptSubmission');

Route::get('/calendar/convention/{id}' , 'Calendar\ConventionController@show');
Route::get('/calendar/conventions' , 'Calendar\ConventionController@index');