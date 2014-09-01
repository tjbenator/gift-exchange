<?php
class UserController extends BaseController
{
	public function getIndex(User $user)
	{
		return '';
	}

	public function getWishlists(User $user) {
		return View::make('wishlist.main')->with('user', $user);
	}
}
