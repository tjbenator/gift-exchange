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
App::missing(function ($exception) {
	$layout = View::make("layout.main");
	$layout->title = 'Not Found';
	$layout->content = View::make("errors.missing")->with('exception', $exception->getMessage());

	return Response::make($layout, 404);
});


Route::bind('exchange', function($value) {
	$exchange = Exchange::where('slug', $value)->first();
	if ($exchange) return $exchange;
	App::abort(404, 'Exchange not found!');
});

Route::bind('user', function($value, $route)
{
	$user = User::where('username', $value)->first();
    if ($user) return $user;
    App::abort(404, 'User not found!');
});


Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));

//Auth Pages

	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout', 'before' => 'auth'));
Route::group(array('prefix' => 'dashboard', 'before' => 'auth'), function ()
{
	Route::get('/', array('as' => 'dashboard', 'uses' => 'UserDashboardController@getIndex'));

	Route::get('account', array('as' => 'dashboard.account', 'uses' => 'UserDashboardController@getEditAccount'));
	Route::post('account', array('as' => 'dashboard.account', 'uses' => 'UserDashboardController@postEditAccount'));

	Route::get('edit/wishlist', array('as' => 'dashboard.edit.wishlist', 'uses' => 'UserDashboardController@getEditWishlist'));
	Route::post('edit/wishlist', array('as' => 'dashboard.edit.wishlist', 'uses' => 'UserDashboardController@postEditWishlist'));
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

	Route::get('join', array('as' => 'exchange.join', 'uses' => 'ExchangeController@getJoin', 'before' => 'auth|exchange.processed'));
	Route::post('join', array('as' => 'exchange.join', 'uses' => 'ExchangeController@postJoin', 'before' => 'auth|exchange.processed'));

	Route::get('leave', array('as' => 'exchange.leave', 'uses' => 'ExchangeController@getLeave', 'before' => 'auth|exchange.processed'));
	Route::post('leave', array('as' => 'exchange.leave', 'uses' => 'ExchangeController@postLeave', 'before' => 'auth|exchange.processed'));

	Route::get('delete', array('as' => 'exchange.delete', 'uses' => 'ExchangeController@getDelete', 'before' => 'auth|owner|exchange.processed'));
	Route::post('delete', array('as' => 'exchange.delete', 'uses' => 'ExchangeController@postDelete', 'before' => 'auth|owner|exchange.processed'));
});

Route::group(array('prefix' => 'user/{user}'), function ()
{
	Route::get('/', array('as' => 'user', 'uses' => 'UserController@getIndex'));
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