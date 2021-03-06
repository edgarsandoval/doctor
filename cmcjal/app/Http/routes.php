<?php

// Authentication module routes
Route::group(['middleware' => 'web'], function() {

	Route::auth();
});

Route::group(['middleware' => 'web', 'prefix' => 'admin'], function () {


	// Home Controller routes.
	Route::get('/', 'HomeController@index')->name('admin.index');
	Route::get('users', 'HomeController@users');
	Route::get('profile/{id?}', 'UserController@show');
	Route::get('assistance', 'HomeController@assistance');
	Route::get('events', 'HomeController@events');
	Route::get('files', 'HomeController@files');
	Route::get('gallery', 'HomeController@gallery');
	Route::post('lockscreen', 'HomeController@lockscreen');
	Route::post('lock', 'HomeController@lock');

	// User Controller routes
	Route::group(['prefix' => 'users'], function() {
		Route::get('create', 'UserController@create')->name('users.create');
		Route::post('/', 'UserController@store')->name('users.store');
		Route::get('/{id}', 'UserController@show')->name('users.show');
		Route::get('edit/{id}', 'UserController@edit')->name('users.edit');
		Route::put('/{id}', 'UserController@update')->name('users.update');
		Route::delete('/{id}', 'UserController@destroy')->name('users.destroy');
		Route::post('picture/{id}', 'UserController@uploadPicture')->name('users.picture');
		Route::post('assistance/{id}', 'UserController@assistance')->name('users.assistance');
		Route::post('document/{id}', 'UserController@uploadDocumentation')->name('users.docs');
		Route::get('document/{id}/{file}', 'UserController@getDocumentation')->name('users.get_doc');
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
		Route::get('/{id}/edit', 'CalendarController@editForm')->name('events.form');
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
		Route::get('check', 'AssistanceController@checkAssistance')->name('assistance.check');
	});

	Route::group(['prefix' => 'exam'], function() {
		// Question Routes inside of exam
		Route::post('question', 'ExamController@storeQuestion')->name('question.store');
		Route::put('question/{id}', 'ExamController@updateQuestion')->name('question.update');
		Route::get('question/{id}', 'ExamController@showQuestion')->name('question.show');
		Route::delete('question/{id}', 'ExamController@deleteQuestion')->name('question.delete');

		Route::post('/evaluate', 'ExamController@evaluate')->name('exam.evaluate');
		Route::get('/{event_id}', 'ExamController@create')->name('exam.create');
		Route::post('/{event_id}', 'ExamController@store')->name('exam.store');
		Route::get('/{event_id}/test', 'ExamController@show')->name('exam.show');
	});

	Route::get('diploma/{user_id}/{event_id}', 'DiplomaController@show');

	Route::get('/diploma', function() {
		return view('diploma');
	});

	Route::group(['prefix' => 'noticias'], function() {
		Route::get('/', 'NewsController@index')->name('news.index');
		Route::post('/', 'NewsController@store')->name('news.store');
		Route::get('crear', 'NewsController@create')->name('news.create');
		Route::get('{id}/editar', 'NewsController@edit')->name('news.edit');
		Route::get('{id}', 'NewsController@show')->name('news.show');
		Route::put('{id}', 'NewsController@update')->name('news.update');
		Route::delete('{id}', 'NewsController@destroy')->name('news.destroy');
	});
});


// Frontend section
Route::get('/', 'FrontController@index');
Route::get('_cmcjal', 'FrontController@cmcjal');
Route::get('colegiados', 'FrontController@colegiados');
Route::get('registro', 'FrontController@registro');
Route::get('internacionales', 'FrontController@internacionales');
Route::get('nacionales', 'FrontController@nacionales');
Route::get('locales', 'FrontController@locales');
Route::get('mensuales', 'FrontController@mensuales');
Route::get('noticias', 'FrontController@noticias');
Route::get('galeria', 'FrontController@galeria');
Route::get('contacto', 'FrontController@contacto');
Route::post('contacto/enviar', 'FrontController@submit');
