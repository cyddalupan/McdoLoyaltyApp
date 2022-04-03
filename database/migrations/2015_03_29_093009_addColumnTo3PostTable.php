<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTo3PostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_post', function($table)
		{
		    $table->boolean('type_auto')->after('story');
		    $table->integer('comment_count')->after('story');
		    $table->string('keyword')->after('story');
		});

		Schema::table('bad_user_post', function($table)
		{
		    $table->boolean('type_auto')->after('story');
		    $table->integer('comment_count')->after('story');
		    $table->string('keyword')->after('story');
		});

		Schema::table('other_user_post', function($table)
		{
		    $table->boolean('type_auto')->after('story');
		    $table->integer('comment_count')->after('story');
		    $table->string('keyword')->after('story');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_post', function($table)
		{
		    $table->dropColumn('type_auto');
		    $table->dropColumn('comment_count');
		    $table->dropColumn('keyword');

		});

		Schema::table('bad_user_post', function($table)
		{
		    $table->dropColumn('type_auto');
		    $table->dropColumn('comment_count');
		    $table->dropColumn('keyword');

		});
		
		Schema::table('other_user_post', function($table)
		{
		    $table->dropColumn('type_auto');
		    $table->dropColumn('comment_count');
		    $table->dropColumn('keyword');

		});
	}

}
