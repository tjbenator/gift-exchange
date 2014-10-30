<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exchanges', function($table)
		{
			$table->increments('id');
			$table->string('name', 32);
			$table->longText('description');
			$table->unsignedInteger('creator');
			$table->foreign('creator')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->boolean('hidden');
			$table->boolean('processed')->default(false);
			$table->integer('draw_at');
			$table->string('slug');
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
		Schema::drop('exchanges');
	}

}
