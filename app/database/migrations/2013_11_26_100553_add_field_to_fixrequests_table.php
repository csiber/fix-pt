<?php

use Illuminate\Database\Migrations\Migration;

class AddFieldToFixrequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fix_requests', function($table){
			$table->integer('views');
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
			$table->dropColumn('views');
		});
	}

}