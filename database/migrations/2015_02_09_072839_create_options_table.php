<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('settings', function($table)
	    {
	        $table->increments('seting_id');
	        $table->string('setting_name', 160);
	        $table->string('setting_value', 160);
	        $table->timestamps();
	        $table->softDeletes();
	    });

        //insert option
        DB::table('settings')->insert(array(
			array(
				'setting_name' => 'find_word',
				'setting_value' => 'mcdo',
				'created_at' => new DateTime,
				'updated_at' => new DateTime
			),
			array(
				'setting_name' => 'last_scan',
				'setting_value' => 'Null',
				'created_at' => new DateTime,
				'updated_at' => new DateTime
			),
			array(
				'setting_name' => 'post_point',
				'setting_value' => '5',
				'created_at' => new DateTime,
				'updated_at' => new DateTime
			),
			array(
				'setting_name' => 'like_point',
				'setting_value' => '1',
				'created_at' => new DateTime,
				'updated_at' => new DateTime
			)
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('settings');
	}

}
