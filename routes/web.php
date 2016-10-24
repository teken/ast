<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//home
Route::get('/', 'HomeController@index');
Route::get('/home', function () { return  redirect('/'); });

//auth
Auth::routes();

//admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'AdministratorController@index');

    Route::get('/courses/new', 'CourseController@new');
    Route::get('/courses/{slug}/edit', 'CourseController@edit');
    Route::match(['put', 'post'], '/courses/{slug?}', 'CourseController@store');
    Route::delete('/courses/{slug}', 'CourseController@delete');

    Route::get('/modules/new', 'ModuleController@new');
    Route::get('/modules/{slug}/edit', 'ModuleController@edit');
    Route::match(['put', 'post'], '/modules/{slug?}', 'ModuleController@store');
    Route::delete('/modules/{slug}', 'ModuleController@delete');
});

//users
Route::group(['middleware' => 'auth'], function () {
    Route::get('/my/courses', 'CourseController@user');

    Route::get('/my/videos', 'VideoController@user');
    Route::match(['put', 'post'] ,'/my/videos/{slug?}', 'VideoController@store');
    Route::delete('/my/videos/{slug}', 'VideoController@delete');

    Route::get('/my/favorites', 'FavoriteController@index');
    Route::put('/my/favorites/{slug}', 'FavoriteController@store');
});

//resources
Route::get('/css', 'ResourceController@css');

//not auth-ed
Route::get('/courses', 'CourseController@index');
Route::get('/courses/{slug}', 'CourseController@details');

Route::get('/modules', 'ModuleController@index');
Route::get('/modules/{slug}', 'ModuleController@details');

Route::get('/videos', 'VideoController@index');
Route::get('/videos/{slug}', 'VideoController@details');
