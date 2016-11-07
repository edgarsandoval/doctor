<?php

Route::group(['middleware' => 'web'], function () {

	// Authentication module routes
	Route::auth();

	// Home Controller routes.
	Route::get('/', 'HomeController@index');
	Route::get('users', 'HomeController@users');
	Route::get('assistance', 'HomeController@assistance');
	Route::get('events', 'HomeController@events');
	Route::get('files', 'HomeController@files');
	Route::get('gallery', 'HomeController@gallery');

	// User Controller routes
	Route::group(['prefix' => 'users'], function()
	{
		Route::get('create', 'UserController@create')->name('users.create');
		Route::post('/', 'UserController@store')->name('users.store');
		Route::get('/{id}', 'UserController@show')->name('users.show');
		Route::get('edit', 'UserController@edit')->name('users.edit');
		Route::put('/{id}', 'UserController@update')->name('users.update');
		Route::delete('/{id}', 'UserController@destroy')->name('users.destroy');
		Route::post('picture/{id}', 'UserController@uploadPicture')->name('users.picture');
		Route::post('assistance/{id}', 'UserController@assistance')->name('users.assistance');
	});

	// File Controller routes
	Route::group(['prefix' => 'files'], function() {
		Route::post('/', 'FileController@upload')->name('files.upload');
		Route::get('download/{filename}', 'FileController@download')->name('files.download')->where('filename', '[A-Za-z0-9\-\_\. ()]+');;
		Route::get('delete/{filename}', 'FileController@delete')->name('files.delete')->where('filename', '[A-Za-z0-9\-\_\. ()]+');
		Route::post('preview', 'FileController@preview')->name('files.preview');
	});

	// Calendar Controller routes
	Route::group(['prefix' => 'events'], function() {
		Route::get('/all','CalendarController@getEvents')->name('events.all');
		Route::post('/', 'CalendarController@create')->name('events.create');
		Route::post('update', 'CalendarController@update')->name('events.update');
		Route::delete('/{id}','CalendarController@delete')->name('events.delete');
		Route::put('/{id}', 'CalendarController@edit')->name('events.edit');
		Route::get('/{id}', 'CalendarController@show')->name('events.show');
	});

	// Thumbnail Controller routes
	Route::group(['prefix' => 'gallery'], function() {
		Route::post('/', 'ThumbnailController@store')->name('thumbnail.store');
		Route::delete('/{id}', 'ThumbnailController@destroy')->name('thumbnail.destroy');
	});

	// Assistance Controller routes
	Route::group(['prefix' => 'assistance'], function() {
		Route::get('event', 'AssistanceController@getEventSerach')->name('assistance.event');
		Route::post('event/{id}', 'AssistanceController@getEventInfo')->name('assistance.events');
		Route::post('users/{id}', 'AssistanceController@getUsersInfo')->name('assistance.users');
		Route::get('users', 'AssistanceController@getUserSearch')->name('assistance.user');
		Route::post('/', 'AssistanceController@store')->name('assistance.store');
		Route::post('detete', 'AssistanceController@delete')->name('assistance.delete');
	});
});
