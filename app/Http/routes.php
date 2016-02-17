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

        // dashbord
        Route::get('/',['as' => 'admin.home', 'uses' => 'AdminController@dashboard']);

        Route::get('dashboard',['as' => 'admin.dashboard', 'uses' => 'AdminController@dashboard']);

        // property
        Route::get('properties/{term?}',['as' => 'admin.properties', 'uses' => 'AdminController@properties'])->where('term', '(.*)');

        // enquiry
        Route::get('enquiries/{term?}',['as' => 'admin.enquiries', 'uses' => 'AdminController@enquiries']);

        // customer
        Route::get('customers/{term?}',['as' => 'admin.customers', 'uses' => 'AdminController@customers']);

        // Page
        Route::get('pages/{term?}',['as' => 'admin.pages', 'uses' => 'AdminController@pages']);

        // Post
        Route::get('posts/{term?}',['as' => 'admin.posts', 'uses' => 'AdminController@posts']);

        // my-account
        Route::get('my-account',['as' => 'admin.my_account', 'uses' => 'AdminController@my_account']);

        // accounts
        Route::get('accounts',['as' => 'admin.accounts', 'uses' => 'AdminController@accounts']);

        // branches
        Route::get('branches',['as' => 'admin.branches', 'uses' => 'AdminController@branches']);

        // setting
        Route::get('settings',['as' => 'admin.setting', 'uses' => 'AdminController@settings']);

        // about
        Route::get('about',['as' => 'admin.about', 'uses' => 'AdminController@about']);

    });

});


// User Auth
Route::controllers([

    'auth' => 'Auth\AuthController',

    'password' => 'Auth\PasswordController',
]);


// Front-End
Route::group(['prefix' => Config::get('app.locale_prefix')], function() {

    // customer
    Route::get('{login}', ['as' => 'login', 'uses' => 'Auth\AuthController@getCustomerLogin']);  
    Route::post('{login}',['as' => 'login.attempt', 'uses' => 'Auth\AuthController@postLogin']);  
    Route::get('{logout}', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

    Route::get('{register}', ['as' => 'register', 'uses' => 'Auth\AuthController@getCustomerRegister']);
    Route::post('{register}',['as' => 'register.store', 'as' => 'Auth\AuthController@postRegister']);

    Route::get('{confirm}/{confirmationCode}', [
        'as' => 'confirm',
        'uses' => 'Auth\AuthController@getCustomerConfirm'
    ]);

    Route::group(['middleware' => 'auth.customer'], function () {

        Route::get('/{account}/', ['as' => 'account', 'uses' => 'CustomerController@account']);

        Route::get('/{account}/{wishlist}', ['as' => 'account.wishlist', 'uses' => 'PagesController@accountWishlist'])
            ->where('wishlist', trans('url.wishlist'));

        Route::get('/{account}/{setting}', ['as' => 'account.setting', 'uses' => 'PagesController@accountSetting'])
            ->where('wishlist', trans('url.setting'));

    }); 


    // home
    Route::get('/',['as' => 'home', 'uses' => 'PageController@home']);

    // about
    Route::get('{about}',['as' => 'about', 'uses' => 'PageController@about']);

    // contact    
    Route::any('{contact}',['as' => 'contact', 'uses' => 'PageController@contact']);

    // testimony    
    Route::any('{testimonials}',['as' => 'testimonials', 'uses' => 'PageController@testimony']);

    // sell_property    
    Route::any('{sell_property}',['as' => 'sell_property', 'uses' => 'PageController@sellProperty']);

    // lawyer_notary    
    Route::any('{lawyer_notary}',['as' => 'lawyer_notary', 'uses' => 'PageController@lawyerNotary']);

    // search    
    Route::get('{search}',['as' => 'search', 'uses' => 'PropertyController@search']);

    // property
    Route::get('{property}/{term?}',['as' => 'property', 'uses' => 'PropertyController@detail']);

    // post
    Route::get('{blog}/{term?}',['as' => 'blog', 'uses' => 'PostController@detail']);

    // page
    Route::get('{page?}',['as' => 'page', 'uses' => 'PageController@index']);

});


// API
Route::group(['prefix' => 'api'], function() {

    Route::resource('branch', 'BranchController');

    Route::resource('city', 'CityController');

    Route::resource('message', 'ContactController');

    Route::resource('country', 'CountryController');

    Route::resource('customer', 'CustomerController');

    Route::resource('enquiry', 'EnquiryController');

    Route::resource('locale', 'LocaleController');

    Route::resource('log_customer', 'LogCustomerController');

    Route::resource('log_user', 'LogUserController');

    Route::resource('notification', 'NotificationController');

    Route::resource('page', 'PageController');

    Route::resource('page_locale', 'PageLocaleController');

    Route::resource('page_meta', 'PageMetaController');

    Route::resource('page_term', 'PageTermController');

    Route::resource('post', 'PostController');

    Route::resource('post_locale', 'PostLocaleController');

    Route::resource('post_meta', 'PostMetaController');

    Route::resource('post_term', 'PostTermController');

    Route::resource('property', 'PropertyController');

    Route::resource('property_locale', 'PropertyLocaleController');

    Route::resource('property_meta', 'PropertyMetaController');

    Route::resource('property_term', 'PropertyTermController');

    Route::resource('province', 'ProvinceController');

    Route::resource('role', 'RoleController');

    Route::resource('term', 'TermController');

    Route::resource('testimony', 'TestimonyController');

    Route::resource('user', 'UserController');

    Route::resource('wishlist', 'WishlistController');

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

        Route::group(['prefix' => 'testimony'], function () {

            Route::any('get/{id}', 'CustomerController@showTestimony');

            Route::any('store', 'CustomerController@storeTestimony');

            Route::any('destroy/{id}', 'CustomerController@destroyTestimony');

        });        

        Route::group(['prefix' => 'message'], function () {

            Route::any('destroy/{id}', 'ContactController@destroy');

        });

        Route::group(['prefix' => 'property'], function () {

            Route::any('translate/get/{id}', 'PropertiesController@getTranslate');

            Route::any('translate/store', 'PropertiesController@storeTranslate');

            Route::any('get/{id}', 'PropertiesController@show');

            Route::any('store', 'PropertiesController@store');

            Route::any('destroy/{id}', 'PropertiesController@destroy');

            Route::any('image/destroy/{id}', 'PropertiesController@destroyImage');

            Route::any('data/{category}/{status}/', 'PropertiesController@index');

        });

        Route::group(['prefix' => 'category'], function () {

            Route::any('translate/get/{id}', 'CategoryController@getTranslate');

            Route::any('translate/store', 'CategoryController@storeTranslate');

            Route::any('get/{id}', 'CategoryController@show');

            Route::any('store', 'CategoryController@store');

            Route::any('destroy/{id}', 'CategoryController@destroy');

        });

        Route::group(['prefix' => 'inquiry'], function () {

            Route::any('get/{id}', 'InquiryController@show');

            Route::any('store', 'InquiryController@store');

            Route::any('destroy/{id}', 'InquiryController@destroy');

        });

        Route::group(['prefix' => 'account'], function () {

            Route::any('prepare', 'UserController@invite');

            Route::any('store', 'UserController@store');

            Route::any('update', 'UserController@update');

            Route::any('profile/store', 'UserController@storeProfile');

            Route::any('get/{id}', 'UserController@show');

            Route::any('destroy/{id}', 'UserController@destroy');

        });

        Route::group(['prefix' => 'branch'], function () {

            Route::any('store', 'BranchController@store');

            Route::any('get/{id}', 'BranchController@show');

            Route::any('destroy/{id}', 'BranchController@destroy');

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

