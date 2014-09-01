<?php
class AuthController extends BaseController
{
	public function postLogin()
	{
		$rules = array (
				'username' => 'required',
				'password' => 'required|min:2'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
		} else {
			$userdata = array (
				'username' => Input::get('username'),
				'password' => Input::get('password')
				);
			if (Auth::attempt($userdata)) {
				return Redirect::intended('/');
			} else {
				return Redirect::to('login')->withErrors(array('failed' => 'Invalid Credentials'));
			}
		}
	}

	public function getLogin()
	{
		return View::make('login');
	} 

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

}