<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wishlistitems', function($table)
		{
			$table->increments('id');
			$table->string('name', 32);
			$table->string('URL')->default(null);
			$table->unsignedInteger('wishlist_id');
			$table->foreign('wishlist_id')->references('id')->on('wishlists')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wishlistitems');
	}

}
