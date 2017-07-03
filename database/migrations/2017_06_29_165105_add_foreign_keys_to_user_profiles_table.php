<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_profiles', function(Blueprint $table)
		{
			$table->foreign('user_id', 'user_profiles_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('blood_group_id', 'user_profiles_ibfk_3')->references('id')->on('blood_groups')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('address1', 'user_profiles_ibfk_4')->references('id')->on('districts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_profiles', function(Blueprint $table)
		{
			$table->dropForeign('user_profiles_ibfk_2');
			$table->dropForeign('user_profiles_ibfk_3');
			$table->dropForeign('user_profiles_ibfk_4');
		});
	}

}
