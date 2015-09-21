<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/', function()
// {
// 	return View::make('hello');
// });

Route::get('/', 'HomeController@showWelcome');

Route::controller('auth', 'AuthController');
Route::controller('password', 'RemindersController');

Route::controller('admin', 'AdminController');

Route::post('/form-request', 'HomeController@postFormRequest');

//all

Route::post('/connect', 'HomeController@postConnect');
Route::get('/ajax/{slug?}', 'HomeController@getAjax');
Route::get('/search/autocomplete/{type}/{id?}', 'HomeController@autocomplete');

Route::get('/rate/{slug?}', 'HomeController@getRate');
Route::get('/{type}/{slug?}', 'HomeController@getPage');
Route::get('/{type}/{category}/{item}', 'HomeController@getItem');
