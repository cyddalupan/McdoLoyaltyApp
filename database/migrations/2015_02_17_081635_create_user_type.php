<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_types', function($table)
		{
		    $table->increments('id');
		    $table->string('types', 250);
		});

		DB::table('user_types')->insert([
		    ['types' => 'admin'],
		    ['types' => 'branchManager'],
		    ['types' => 'tester'],
		    ['types' => 'user']
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_types');
	}

}
