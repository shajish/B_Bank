<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_profiles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('oneusercanhaveoneprofile');
			$table->string('name', 40);
			$table->string('email', 40)->unique('email');
			$table->string('location', 60);
			$table->string('contacts', 70);
			$table->integer('category_id')->index('multiplecategoriespossible');
			$table->boolean('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_profiles');
	}

}
