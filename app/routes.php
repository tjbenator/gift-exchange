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
Route::bind('exchange', function($value) {
	return Exchange::where('slug', $value)->firstOrFail();
});

Route::bind('user', function($value, $route)
{
	$user = User::where('username', $value)->first();
    if ($user) return $user;
    App::abort(404, 'User not found!');
});


Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));

//Auth Pages
Route::group(array('before' => 'auth'), function ()
{
	Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));
	Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'UserDashboardController@getIndex'));
});

Route::group(array('prefix' => 'exchanges'), function ()
{
	Route::get('/', array('as' => 'exchanges', 'uses' => 'ExchangeController@getIndex'));
	Route::get('create', array('as' => 'exchange.create', 'uses' => 'ExchangeController@getCreate', 'before' => 'auth'));
	Route::post('create', array('as' => 'exchange.create', 'uses' => 'ExchangeController@postCreate', 'before' => 'auth|csrf'));
});

Route::group(array('prefix' => 'exchange/{exchange}'), function ()
{
	Route::get('/', array('as' => 'exchange', 'uses' => 'ExchangeController@getExchange'));

	Route::get('join', array('as' => 'exchange.join', 'uses' => 'ExchangeController@getJoin', 'before' => 'auth'));
	Route::post('join', array('as' => 'exchange.join', 'uses' => 'ExchangeController@postJoin', 'before' => 'auth'));

	Route::get('delete', array('as' => 'exchange.delete', 'uses' => 'ExchangeController@getDelete', 'before' => 'auth'));
});

Route::group(array('prefix' => 'user/{user}'), function ()
{
	Route::get('/', array('as' => 'user', 'uses' => 'UserController@getIndex'));
	Route::get('wishlists', array('as' => 'wishlists', 'uses' => 'UserController@getWishlists'));
});

//Guest Pages
Route::group(array('before' => 'guest'), function () 
{
	Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));
	Route::post('/login', array('as' => 'login', 'uses' => 'AuthController@postLogin', 'before' => 'csrf'));

	Route::get('/register', array('as' => 'register', 'uses' => 'RegistrationController@getRegister'));
	Route::post('/register', array('as' => 'register', 'uses' => 'RegistrationController@postRegister', 'before' => 'csrf'));

	Route::controller('password', 'RemindersController');
});