<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events', function($table)
		{
		    $table->boolean('notify')->after('img');
		    $table->boolean('shareable')->after('img');
		    $table->integer('event_category_id')->after('img');
		    $table->integer('branch_ids')->after('img');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('events', function($table)
		{
		    $table->dropColumn('notify');
		    $table->dropColumn('shareable');
		    $table->dropColumn('event_category_id');
		    $table->dropColumn('branch_ids');
		});
	}

}
