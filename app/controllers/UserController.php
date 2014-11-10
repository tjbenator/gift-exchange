<?php
class UserController extends PageController {

	public function show(User $user)
	{
		$this->layout->title = $user->username;
		$this->layout->nest('content', 'user', ['user' => $user]);
	}

	public function getUserList()
	{
		$this->layout->title = 'Users';
		$users = User::all();
		$this->layout->nest('content', 'users', ['users' => $users]);
	}
}
