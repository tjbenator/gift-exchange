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

Route::when('*', 'csrf', ['post']);

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

Route::group(['prefix' => 'dashboard', 'before' => 'auth'], function ()
{
	Route::get('/', ['as' => 'dashboard', 'uses' => 'UserDashboardController@getIndex']);

	Route::get('account', ['as' => 'dashboard.account', 'uses' => 'UserDashboardController@getAccount']);
	Route::post('account', ['as' => 'dashboard.account', 'uses' => 'UserDashboardController@postAccount']);

	Route::get('edit/wishlist', ['as' => 'dashboard.wishlist', 'uses' => 'UserDashboardController@getWishlist']);
	Route::post('edit/wishlist', ['as' => 'dashboard.wishlist', 'uses' => 'UserDashboardController@postWishlist']);
});

Route::group(['prefix' => 'exchanges'], function ()
{
	Route::get('/', ['as' => 'exchanges', 'uses' => 'ExchangeController@getIndex']);
	
	Route::get('create', ['as' => 'exchange.create', 'uses' => 'ExchangeController@getCreate', 'before' => 'auth']);
	Route::post('create', ['as' => 'exchange.create', 'uses' => 'ExchangeController@postCreate', 'before' => 'auth']);
});

Route::group(['prefix' => 'exchange/{exchange}'], function()
{
	Route::get('/', ['as' => 'exchange', 'uses' => 'ExchangeController@show']);

	Route::get('join', ['as' => 'exchange.join', 'uses' => 'ExchangeController@getJoin', 'before' => 'auth|exchange.processed:deny']);
	Route::post('join', ['as' => 'exchange.join', 'uses' => 'ExchangeController@postJoin', 'before' => 'auth|exchange.processed:deny']);

	Route::get('leave', ['as' => 'exchange.leave', 'uses' => 'ExchangeController@getLeave', 'before' => 'auth|exchange.processed:deny']);
	Route::post('leave', ['as' => 'exchange.leave', 'uses' => 'ExchangeController@postLeave', 'before' => 'auth|exchange.processed:deny']);

	Route::get('message', ['as' => 'exchange.message', 'uses' => 'ExchangeController@getMessage', 'before' => 'auth|exchange.participant|exchange.processed:allow']);
	Route::post('message', ['as' => 'exchange.message', 'uses' => 'ExchangeController@postMessage', 'before' => 'auth|exchange.participant|exchange.processed:allow']);

	Route::get('edit', ['as' => 'exchange.edit', 'uses' => 'ExchangeController@getEdit', 'before' => 'auth|owner|exchange.processed:deny']);
	Route::post('edit', ['as' => 'exchange.edit', 'uses' => 'ExchangeController@postEdit', 'before' => 'auth|owner|exchange.processed:deny']);

	Route::get('delete', ['as' => 'exchange.delete', 'uses' => 'ExchangeController@getDelete', 'before' => 'auth|owner|exchange.processed:deny']);
	Route::post('delete', ['as' => 'exchange.delete', 'uses' => 'ExchangeController@postDelete', 'before' => 'auth|owner|exchange.processed:deny']);
});

Route::get('users', ['as' => 'users', 'uses' => 'UserController@getUserList', 'before' => 'auth']);

Route::get('user/{user}', ['as' => 'user', 'uses' => 'UserController@show', 'before' => 'auth']);

Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout', 'before' => 'auth']);

Route::group(['before' => 'guest'], function () 
{
	Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
	Route::post('/login', ['as' => 'login', 'uses' => 'AuthController@postLogin']);

	Route::get('/register', ['as' => 'register', 'uses' => 'RegistrationController@getRegister']);
	Route::post('/register', ['as' => 'register', 'uses' => 'RegistrationController@postRegister']);

	Route::controller('password', 'RemindersController');
});

//Pages
Route::get('/about', ['as' => 'about', 'uses' => 'HomeController@getAbout']);
Route::get('/how-to-wishlist', ['as' => 'how-to-wishlist', 'uses' => 'HomeController@getHowToWishlist']);