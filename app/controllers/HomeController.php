<?php

class HomeController extends PageController {

	public function getIndex()
	{
		$this->layout->title = 'Home';
		$exchanges = Exchange::where('hidden', 0)->orderBy('processed', 'asc')->get();
		$this->layout->nest('content', 'home', ['exchanges' => $exchanges]);
	}

	public function getHowToWishlist()
	{
		$this->layout->title = 'How to wishlist';
		$this->layout->nest('content', 'pages.howtowishlist', []);
	}
}
