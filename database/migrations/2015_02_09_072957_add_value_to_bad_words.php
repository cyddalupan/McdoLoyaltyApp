<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValueToBadWords extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('bad_words')->insert(array(
		    array('bad_word' => 'bitch'),
		    array('bad_word' => 'gago'),
		    array('bad_word' => 'fuck'),
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('bad_words')->where('bad_word', '=', 'bitch')->delete();
		DB::table('bad_words')->where('bad_word', '=', 'gago')->delete();
		DB::table('bad_words')->where('bad_word', '=', 'fuck')->delete();
	}

}
