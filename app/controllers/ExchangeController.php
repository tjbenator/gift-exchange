<?php
class ExchangeController extends BaseController
{
	public function getIndex()
	{
		return View::make('exchange.main')->with('exchanges', Exchange::all());
	}

	public function getCreate()
	{
		return View::make('exchange.create');
	}

	public function postCreate() 
	{
		$rules = array (
			'name' => 'required|min:3|max:32',
			'description' => 'min:5|max:1024',
			'draw_at' => 'required|date'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('exchange.create')->withErrors($validator)->withInput(Input::all());
		} else {
			$exchange = new Exchange;
			$exchange->name = Input::get('name');
			if (Input::has('description')) $exchange->description = Input::get('description');
			$exchange->draw_at = strtotime(Input::get('draw_at'));

			if (Input::has('hidden')) $exchange->hidden = true;

			Auth::User()->made()->save($exchange);
			return Redirect::to('/');
		}
	}

	public function getJoin(Exchange $exchange) {
		return View::make('exchange.join')->with('exchange', $exchange);
	}

	public function postJoin(Exchange $exchange) {
		$rules = array (
			'wishlist' => 'required|min:3|max:2048',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('exchange.join')->withErrors($validator)->withInput(Input::all());
		} else {
			$exchange = new Exchange;
			$exchange->name = Input::get('name');
			if (Input::has('description')) $exchange->description = Input::get('description');
			$exchange->draw_at = strtotime(Input::get('draw_at'));

			if (Input::has('hidden')) $exchange->hidden = true;

			Auth::User()->made()->save($exchange);
			return Redirect::to('/');
		}
	}

	public function getExchange(Exchange $exchange)
	{
		return View::make('exchange.single')->with('exchange', $exchange);
	}
}