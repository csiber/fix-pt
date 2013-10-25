<?php

use Illuminate\Database\Migrations\Migration;

class AddLastLoginColumnToUser extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function($table) {
                    $table->timestamp('last_login');
                });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}