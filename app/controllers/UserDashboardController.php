<?php
class UserDashboardController extends PageController
{
	public function getIndex() {
		$this->layout->title = 'Dashboard';
		$this->layout->nest('content', 'dashboard.main', []);
	}

	public function getEditWishlist() {
		$this->layout->title = 'Edit Wishlist';
		$this->layout->nest('content', 'dashboard.edit.wishlist', ['wishlist' => Auth::User()->wishlist()->first()]);
	}

	public function postEditWishlist() {
		$rules = array (
			'wishlist' => 'min:8|max:2048',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('dashboard.edit.wishlist', ['wishlist' => Auth::User()->wishlist()->get()])->withErrors($validator)->withInput(Input::all());
		} else {
			$wishlist = Wishlist::whereUserId(Auth::User()->id)->first();
			if ($wishlist) {
				$wishlist->wishlist = Input::get('wishlist');
				$wishlist->save();
			} else {
				$wishlist = new Wishlist;
				$wishlist->wishlist = Input::get('wishlist');
				Auth::User()->wishlist()->save($wishlist);
			}
			return Redirect::route('dashboard');
		}
	}

	public function getEditAccount()
	{
		$this->layout->title = 'Dashboard - Account';
		$this->layout->content = View::make('dashboard.account');
	}


	public function postEditAccount()
	{
		$data = Input::all();

		$rules = array(
			'email' => 'email',
			'about' => 'max:1024',
			'newpassword' => 'confirmed|min:8',
			'currency' => 'required|exists:currency,code',
			'password' => 'required'
			);
		if ( Auth::validate(array('username' => Auth::User()->username, 'password' => Input::get('password'))) )
		{
			$messages = array(
				'newpassword.min' => 'Your new password must be at least :min characters',
				'newpassword.confirmed' => 'Your new passwords do not match'
				);
			$validator = Validator::make($data, $rules, $messages);

			if ($validator->passes()) 
			{
				$user = Auth::User();				
				if (Input::has('email')) 
				{
					$user->email = Input::get('email');
				}
				if (Input::has('newpassword'))
				{
					$user->password = Hash::make(Input::get('newpassword'));
				}

				$user->currency = Input::get('currency');

				$user->save();
				return Redirect::route('dashboard');	
			}
		} else {
			return Redirect::route('dashboard.account')->withErrors(array('invalidpassword' => 'Invalid old password'));		
		}
		return Redirect::route('dashboard.account')->withErrors($validator);
	}
}