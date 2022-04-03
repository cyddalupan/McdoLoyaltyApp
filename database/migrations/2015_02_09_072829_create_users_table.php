<?php

use Illuminate\Database\Schema\Blueprint;
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
	        $table->bigIncrements('user_id');
	        $table->bigInteger('facebook_id');
	        $table->string('name', 300);
	        $table->string('gender', 10);
	        $table->date('birthday');
	        $table->integer('points');
	        $table->text('long_access_token');
	        $table->string('user_type', 50);
		    $table->string('employee_number', 300);
		    $table->dateTime('last_scan');
	        $table->string('post_to_my_wall', 10);
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
		Schema::drop('users');
	}

}
