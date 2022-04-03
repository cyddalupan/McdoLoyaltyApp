<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAddPointsIntToBigInt extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('add_points', function($table)
		{
		    $table->dropColumn('admin_id');
		    $table->dropColumn('user_id');
		    $table->dropColumn('points');
		});

		Schema::table('add_points', function($table)
		{
		    $table->bigInteger('points')->after('id');
		    $table->bigInteger('user_id')->after('id');
		    $table->bigInteger('admin_id')->after('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('add_points', function($table)
		{
		    $table->dropColumn('admin_id');
		    $table->dropColumn('user_id');
		    $table->dropColumn('points');
		});

		Schema::table('add_points', function($table)
		{
		    $table->integer('points')->after('id');
		    $table->integer('user_id')->after('id');
		    $table->integer('admin_id')->after('id');
		});
	}

}
