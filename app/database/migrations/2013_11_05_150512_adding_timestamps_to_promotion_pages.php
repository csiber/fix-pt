<?php

use Illuminate\Database\Migrations\Migration;

class AddingTimestampsToPromotionPages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('promotion_pages', function($table){
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
		Schema::table('promotion_pages', function($table){
			$table->dropColumn("created_at", "updated_at");
		});
	}

}