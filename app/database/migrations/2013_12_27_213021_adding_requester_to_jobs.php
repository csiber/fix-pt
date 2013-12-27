<?php

use Illuminate\Database\Migrations\Migration;

class AddingRequesterToJobs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("jobs", function($table){
			$table->integer('requester_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jobs', function($table){
			$table->dropColumn("requester_id");
		});
	}

}