<?php

use Illuminate\Database\Migrations\Migration;

class AddTimestampsToFixRequests extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fix_requests', function($table)
		{
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
		Schema::table('fix_requests', function($table)
		{
			$table->dropColumn('updated_at', 'created_at');
		});
	}

}