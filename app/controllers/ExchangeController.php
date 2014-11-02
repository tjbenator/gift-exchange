<?php
class ExchangeController extends PageController
{
	public function getIndex()
	{
		$this->layout->title = 'Exchanges';
		$this->layout->nest('content', 'exchange.main', ['exchanges' => Exchange::orderBy('id', 'desc')->get()]);
	}

	public function getCreate()
	{
		$this->layout->title = 'Create an Exchange';
		$this->layout->content = View::make('exchange.create');
	}

	public function postCreate() 
	{
		$rules = array (
			'name' => 'required|min:3|max:32',
			'description' => 'max:1024',
			'draw_at' => 'required|date',
			'give_at' => 'required|date',
			'spending_limit' => 'required|integer|min:1|max:999',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('exchange.create')->withErrors($validator)->withInput(Input::all());
		} else {
			$exchange = new Exchange;
			$exchange->name = Input::get('name');
			if (Input::has('description')) $exchange->description = Input::get('description');
			$exchange->draw_at = strtotime(Input::get('draw_at'));
			$exchange->give_at = strtotime(Input::get('give_at'));
			$exchange->spending_limit = Input::get('spending_limit');
			if (Input::has('hidden')) $exchange->hidden = true;

			Auth::User()->made()->save($exchange);
			return Redirect::to('/');
		}
	}

	public function getJoin(Exchange $exchange) {
		$this->layout->title = 'Join "' . $exchange->name . '"';
		$this->layout->nest('content', 'exchange.join', ['exchange' => $exchange]);
	}

	public function postJoin(Exchange $exchange) {
		$rules = array (
			'' => '',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('exchange.join')->withErrors($validator)->withInput(Input::all());
		} else {
			$user = $exchange->participants()->whereUsername(Auth::User()->username)->count();
			if ($user == 0) {
				$exchange->participants()->attach(Auth::User());
			} else {
				return Redirect::route('exchange', ['exchange' => $exchange->slug])->withErrors(['e' => 'You are already in this exchange']);
			}
			return Redirect::route('exchange', ['exchange' => $exchange->slug]);
		}
	}

	public function getLeave(Exchange $exchange) {
		if ($exchange->processed) {
			return Redirect::route('exchange', ['exchange' => $exchange->slug])->withErrors(['e' => 'You can\'t delete a processed exchange']);
		}
		$this->layout->title = 'Leave "' . $exchange->name . '"';
		$this->layout->nest('content', 'exchange.leave', ['exchange' => $exchange]);
	}

	public function postLeave(Exchange $exchange) {
		if ($exchange->processed) {
			return Redirect::route('exchange', ['exchange' => $exchange->slug])->withErrors(['e' => 'You can\'t delete a processed exchange']);
		}
		$rules = array (
			'' => '',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('exchange.leave')->withErrors($validator)->withInput(Input::all());
		} else {
			$user = $exchange->participants()->whereUsername(Auth::User()->username)->count();
			if ($user != 0) {
				$exchange->participants()->detach(Auth::User());
			} else {
				return Redirect::route('exchange', ['exchange' => $exchange->slug])->withErrors(['e' => 'You aren\'t in this exchange']);
			}
			return Redirect::route('home');
		}
	}

	public function getDelete(Exchange $exchange) {
		$this->layout->title = 'Delete Exchange';
		$this->layout->nest('content', 'exchange.delete', ['exchange' => $exchange]);
	}

	public function postDelete(Exchange $exchange) {
		$rules = array (
			'confirm' => 'required|in:' .  $exchange->name,
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('exchange.delete', ['exchange' => $exchange->slug])->withErrors($validator)->withInput(Input::all());
		} else {
			$exchange->delete();
			return Redirect::route('home');
		}
	}


	public function getExchange(Exchange $exchange)
	{
		$this->layout->title = $exchange->name;
		$this->layout->nest('content', 'exchange.single', ['exchange' => $exchange]);
	}
}