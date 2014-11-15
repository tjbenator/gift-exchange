<?php
class RegistrationController extends PageController {

	public function postRegister() 
	{
		$data = Input::all();

		$rules = array(
			'username' => 'required|min:3|max:32',
			'email' => 'required|email',
			'password' => 'required|confirmed|min:8',
			'currency' => 'required|exists:currency,code'
		);

		$validator = Validator::make($data, $rules);
		
		if ($validator->passes()) 
		{
			$user = new User;
			$user->username = Input::get('username');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->currency = Input::get('currency');
			$user->save();
			Auth::login($user);
			Mail::send('emails.auth.registration', array('user' => $user), function($message) use ($user)
			{
				$message->to($user->email, $user->username)->subject($user->username . '! Welcome!');
			});
			Session::flash('messages', ['Make sure to check your spam for messages from ' . Config::get('mail.from.address')]);
			return Redirect::to('/');	
		}

		return Redirect::route('register')->withErrors($validator);			
	}

	public function getRegister()
	{
		$this->layout->title = 'Register';
		$this->layout->content = View::make('register');
	}

}