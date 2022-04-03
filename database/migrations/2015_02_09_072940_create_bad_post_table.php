<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('bad_post', function($table)
	    {
	        $table->bigIncrements('bad_post_id');
	        $table->bigInteger('user_id');
	        $table->bigInteger('facebook_id');
	        $table->text('bad_post');
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
		Schema::drop('bad_post');
	}

}
