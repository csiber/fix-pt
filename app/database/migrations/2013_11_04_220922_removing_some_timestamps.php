<?php

use Illuminate\Database\Migrations\Migration;

class RemovingSomeTimestamps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fix_requests_tags', function($table)
		{
			$table->dropColumn('updated_at', 'created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fix_requests_tags', function($table)
		{
			$table->timestamps();
		});
	}

}