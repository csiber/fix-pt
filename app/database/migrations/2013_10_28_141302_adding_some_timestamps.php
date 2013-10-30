<?php

use Illuminate\Database\Migrations\Migration;

class AddingSomeTimestamps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::transaction(function()
		{
			Schema::table('tags', function($table)
			{
				$table->timestamps();
			});

			Schema::table('fix_requests_tags', function($table)
			{
				$table->timestamps();
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::transaction(function()
		{
			Schema::table('tags', function($table)
			{
				$table->dropColumn('updated_at', 'created_at');
			});

			Schema::table('fix_requests_tags', function($table)
			{
				$table->dropColumn('updated_at', 'created_at');
			});
		});
	}
}