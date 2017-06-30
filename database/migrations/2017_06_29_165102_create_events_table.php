<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('status_id')->index('status_id');
			$table->integer('user_id')->index('user_id');
			$table->string('title', 100);
			$table->text('details', 65535);
			$table->text('location', 65535);
			$table->date('date');
			$table->string('duration', 30);
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
		Schema::drop('events');
	}

}
