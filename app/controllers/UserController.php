<?php
class UserController extends PageController
{

	public function getUserIndex(User $user)
	{
		$this->layout->title = $user->username;
		$this->layout->nest('content', 'user', ['user' => $user]);
	}

}
