<?php
class Wishlist extends Eloquent
{

	protected $table = 'wishlists';


	public function user() {
		return $this->belongsTo('User');
	}

	public function items() {
		return $this->hasMany('Wishlistitems');
	}



}
