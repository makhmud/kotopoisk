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
Route::controller('/admin/static-pages', 'AdminStaticPagesController');
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

    Route::resource('static-page', 'StaticPageController');

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

Route::get('sitemap', function(){

    // create new sitemap object
    $sitemap = App::make("sitemap");

    // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
    // by default cache is disabled
    $sitemap->setCache('laravel.sitemap', 3600);

    // check if there is cached sitemap and build new only if is not
    if (!$sitemap->isCached())
    {
        // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');

        // get all posts from db
        $cats = Cat::orderBy('created_at', 'desc')->get();

        // add every post to the sitemap
        foreach ($cats as $cat)
        {
            $sitemap->add(URL::to('/feed/'.$cat->id), $cat->updated_at);
        }

        $pages = Page::all();

        foreach ($pages as $page) {
            $sitemap->add(URL::to($page->alias));
        }

        $pages = StaticPageModel::all();

        foreach ($pages as $page) {
            $sitemap->add(URL::to($page->alias));
        }
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');

});

App::missing(function($exception)
{
    return View::make('hello')->with([ 'pages' => Page::all() ]);
});