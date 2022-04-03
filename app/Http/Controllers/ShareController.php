<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\OurPost;
use App\Settings;

//helper
use Request; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\DB;

class ShareController extends Controller {

	public function index()
	{
		//if post data has a value: meaning form is submited
		$p_name =  Request::input('p_name', '');

		$ptw_title = DB::table('settings')->where('setting_name', 'ptw_title')->pluck('setting_value');
		$ptw_description = DB::table('settings')->where('setting_name', 'ptw_description')->pluck('setting_value');
		$ptw_Link = DB::table('settings')->where('setting_name', 'ptw_Link')->pluck('setting_value');

		if($p_name != ''){
			//check if photo is Valid
			if (Request::hasFile('photo') && Request::file('photo')->isValid()){
			    $extension = Request::file('photo')->getClientOriginalExtension();
			    Request::file('photo')->move('uploads',  date('YmdHis').'.'.$extension);
			    
				$appID = $_ENV['app_id'];
				$sent_inputs['mess'] = trim(preg_replace('/\s\s+/', ' ', Request::input('p_mess')));
				$sent_inputs['name'] = Request::input('p_name');
				$sent_inputs['desc'] = trim(preg_replace('/\s\s+/', ' ', Request::input('p_desc')));
				$sent_inputs['link'] = Request::input('link');
				$sent_inputs['picture'] = URL::to('/').'/uploads/'.date('YmdHis').'.'.$extension;

				//put all data to session
				//to pass on blast page
				Session::put('post_inputs', $sent_inputs);

				$testUsers = User::tester()->get();

				return View('confirm')
					->with('appID', $appID)
					->with('sent_inputs', $sent_inputs)
					->with('users', $testUsers);

			}else{
				return View('share')
				->with('errorLog', "*Please Upload an Image.")
				->with('ptw_title', $ptw_title)
				->with('ptw_description', $ptw_description)
				->with('ptw_Link', $ptw_Link);
			}
		}else{
			return View('share')
			->with('errorLog', "")
			->with('ptw_title', $ptw_title)
			->with('ptw_description', $ptw_description)
			->with('ptw_Link', $ptw_Link);

		}
	}

	public function blast(){
		$post_inputs = Session::get('post_inputs');

		//insert to our_post TABLE
		$our_post = new OurPost;
		$our_post->post_name = $post_inputs['name'];
		$our_post->post_description = $post_inputs['desc'];
		$our_post->our_post = $post_inputs['mess'];
		$our_post->post_link = $post_inputs['link'];
		$our_post->post_image = $post_inputs['picture'];
		$our_post->save();

		$users = User::notTester()->PostToWall()->get();

		$appID = $_ENV['app_id'];
		
		return View('blast')
			->with('appID', $appID)
			->with('sent_inputs', $post_inputs)
			->with('users', $users);
	}

}
