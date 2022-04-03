<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoryColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_post', function($table){
			$table->string('story',250)->after('message');
		});
		Schema::table('other_user_post', function($table){
			$table->string('story',250)->after('message');
		});
		Schema::table('bad_user_post', function($table){
			$table->string('story',250)->after('message');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_post', function($table){
		    $table->dropColumn('story');
		});
		Schema::table('other_user_post', function($table){
		    $table->dropColumn('story');
		});
		Schema::table('bad_user_post', function($table){
		    $table->dropColumn('story');
		});
	}

}
