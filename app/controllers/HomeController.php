<?php

class HomeController extends PageController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		$this->layout->title = 'Home';
		$exchanges = Exchange::where('hidden', 0)->orderBy('processed', 'asc')->get();
		$this->layout->nest('content', 'home', ['exchanges' => $exchanges]);
	}

}
