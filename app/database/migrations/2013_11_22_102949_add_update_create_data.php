<?php

use Illuminate\Database\Migrations\Migration;

class AddUpdateCreateData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comments', function($t) {
                	$t->timestamps();
        	});	
	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comments', function($t) {
                	$t->dropColumn('created_at','updated_at');
        	});
	}

}
