<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Surprise extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'surprises';
	public $timestamps = false;


	public function giver() {
		return $this->belongsTo('User');
	}

	public function gifty() {
		return $this->belongsTo('User');
	}

	public function exchange() {
		return $this->belongsTo('Exchange');
	}

	public function wishlist() {
		return $this->hasOne('Wishlist');
	}
}
