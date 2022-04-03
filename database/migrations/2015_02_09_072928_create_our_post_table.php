<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOurPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('our_post', function($table)
	    {
	        $table->bigIncrements('our_post_id');
	        $table->string('post_name', 100);
	        $table->text('post_description');
	        $table->text('our_post');
	        $table->string('post_link', 400);
	        $table->string('post_image', 400);
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
		Schema::drop('our_post');
	}

}
