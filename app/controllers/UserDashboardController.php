<?php
class UserDashboardController extends BaseController
{
	public function getIndex() {
		return View::make('dashboard');
	}
}