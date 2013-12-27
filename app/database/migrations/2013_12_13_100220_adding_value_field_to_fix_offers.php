<?php

use Illuminate\Database\Migrations\Migration;

class AddingValueFieldToFixOffers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fix_offers', function($table) {
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
		Schema::table('fix_offers', function($table) {
			$table->dropColumn('value');
		});
	}

}