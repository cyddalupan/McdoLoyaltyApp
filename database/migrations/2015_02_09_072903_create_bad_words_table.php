<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadWordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('bad_words', function($table)
	    {
	        $table->increments('bad_word_id');
			$table->string('bad_word', 160);
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
		Schema::drop('bad_words');
	}

}
