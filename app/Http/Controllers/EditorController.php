<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;

use App\Settings;
use App\badWords;

use App\Http\Requests\badwordRequest;

class EditorController extends Controller {

	public function index()
	{
		$settings = Settings::all();

		//convert named array
		foreach($settings as $setting){
			$settingArr[$setting->setting_name] = $setting->setting_value;
		}

		return View('Editor')->with("settingArr",$settingArr);
	}

	public function save()
	{
		//keywords
		$updatesetting = Settings::find("find_word");
		$updatesetting->setting_value = Request::input("user_setwords");
		$updatesetting->save();
		$updatesetting = Settings::find("find_word_2");
		$updatesetting->setting_value = Request::input("user_setwords2");
		$updatesetting->save();
		$updatesetting = Settings::find("find_word_3");
		$updatesetting->setting_value = Request::input("user_setwords3");
		$updatesetting->save();
		$updatesetting = Settings::find("find_word_4");
		$updatesetting->setting_value = Request::input("user_setwords4");
		$updatesetting->save();
		$updatesetting = Settings::find("find_word_5");
		$updatesetting->setting_value = Request::input("user_setwords5");
		$updatesetting->save();

		$updatesetting = Settings::find("post_point");
		$updatesetting->setting_value = Request::input("user_point");
		$updatesetting->save();

		$updatesetting = Settings::find("like_point");
		$updatesetting->setting_value = Request::input("user_like");
		$updatesetting->save();

		$updatesetting = Settings::find("ptw_title");
		$updatesetting->setting_value = Request::input("user_name");
		$updatesetting->save();

		$updatesetting = Settings::find("ptw_description");
		$updatesetting->setting_value = Request::input("user_desc");
		$updatesetting->save();

		$updatesetting = Settings::find("ptw_Link");
		$updatesetting->setting_value = Request::input("user_link");
		$updatesetting->save();

		$updatesetting = Settings::find("posttowall_points");
		$updatesetting->setting_value = Request::input("switch_points");
		$updatesetting->save();

		$updatesetting = Settings::find("comment_point");
		$updatesetting->setting_value = Request::input("comment_point");
		$updatesetting->save();

		$updatesetting = Settings::find("auto_post_points");
		$updatesetting->setting_value = Request::input("auto_post_points");
		$updatesetting->save();
		
		return redirect('editor');

	}

	public function badwords()
	{
		$badwords = badWords::all();

		foreach ($badwords  as $badword) {
			$badword->delete_link = url().'/editor/delete_badword/'.$badword->bad_word_id;
		}

		return View('badwords')->withBadwords($badwords);
	}

	public function save_badword(badwordRequest $request){
		$badword = Request::input('badword');

		$addBadWord = new badWords;
		$addBadWord->bad_word = $badword;
		$addBadWord->save();

		return redirect()->back();
	}

	public function delete_badword($badword_id){
		$delete_badword = badWords::find($badword_id);
		$delete_badword->delete();

		return redirect()->back();
	}

	public function quick_settings(){

		$settings = Settings::all();
		//convert named array
		foreach($settings as $setting){
			$settingArr[$setting->setting_name] = $setting->setting_value;
		}

		return View('quickSettings')
			->with("settingArr",$settingArr);
	}

	public function quick_submit(){
		//keywords
		$updatesetting = Settings::find("find_word");
		$updatesetting->setting_value = Request::input("find_word");
		$updatesetting->save();
		$updatesetting = Settings::find("find_word_2");
		$updatesetting->setting_value = Request::input("find_word_2");
		$updatesetting->save();
		$updatesetting = Settings::find("find_word_3");
		$updatesetting->setting_value = Request::input("find_word_3");
		$updatesetting->save();
		$updatesetting = Settings::find("find_word_4");
		$updatesetting->setting_value = Request::input("find_word_4");
		$updatesetting->save();
		$updatesetting = Settings::find("find_word_5");
		$updatesetting->setting_value = Request::input("find_word_5");
		$updatesetting->save();

		return redirect()->back();
	}

}