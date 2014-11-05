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
		$this->layout->content = View::make('exchange.editor');
	}

	public function postCreate() 
	{
		$rules = array (
			'name' => 'required|max:32',
			'description' => 'max:1024',
			'draw_at' => 'required|date_format:Y-m-d',
			'give_at' => 'required|date_format:Y-m-d',
			'passphrase' => 'required|min:3|max:32',
			'spending_limit' => 'required|integer|min:1|max:999',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('exchange.create')->withErrors($validator)->withInput(Input::all());
		} else {
			$exchange = new Exchange;
			$exchange->name = Input::get('name');
			if (Input::has('description')) $exchange->description = Input::get('description');
			$exchange->draw_at = Input::get('draw_at');
			$exchange->give_at = Input::get('give_at');
			$exchange->spending_limit = Input::get('spending_limit');
			$exchange->passphrase = Input::get('passphrase', null);
			if (Input::has('hidden')) $exchange->hidden = true;

			Auth::User()->made()->save($exchange);

			// Add the creator to the exchange
			$exchange->participants()->attach(Auth::User());
			$exchange->save();

			return Redirect::to('/');
		}
	}

	public function getEdit(Exchange $exchange)
	{
		$this->layout->title = 'Edit Exchange';
		$this->layout->nest('content', 'exchange.editor', ['exchange' => $exchange]);
	}

	public function postEdit(Exchange $exchange) 
	{
		$rules = array (
			'name' => 'required|max:32',
			'description' => 'max:1024',
			'draw_at' => '',
			'give_at' => '',
			'passphrase' => 'required|min:3|max:32',
			'spending_limit' => 'required|integer|min:1|max:999',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('exchange.edit', ['exchange' => $exchange->slug])->withErrors($validator)->withInput(Input::all());
		} else {
			$exchange->name = Input::get('name');
			if (Input::has('description')) $exchange->description = Input::get('description');
			$exchange->spending_limit = Input::get('spending_limit');
			$exchange->passphrase = Input::get('passphrase', null);
			if (Input::has('hidden')) $exchange->hidden = true;

			$exchange->save();

			return Redirect::route('exchange', ['exchange' => $exchange->slug]);
		}
	}

	public function getJoin(Exchange $exchange) {
		$this->layout->title = 'Join "' . $exchange->name . '"';
		$this->layout->nest('content', 'exchange.join', ['exchange' => $exchange]);
	}

	public function postJoin(Exchange $exchange) {
		$rules = array (
			'passphrase' => 'required|in:' . $exchange->passphrase,
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('exchange.join', ['exchange' => $exchange->slug])->withErrors($validator)->withInput(Input::all());
		} else {
			if (Auth::User()->wishlist()->count() == 0) {
				return Redirect::route('dashboard.edit.wishlist')->withErrors(['e' => 'You must add items to your wishlist before joining an exchange!']);				
			}
			$user = $exchange->participants()->whereUsername(Auth::User()->username)->count();
			if ($user == 0)
			{
				$exchange->participants()->attach(Auth::User());
				//Email
				Mail::send('emails.exchanges.join', array('exchange' => $exchange, 'user' => Auth::User()), function($message) use ($exchange)
				{
					$message->to($exchange->creator->email, $exchange->creator->username)->subject(Auth::User()->username . ' joined ' . $exchange->name . '!');
				});
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

		if ($exchange->creator == Auth::User()->id) {
			return Redirect::route('exchange', ['exchange' => $exchange->slug])->withErrors(['e' => 'You can\'t leave an exchange you created']);
		}
		$this->layout->title = 'Leave "' . $exchange->name . '"';
		$this->layout->nest('content', 'exchange.leave', ['exchange' => $exchange]);
	}

	public function postLeave(Exchange $exchange) {
		if ($exchange->processed) {
			return Redirect::route('exchange', ['exchange' => $exchange->slug])->withErrors(['e' => 'You can\'t delete a processed exchange']);
		}
		
		if ($exchange->creator == Auth::User()->id) {
			return Redirect::route('exchange', ['exchange' => $exchange->slug])->withErrors(['e' => 'You can\'t leave an exchange you created']);
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
