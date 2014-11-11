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

Route::get('/', function()
{
	return View::make('hello');
});

Route::group( array('prefix'=>'/pages/', 'before' => 'ajax'), function()
{

    Route::get('{name}', function($name){
        return View::make('pages.'.$name);
    });
});


Route::group(array('prefix' => '/api/', 'before' => 'ajax' ), function() {

    Route::resource('cat', 'CatController');

    Route::resource('language', 'LanguageController');

    Route::group(array('before' => array('auth.token') ), function() {

        Route::resource('user', 'UserController');
        Route::resource('like', 'LikeController');
        Route::post('cat', 'CatController@store');
        Route::post('language', 'LanguageController@store');
        Route::put('language', 'LanguageController@update');
        Route::any('upload', 'ApiController@upload');

    });

    Route::get('user', 'UserController@index');

    Route::any('getUserPic', 'ApiController@getUserPic');

    Route::controller('auth', 'AuthController');
});

App::missing(function($exception)
{
    return View::make('hello');
});