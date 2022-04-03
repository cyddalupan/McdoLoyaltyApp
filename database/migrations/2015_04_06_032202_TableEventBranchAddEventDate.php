<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableEventBranchAddEventDate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_branches', function($table)
		{
		    $table->dateTime('event_date')->after('branch_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('event_branches', function($table)
		{
		    $table->dropColumn('event_date');
		});
	}

}
