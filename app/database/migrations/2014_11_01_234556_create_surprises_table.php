<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurprisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('surprises', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('exchange_id');
			$table->foreign('exchange_id')->references('id')->on('exchanges');
			$table->unsignedInteger('giver_id');
			$table->foreign('giver_id')->references('id')->on('users');
			$table->unsignedInteger('gifty_id');
			$table->foreign('gifty_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('surprises');
	}

}
