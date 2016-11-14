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
Route::get('/', 'VideoController@home');
Route::get('/home', function () { return  redirect('/'); });

//search
Route::get('/search/{term}', 'VideoController@search');

//auth
Auth::routes();

//admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'AdministratorController@index');

    Route::get('/courses/new', 'CourseController@new');
    Route::get('/courses/{slug}/edit', 'CourseController@edit');
    Route::match(['put', 'post'], '/courses/{slug?}', 'CourseController@store');
    Route::get('/courses/{slug}/delete', 'CourseController@delete');

    Route::get('/modules/new', 'ModuleController@new');
    Route::get('/modules/{slug}/edit', 'ModuleController@edit');
    Route::match(['put', 'post'], '/modules/{slug?}', 'ModuleController@store');
    Route::get('/modules/{slug}/delete', 'ModuleController@delete');

    //users
    Route::get('/users', 'UserController@index');
    Route::get('/users/{id}/promote', 'UserController@promote');
    Route::get('/users/{id}/demote', 'UserController@demote');

    //comments
    Route::get('/comments/{commentId}/delete', 'VideoController@deleteComment');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/courses/subscriptions', 'CourseController@user');
    Route::get('/courses/{slug}/subscribe', 'CourseController@subscribe');
    Route::get('/courses/{slug}/unsubscribe', 'CourseController@unsubscribe');

    Route::get('/my/videos', 'VideoController@user');
    Route::get('/my/videos/new', 'VideoController@new');
    Route::get('/videos/{slug}/edit', 'VideoController@edit');
    Route::match(['put', 'post'] ,'/my/videos/{slug?}', 'VideoController@store');
    Route::get('/videos/{slug}/delete', 'VideoController@delete');

    Route::get('/videos/favourites', 'VideoController@favourites');
    Route::get('/videos/{slug}/favourite', 'VideoController@favourite');
    Route::get('/videos/{slug}/unfavourite', 'VideoController@unfavourite');

    Route::put('/videos/{slug}/comment', 'VideoController@comment');
});

//resources
Route::get('/css', 'ResourceController@css');

Route::get('/courses', 'CourseController@index');
Route::get('/courses/{slug}', 'CourseController@details');

Route::get('/modules', 'ModuleController@index');
Route::get('/modules/{slug}', 'ModuleController@details');

Route::get('/videos', 'VideoController@index');
Route::get('/videos/{slug}', 'VideoController@details');
