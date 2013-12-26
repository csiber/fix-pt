<?php

use Illuminate\Database\Migrations\Migration;

class AddingLocationsToPromotionPages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('promotion_pages', function($table){
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
		Schema::table('promotion_pages', function($table){
			$table->dropColumn('city');
			$table->dropColumn('concelho');
		});
	}

}