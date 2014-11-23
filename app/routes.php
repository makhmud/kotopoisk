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

Route::any('/', function()
{
    $view = View::make('hello')->with([ 'pages' => Page::all() ]);

    if (Input::has('token')) {
        $view->with(['social_token' => Input::get('token')]);
    }

	return $view;
});

Route::controller('/admin/user', 'AdminUserController');
Route::controller('/admin/general', 'AdminGeneralController');
Route::controller('/admin/cat', 'AdminCatsController');
Route::controller('/admin/pages', 'AdminPagesController');
Route::controller('/admin', 'AdminController');

Route::group( array('prefix'=>'/pages/', 'before' => 'ajax'), function()
{

    Route::get('{name}', function($name){
        return View::make('pages.'.$name);
    });
});


Route::group(array('prefix' => '/api/', 'before' => 'ajax' ), function() {

    Route::resource('cat', 'CatController');

    Route::resource('language', 'LanguageController');

    Route::controller('auth', 'AuthController');

    Route::group(array('before' => array('auth.token') ), function() {

        Route::resource('user', 'UserController');
        Route::resource('like', 'LikeController');
        Route::post('cat', 'CatController@store');
        Route::post('language', 'LanguageController@store');
        Route::put('language', 'LanguageController@update');
        Route::any('upload', 'ApiController@upload');
        Route::post('auth/change-pass', 'AuthController@changePass');

    });

    Route::get('user', 'UserController@index');

    Route::any('getUserPic', 'ApiController@getUserPic');


});

App::missing(function($exception)
{
    return View::make('hello')->with([ 'pages' => Page::all() ]);
});