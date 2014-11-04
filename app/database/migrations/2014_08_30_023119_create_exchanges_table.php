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
			$table->string('passphrase', 32);
			$table->decimal('spending_limit', 5, 0);
			$table->unsignedInteger('creator');
			$table->foreign('creator')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->boolean('processed')->default(false);
			$table->boolean('hidden')->default(false);
			$table->date('draw_at');
			$table->date('give_at');
			$table->string('slug');
			$table->softDeletes();
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
