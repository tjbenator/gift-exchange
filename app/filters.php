<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('exchange.owner', function ($route, $request) {
	$exchange = $route->getParameter('exchange');
	if (Auth::check()) {
		if ($exchange->user->id == Auth::user()->id) return;
	}
	
	return Redirect::route('exchanges')->withErrors(['e' => 'You are not the owner of the "' . $exchange->name . '" exchange!']);
});

Route::filter('exchange.processed', function ($route, $request, $value) {
	$exchange = $route->getParameter('exchange');
	if ($value == 'allow') {
		if (!$exchange->processed) {
			return Redirect::route('exchange', [$exchange->slug])->withErrors(['e' => 'This function can not be used because this exchange has not been drawn for.']);	
		}
	} elseif($value == 'deny') {
		if ($exchange->processed) {
			return Redirect::route('exchange', [$exchange->slug])->withErrors(['e' => 'This exchange can not be modified because it is past it\'s draw date of ' . $exchange->draw_at]);	
		}
	}
	return;
});

Route::filter('exchange.participant', function ($route, $request) {
	$exchange = $route->getParameter('exchange');
	if (Auth::check()) {
		if ($exchange->participants->contains(Auth::user()->id)) return;
	}
	
	return Redirect::route('exchanges')->withErrors(['e' => 'You are not participating in the "' . $exchange->name . '" exchange!']);
});