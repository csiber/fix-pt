<?php

use Illuminate\Database\Migrations\Migration;

class AddingFieldsToFixRequests extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fix_requests', function($table)
		{
			$table->text('description');
			$table->integer('daysForOffer');
			$table->integer('value');
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
			$table->dropColumn(
				'description',
				'daysForOffer',
				'value'
			);
		});
	}

}