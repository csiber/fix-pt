<?php

use Illuminate\Database\Migrations\Migration;

class ChangingJobsTableAgain extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jobs', function($table){
			$table->dropColumn('user_id');
			$table->integer('fix_offer_id');
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
			$table->dropColumn('fix_offer_id');
			$table->integer('user_id');
		});
	}

}