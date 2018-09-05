<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

/* User, User management, profile*/
Auth::routes();
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('/profile/', 'ProfileController@dashboard');

Route::get('/admin/', 'ProfileController@admin');
Route::get('/admin/users', 'ProfileController@adminUsers');
Route::get('/admin/organizers', 'ProfileController@adminOrganizers');

Route::get('/organizer/', 'ProfileController@organizer');
Route::get('/profile/show/{id}', 'ProfileController@show');
Route::get('/profile/{id}/edit', 'ProfileController@edit');
Route::put('/profile/{id}', 'ProfileController@update');

Route::get('/profile/{id}/games', 'ProfileController@games');
Route::get('/profile/{id}/posts', 'ProfileController@posts');

Route::get('/profiles/all', 'ProfileController@index');
Route::get('/users/add', 'ContactController@add');
Route::post('/users/add', 'ContactController@store');
Route::delete('/users/{id}', 'ContactController@destroy');

/* Landing, home */
Route::get('/', 'FrontPageController@checkCookie');
Route::get('/home', 'FrontPageController@checkCookie');
Route::get('/welcome', 'FrontPageController@welcome');
Route::patch('/frontpage/{id}' , 'FrontPageController@update');

/* Blog */
Route::get('/post/{id}' , 'BlogPostController@show');
Route::delete('/post/{id}', 'BlogPostController@destroy');
Route::get('/post/{id}/edit' , 'BlogPostController@edit');
Route::patch('/post/{id}' , 'BlogPostController@update');
Route::patch('/post/{id}/publish' , 'BlogPostController@publish');
Route::get('/posts' , 'BlogPostController@index');
Route::get('/posts/new' , 'BlogPostController@create');
Route::get('/posts/latest' , 'BlogPostController@latest');
Route::post('/post' , 'BlogPostController@store');

// are these both necessary?
Route::get('/posts/category/{id}' , 'BlogPostController@categoryIndex');
Route::get('/posts/categories' , 'BlogCategoryController@index');

/* User Game */
Route::get('/games/new' , 'GameController@create');
Route::post('/games/new' , 'GameController@store');
Route::get('/profile/game/{id}' , 'GameController@show');
Route::get('/profile/game/{id}/edit' , 'GameController@edit');
Route::delete('/profile/game/{id}', 'GameController@destroy');
Route::patch('/profile/game/{id}' , 'GameController@update');

/* Convention */
Route::get('/calendar/convention/' , 'Calendar\ConventionController@showActive');
Route::get('/calendar/convention/new' , 'Calendar\ConventionController@create');
Route::post('/calendar/convention/new' , 'Calendar\ConventionController@store');
Route::delete('/calendar/convention/{id}' , 'Calendar\ConventionController@destroy');
Route::get('/calendar/convention/{id}/edit' , 'Calendar\ConventionController@edit');
Route::patch('/calendar/convention/{id}' , 'Calendar\ConventionController@update');

Route::get('/calendar/convention/{id}' , 'Calendar\ConventionController@show');
Route::get('/calendar/convention/{id}/manage' , 'Calendar\ConventionController@manage');
Route::get('/calendar/conventions' , 'Calendar\ConventionController@index');

Route::get('/calendar/convention/{id}/schedule' , 'Calendar\ConventionController@schedule');

/* Convention Schedule - Timeslots */
Route::get('/calendar/convention/timeslot/{id}' , 'Calendar\CalendarController@show');
Route::get('/calendar/convention/{id}/timeslots' , 'Calendar\TimeslotController@manage');
Route::get('/calendar/convention/{id}/timeslot/new' , 'Calendar\TimeslotController@add');
Route::get('/calendar/convention/timeslot/{id}/edit' , 'Calendar\TimeslotController@edit');
Route::post('/calendar/convention/timeslot/store' , 'Calendar\TimeslotController@store');
Route::delete('/calendar/convention/timeslot/{id}/', 'Calendar\TimeslotController@destroy');
Route::patch('/calendar/convention/timeslot/{id}/' , 'Calendar\TimeslotController@update');
//although events are timeslots, data is treated differently
Route::get('/calendar/convention/{id}/event/new' , 'Calendar\TimeslotController@addEvent');
Route::get('/calendar/convention/event/{id}/edit' , 'Calendar\TimeslotController@editEvent');
Route::post('/calendar/convention/event/store' , 'Calendar\TimeslotController@storeEvent');

/* Convention Attendees*/
Route::get('/calendar/convention/{id}/attendees' , 'Calendar\ConventionController@attendees');
Route::post('/calendar/convention/attendees' , 'Calendar\ConventionController@storeAttendees');

//new user and add to convention
Route::get('/calendar/convention/{id}/attendee/new' , 'Calendar\AttendeeController@new');
Route::post('/calendar/convention/attendee/new', 'Calendar\AttendeeController@store');
//select from exisiting users to add to convention
Route::get('/calendar/convention/{id}/attendee/add' , 'Calendar\AttendeeController@add');
Route::post('/calendar/convention/attendee/add', 'Calendar\AttendeeController@addAttendee');

//users convention schedule
Route::get('calendar/convention/{id}/attendee/schedule', 'Calendar\AttendeeController@attendeeSchedule');
//organizer view attendee games and schedule
Route::get('/calendar/convention/{convention_id}/attendee/{user_id}' , 'Calendar\AttendeeController@view');

//organizer removing attendee from convention
Route::post('/calendar/convention/attendee/remove', 'Calendar\AttendeeController@remove');

//organizer editing user calendar
Route::get('calendar/convention/attendee/{member}/timeslot/{timeslot}', 'Calendar\AttendeeController@viewAttendeeTimeslot');
Route::post('calendar/convention/attendee/{id}/add/gamesession', 'Calendar\AttendeeController@addAttendGamesession');
Route::post('calendar/convention/attendee/{id}/remove/gamesession', 'Calendar\AttendeeController@removeAttendeeGamesession');

//users editing own calendar
Route::get('calendar/convention/attendee/timeslot/{id}', 'Calendar\AttendeeController@attendeeTimeslot');
Route::post('calendar/convention/attendee/gamesession/{id}', 'Calendar\AttendeeController@attendGamesession');
Route::post('calendar/convention/attendee/gamesession/{id}/leave', 'Calendar\AttendeeController@leaveGamesession');

/* Convention Games*/
Route::get('calendar/convention/{convention_id}/attendee/{user_id}/game/new', 'GameController@createAttendeeGame');
Route::post('calendar/convention/attendee/game/store', 'GameController@storeAttendeeGame');

Route::get('calendar/convention/game/{id}/edit', 'GameController@editAttendeeGame');
Route::patch('calendar/convention/game/{id}', 'GameController@updateAttendeeGame');
//get only unscheduled games
Route::get('calendar/convention/{convention_id}/games/unscheduled', 'GameController@unscheduled');

/* Convention Location */
Route::get('/calendar/convention/{id}/location' , 'LocationController@show');
Route::get('/calendar/convention/{id}/location/change' , 'LocationController@change');
Route::get('/calendar/convention/{id}/location/create' , 'LocationController@create');
Route::get('/calendar/convention/{id}/location/edit' , 'LocationController@edit');
Route::post('/calendar/convention/location/' , 'LocationController@store');

Route::post('/calendar/convention/setlocation' , 'LocationController@set');
Route::delete('/calendar/convention/{id}/location' , 'LocationController@destroy');
Route::patch('/calendar/convention/{id}/location' , 'LocationController@update');

/* Convention Gamesessions 
Route::get('/calendar/convention/sessions/{id}' , 'Calendar\GameSessionController@userCalendar');
Route::get('/calendar/convention/session/{id}/edit' , 'Calendar\GameSessionController@setGameSession');
Route::post('/calendar/convention/session/save' , 'Calendar\GameSessionController@updateUserGameSession');
*/
Route::get('/calendar/convention/session/{id}' , 'Calendar\GameSessionController@show');

/* Convention Games */
Route::get('calendar/convention/{id}/games', 'Calendar\ConventionController@allGames');
Route::get('calendar/convention/game/{id}/edit', 'Calendar\ConventionController@editGame');
Route::patch('calendar/convention/game/{id}', 'Calendar\ConventionController@updateGame');
Route::delete('calendar/convention/game/{id}/', 'Calendar\ConventionController@deleteGame');

Route::post('calendar/convention/game/schedule/add', 'Calendar\ConventionController@addToTimeslot');
Route::post('calendar/convention/game/schedule/remove', 'Calendar\ConventionController@removeFromTimeslot');
Route::get('calendar/convention/game/{id}/schedule', 'Calendar\ConventionController@gameSchedule');

Route::get('calendar/convention/{id}/pool', 'Calendar\ConventionController@pool'); // convention games organizer views
Route::get('calendar/convention/{convention_id}/game/{game_id}', 'Calendar\ConventionController@showGame');


/* Convention Submissions */
//user submissions
Route::get('/calendar/convention/game/submit' , 'Calendar\ConventionController@submitGame');
Route::post('/calendar/convention/game/submit' , 'Calendar\ConventionController@submit');
//organizer
Route::get('/calendar/convention/submissions/{id}' , 'Calendar\ConventionController@submissions');
Route::delete('/calendar/convention/submission/{id}', 'Calendar\ConventionController@rejectSubmission');
Route::post('/calendar/convention/submission', 'Calendar\ConventionController@acceptSubmission');
