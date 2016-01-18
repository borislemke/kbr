<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 *  Set up locale and locale_prefix if other language is selected
 */
if (in_array(Request::segment(1), Config::get('app.alt_langs'))) {

    App::setLocale(Request::segment(1));

    Config::set('app.locale_prefix', Request::segment(1));
}


/*
 * Set up route patterns - patterns will have to be the same as in translated route for current language
 */
foreach(Lang::get('url') as $k => $v) {

    Route::pattern($k, $v);
}


Route::group(['prefix' => Config::get('app.locale_prefix')], function() {



    // Home
    Route::get('/', 'PagesController@home');

    Route::get('/{about}/', 'PagesController@about');



    // Properties
    Route::get('/{properties}/', 'PagesController@propertyListing');

    Route::get('property/{url}', ['as' => 'url','uses' => 'PagesController@propertyView']);



    // Blogs
    Route::get('blogs', 'PagesController@blogListing');

    Route::get('blog/{url}', ['as' => 'url','uses' => 'PagesController@blogView']);



    // Customer
    Route::get('/{login}/', 'PagesController@login');

    Route::get('/{register}/', 'PagesController@register');

    Route::get('/{account}/', 'PagesController@account');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin'], function () {

        // Bull
        Route::get('import', 'ImportController@import');
        // End of Bull

        Route::get('/', function() {

            return redirect('/admin/dashboard');
        });

        // Main Board
        //Route::get('dashboard', 'DashboardController@index');

        Route::get('dashboard', function() {

            return view('admin.page.dashboard');
        });

        Route::get('enquiries', 'EnquiriesController@index');

        Route::get('customers', 'CustomerController@index');


        // CMS
        Route::get('categories', 'CategoriesController@index');

        Route::get('homeslide', 'HomeslideController@index');

        Route::get('pages', 'PagesController@index');

        Route::get('pdf', 'PdfController@index');


        // Blog
        Route::get('blog', 'BlogController@getAll');

        Route::get('blogsample', 'BlogController@sample');


        // Misc
        Route::get('settings', 'SettingsController@index');

        Route::get('about', 'PagesController@adminAbout');
    });
});

Route::group(['prefix' => 'system/ajax'], function () {

    Route::group(['prefix' => 'notifications'], function () {

        Route::any('insert', 'AnalyticsController@insert');

        Route::any('getall', 'AnalyticsController@index');

        Route::any('getunread', 'AnalyticsController@getUnread');
    });

    Route::group(['prefix' => 'blog'], function () {

        Route::any('index', 'BlogController@index');

        Route::any('create', 'BlogController@create');

        Route::get('retrieve/{id}', ['as' => 'id', 'uses' => 'BlogController@retrieve']);

        Route::any('delete/{id}', ['as' => 'id', 'uses' => 'BlogController@destroy']);
    });

    Route::group(['prefix' => 'analytics'], function () {

        Route::any('getall', 'AnalyticsController@getData');
    });

    Route::group(['prefix' => 'customer'], function () {

        Route::any('login', 'CustomerController@login');

        Route::any('register', 'CustomerController@register');
    });
});


Route::controllers([

    'auth' => 'Auth\AuthController',

    'password' => 'Auth\PasswordController',
]);
