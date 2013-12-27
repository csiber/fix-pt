<?php

use Illuminate\Database\Migrations\Migration;

class AddingActiveFieldToNotifiables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('notifiables', function($table){
			$table->boolean('active')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('notifiables', function($table){
			$table->dropColumn('active');
		});
	}

}