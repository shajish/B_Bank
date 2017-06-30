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
			$table->integer('blood_group_id')->index('multiplecategoriespossible');
			$table->string('name', 40);
			$table->string('address2', 60);
			$table->integer('address1')->unique('email');
			$table->string('contacts', 70);
			$table->boolean('status');
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
		Schema::drop('user_profiles');
	}

}
