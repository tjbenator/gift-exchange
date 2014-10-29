<?php
class UserController extends PageController
{
	public function getIndex(User $user)
	{
		$this->layout->title = $user->username;
		$this->layout->nest('content', 'user', ['user' => $user]);
	}
}
