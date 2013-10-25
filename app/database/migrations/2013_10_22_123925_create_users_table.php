<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('username', 128);
			$table->string('email');
			$table->string('password', 64);
			$table->string('name', 128)->nullable();
			$table->integer('permission');
			$table->timestamps();
                    $table->unique(array('username', 'email'));
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
	public function down()
	{
		Schema::dropIfExists('users');
    }

}