<?php

use Illuminate\Database\Migrations\Migration;

class AddingLocationsToFixRequests extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fix_requests', function($table){
			$table->text('city');
			$table->text('concelho');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fix_requests', function($table){
			$table->dropColumn('city');
			$table->dropColumn('concelho');
		});
	}

}