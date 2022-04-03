<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherUserPost extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('other_user_post', function($table)
	    {
	        $table->bigIncrements('other_post_id');
	        $table->bigInteger('facebook_id');
	        $table->string('post_id', 200);
	        $table->integer('likes');
	        $table->string('privacy', 50);
	        $table->text('message');
	        $table->timestamps();
	        $table->softDeletes();
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('other_user_post');
	}

}