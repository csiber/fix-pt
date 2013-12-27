<?php

use Illuminate\Database\Migrations\Migration;

class AddColumnsToUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
            $table->string('phone_number')->nullable()->after('email');  
            $table->string('user_image')->nullable()->after('phone_number');
            $table->integer('distict_id')->nullable()->after('user_image');
            $table->integer('concelho_id')->nullable()->after('distict_id');    
            $table->index('distict_id');
            $table->index('concelho_id');
            $table->foreign('distict_id')->references('id')->on('concelhos');
            $table->foreign('concelho_id')->references('id')->on('districts');
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