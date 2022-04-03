<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostToUserInfoToSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('settings')->insert([
		    [
		    	'setting_name' => 'ptw_title', 
		    	'setting_value' => 'LOYALTY APP'
		    ],
		    [
		    	'setting_name' => 'ptw_description', 
		    	'setting_value' => 'Share your Incredible Mcdo moments and be part of the online community fever.
Create your very own #hashtag McDO in your post and include your McPhoto of the day.
Earn loyalty points and get a chance to win exclusive treats and discouts.'
		    ],
		    [
		    	'setting_name' => 'ptw_Link', 
		    	'setting_value' => 'https://www.facebook.com/journyjettsibal/app_314709202059299'
		    ],
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('settings')->where('setting_name', 'ptw_title')->delete();
		DB::table('settings')->where('setting_name', 'ptw_description')->delete();
		DB::table('settings')->where('setting_name', 'ptw_Link')->delete();
	}

}
