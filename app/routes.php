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
    Route::group(array('before' => array('auth.token') ), function() {

        Route::get('add-cat', function(){
            return View::make('pages.add-cat');
        });

    });

    Route::get('{name}', function($name){
        return View::make('pages.'.$name);
    });
});


Route::group(array('prefix' => '/api/', 'before' => 'ajax' ), function() {

    Route::resource('cat', 'CatController');
    Route::group(array('before' => array('auth.token') ), function() {

        Route::resource('user', 'UserController');
        Route::post('cat', 'CatController@store');
        Route::any('upload', 'ApiController@upload');

    });

    Route::controller('auth', 'AuthController');
});

App::missing(function($exception)
{
    return View::make('hello');
});