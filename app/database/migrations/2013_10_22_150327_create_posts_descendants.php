<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostsDescendants extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::create('fixrequests', function($table)
//        {
//            $table->increments('id');
//            $table->smallInteger('state');
//            $table->string('title', 128);
//            $table->unsignedInteger('post_id');
//            $table->foreign('post_id')->references('id')->on('posts');
//            
//        });
//
//        Schema::create('fixoffers', function($table)
//        {
//            $table->increments('id');
//            $table->unsignedInteger('post_id');
//            $table->unsignedInteger('fixrequest_id');
//            $table->foreign('post_id')->references('id')->on('posts');
//            $table->foreign('fixrequest_id')->references('id')->on('fixrequests');
//        });
//
//        Schema::create('promotionpages', function($table)
//        {
//            $table->increments('id');
//            $table->string('title', 128);
//            $table->unsignedInteger('post_id');
//            $table->foreign('post_id')->references('id')->on('posts');
//        });
//
//        Schema::create('directfixrequests', function($table)
//        {
//            $table->increments('id');
//            $table->boolean('accepted');
//            $table->unsignedInteger('post_id');
//            $table->unsignedInteger('promotionpage_id');
//            $table->foreign('post_id')->references('id')->on('posts');
//            $table->foreign('promotionpage_id')->references('id')->on('promotionpages');
//        });
//
//        Schema::create('comments', function($table)
//        {
//            $table->increments('id');
//            $table->unsignedInteger('post_id');
//            $table->unsignedInteger('fixrequest_id');
//            $table->unsignedInteger('question_id');
//            $table->unsignedInteger('promotionpage_id');
//            $table->foreign('post_id')->references('id')->on('posts');
//            $table->foreign('fixrequest_id')->references('id')->on('fixrequests');
//            $table->foreign('question_id')->references('id')->on('comments');
//            $table->foreign('promotionpage_id')->references('id')->on('promotionpages');
//        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::dropIfExists('fixrequests');
//        Schema::dropIfExists('comments');
//        Schema::dropIfExists('fixoffers');
//        Schema::dropIfExists('promotionpages');
//        Schema::dropIfExists('directfixrequests');
	}

}