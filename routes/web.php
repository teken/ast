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
Route::get('/home', function () { return  redirect()->route('/'); });

//auth
Auth::routes();

//admin
Route::get('/admin', 'AdministratorController@index');

//resources
Route::get('/css', 'ResourceController@css');
