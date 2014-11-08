<?php
//use Illuminate\Contracts\Auth\User;
class UserDashboardController extends PageController {

	public function getIndex()
	{
		$this->layout->title = 'Dashboard';
		$this->layout->nest('content', 'dashboard.main', ['user' => $this->user]);
	}

	public function getWishlist()
	{
		$this->layout->title = 'Edit Wishlist';
		$this->layout->nest('content', 'dashboard.wishlist', ['user' => $this->user, 'wishlist' => $this->user->wishlist()->first()]);
	}

	public function postWishlist()
	{
		$rules = array(
			'wishlist' => 'min:8|max:2048',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::route('dashboard.edit.wishlist', ['wishlist' => $this->user->wishlist()->get()])->withErrors($validator)->withInput(Input::all());
		}
		else
		{
			$wishlist = Wishlist::whereUserId($this->user->id)->first();

			if ($wishlist)
			{
				$wishlist->wishlist = Input::get('wishlist');
				$wishlist->save();
			}
			else
			{
				$wishlist = new Wishlist;
				$wishlist->wishlist = Input::get('wishlist');
				$this->user->wishlist()->save($wishlist);
			}

			return Redirect::route('dashboard');
		}
	}

	public function getAccount()
	{
		$this->layout->title = 'Dashboard - Account';
		$this->layout->nest('content', 'dashboard.account', ['user' => $this->user]);

	}


	public function postAccount()
	{
		$data = Input::all();

		$rules = array(
			'email' => 'email',
			'about' => 'max:1024',
			'newpassword' => 'confirmed|min:8',
			'currency' => 'required|exists:currency,code',
			'password' => 'required'
		);

		if ( Auth::validate(array('username' => $this->user->username, 'password' => Input::get('password'))) )
		{
			$messages = array(
				'newpassword.min' => 'Your new password must be at least :min characters',
				'newpassword.confirmed' => 'Your new passwords do not match'
			);

			$validator = Validator::make($data, $rules, $messages);

			if ($validator->passes()) 
			{
				if (Input::has('email')) 
				{
					$this->user->email = Input::get('email');
				}

				if (Input::has('newpassword'))
				{
					$this->user->password = Hash::make(Input::get('newpassword'));
				}

				$this->user->currency = Input::get('currency');
				Currency::setCurrency($this->user->currency);
				$this->user->save();

				return Redirect::route('dashboard');	
			}
		}
		else
		{
			return Redirect::route('dashboard.account')->withErrors(array('invalidpassword' => 'Invalid old password'));
		}
		
		return Redirect::route('dashboard.account')->withErrors($validator);
	}
}
