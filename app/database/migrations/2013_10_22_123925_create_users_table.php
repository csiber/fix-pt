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
			$table->string('username', 128)->nullable();
			$table->string('email');
			$table->string('password');
			$table->string('name')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->smallInteger('confirmed')->default(0);
			$table->integer('user_type');
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