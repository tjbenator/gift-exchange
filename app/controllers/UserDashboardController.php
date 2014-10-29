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
}