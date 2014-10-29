<?php
class Wishlist extends Eloquent
{

	protected $table = 'wishlists';


	public function user() {
		return $this->belongsTo('User');
	}
}
