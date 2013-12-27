<?php

use Illuminate\Database\Migrations\Migration;

class ChangeJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('jobs');
		Schema::create('jobs', function($table)
		{
			$table->increments('id');
			$table->integer('fix_request_id');
			$table->integer('user_id');
			$table->integer('notifiable_id');
			$table->integer('rate_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}