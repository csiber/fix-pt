<?php

use Illuminate\Database\Migrations\Migration;

class RemovingRateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('rates');
		Schema::table('jobs', function($table){
			$table->dropColumn('rate_id');
			$table->boolean('rated');
			$table->integer('score');
			$table->integer('fixer_id');
			$table->text('feedback');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('rates', function($table){

		});
		Schema::table('jobs', function($table){
			$table->dropColumn('rated');
			$table->dropColumn('score');
			$table->dropColumn('fixer_id');
			$table->dropColumn('feedback');
			$table->integer('rate_id');
		});
	}

}