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


// Back-End
Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin'], function () {

        // General
        Route::get('/', 'AdminController@dashboard');
        
        Route::get('dashboard', 'AdminController@dashboard');

        Route::get('enquiries', 'AdminController@enquiries');


        // Customer
        Route::get('customers', 'AdminController@customers');


        // CMS
        Route::get('properties', 'AdminController@properties');
        Route::get('property/categories', 'AdminController@propertyCategories');


        // Blog
        Route::get('blog', 'AdminController@blog');

        Route::get('blog-categories', 'AdminController@blogCategories');

        Route::get('blog-comments', 'AdminController@blogComments');

        Route::get('blog-settings', 'AdminController@blogSettings');


        // Misc
        Route::get('my-account', 'AdminController@myAccount');

        Route::get('accounts', 'AdminController@accounts');

        Route::get('settings', 'AdminController@settings');

        Route::get('about', 'AdminController@about');

        Route::get('pdfD', 'PdfController@test');

        Route::get('email', 'UserController@test');

        Route::get('pdf', function() {

            return view('pdf.property');
        });

        Route::any('register', function() {

            return view('admin.pages.register');
        });
    });
});

Route::group(['prefix' => Config::get('app.locale_prefix')], function() {

    // Home
    Route::get('/', 'PagesController@home');

    Route::get('/{about}/', 'PagesController@about');


    // Customer
    Route::get('/{login}/', 'PagesController@login');
    Route::post('/{login}/', 'Auth\AuthController@postLogin');
    Route::get('/{logout}/', 'Auth\AuthController@getLogout');

    Route::get('/{register}/', 'PagesController@register');

    Route::group(['middleware' => 'auth.customer'], function () {

        Route::get('/{account}/', 'PagesController@account');
    });


    // Properties
    Route::get('/{properties}/', 'PagesController@propertyListing');

    Route::get('property/{url}', ['as' => 'url','uses' => 'PagesController@propertyView']);



    // Blogs
    Route::get('blogs', 'PagesController@blogListing');

    Route::get('blog/{url}', ['as' => 'url','uses' => 'PagesController@blogView']);


});



Route::group(['middleware' => 'auth'], function () {

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

            Route::any('get/{id}', 'CustomerController@show');

            Route::any('store', 'CustomerController@store');

            Route::any('destroy/{id}', 'CustomerController@destroy');

        });

        Route::group(['prefix' => 'property'], function () {

            Route::any('get/{id}', 'PropertiesController@show');

            Route::any('store', 'PropertiesController@store');

            Route::any('destroy/{id}', 'PropertiesController@destroy');

            Route::any('image/destroy/{id}', 'PropertiesController@destroyImage');

        });

        Route::group(['prefix' => 'category'], function () {

            Route::any('get/{id}', 'CategoryController@show');

            Route::any('store', 'CategoryController@store');

            Route::any('delete/{id}', 'CategoryController@destroy');

        });

        Route::group(['prefix' => 'inquiry'], function () {

            Route::any('get/{id}', 'InquiryController@show');

            Route::any('store', 'InquiryController@store');

            Route::any('destroy/{id}', 'InquiryController@destroy');

        });

        Route::group(['prefix' => 'account'], function () {

            Route::any('prepare', 'UserController@invite');
        });

        Route::group(['prefix' => 'settings'], function () {

            Route::group(['social' => 'general'], function () {

                Route::any('get', 'SystemController@getGeneral');

                Route::any('set', 'SystemController@setGeneral');
            });

            Route::group(['prefix' => 'social'], function () {

                Route::any('get', 'SystemController@getSocial');

                Route::any('set', 'SystemController@setSocial');
            });

            Route::group(['prefix' => 'currency'], function () {

                Route::any('get', 'SystemController@getExchange');

                Route::any('update', 'SystemController@updateExchange');

                Route::any('set', 'SystemController@setExchange');

                Route::any('auto/{state}', ['as' => 'state', 'uses' => 'SystemController@setExchangeAuto']);
            });

            Route::any('reindexdata', 'SystemController@reindexData');

            Route::any('clearcache', 'SystemController@clearCache');
        });
    });
});


Route::controllers([

    'auth' => 'Auth\AuthController',

    'password' => 'Auth\PasswordController',
]);
