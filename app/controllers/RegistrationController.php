<?php
class RegistrationController extends BaseController
{
	public function postRegister() 
	{
		$data = Input::all();

		$rules = array(
			'username' => 'required|min:3|max:32',
			'email' => 'required|email',
			'password' => 'required|confirmed|min:8'
			);

		$validator = Validator::make($data, $rules);
		
		if ($validator->passes()) 
		{
			$user = new User;
			$user->username = Input::get('username');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			Auth::login($user);
			return Redirect::to('/');	
		}
		return Redirect::route('register')->withErrors($validator);	
		
		
	}

	public function getRegister()
	{
		return View::make('register');
	}
}