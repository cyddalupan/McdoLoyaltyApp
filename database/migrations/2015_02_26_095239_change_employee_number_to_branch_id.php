<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEmployeeNumberToBranchId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
		    $table->dropColumn('employee_number');
		});

		Schema::table('users', function($table)
		{
		    $table->integer('branch_id')->after('user_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::table('users', function($table)
		{
		    $table->dropColumn('branch_id');
		});

		Schema::table('users', function($table)
		{
		    $table->integer('employee_number')->after('user_type');
		});
	}

}
