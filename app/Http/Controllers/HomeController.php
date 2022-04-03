<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//eloquent
use App\User;
use App\OtherPost;
use App\BadPost;
use App\UserPost;
use App\Settings;
use App\badWords;
use App\Branch_list;
use App\Events;
use App\event_branch;
use App\suggestions;
use App\AddPoints;

use Illuminate\Support\Facades\Validator;

//helpers
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Request; 
use Illuminate\Support\Facades\Session;

use datemodify\Cdf;

//commands
use Illuminate\Support\Facades\Bus;
use App\Commands\getUserType;
use App\Commands\getMyEvents;
use App\Commands\onGoingAdminEvents;
use App\Commands\approvePendingUser;

//age calculator
use Elnur\Era\AgeCalculator;
use Elnur\Era\Calendar;
use DateTime;

class HomeController extends Controller {

	private $selectedkeyword;

	public function index()
	{
		if(isset($_ENV['need_ssl'])){
			if($_ENV['need_ssl'] == 'yes'){
				//force the page to use ssl 
				if ($_SERVER["SERVER_PORT"] != 443) {
				    /*$redir = "Location: https://apps.facebook.com/" . $_ENV['app_id'];
				    header($redir);
				    exit();*/
				    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				    header("HTTP/1.1 301 Moved Permanently");
				    header("Location: $redirect");
				}
			}
		}

		$app_id = $_ENV['app_id'];
		$facebook_ids = User::all()->lists('facebook_id');

		return view('index')
			->with('facebook_ids', $facebook_ids)
			->with('app_id', $app_id);
	}

	public function home()
	{
		$app_id = $_ENV['app_id'];
		$facebook_ids = User::all()->lists('facebook_id');

		return view('home')
			->with('facebook_ids', $facebook_ids)
			->with('app_id', $app_id);
	}

	public function loginsession(){
		$input_all = Request::input('facebook_id');
		Session::put('facebook_id', $input_all);
		return 'User is Now Loged';
	}

	public function user(){
		$fb_id = session('facebook_id');
		$app_id = $_ENV['app_id'];
		$facebook_ids = User::all()->lists('facebook_id');

		//Get User Info
		$userInfo = User::find($fb_id);

		//Count Post
		$post_count = UserPost::where('facebook_id', $fb_id)->count();

		//Get Age
		$calendar = new Calendar;
		$ageCalculator = new AgeCalculator($calendar);
		$birthdate = new DateTime($userInfo->birthday);
		$age = $ageCalculator->age($birthdate);

		//Get Settings
		$expiresAt = Carbon::now()->addMinutes(60);
		$settings = Cache::remember('Settings', $expiresAt, function(){
			return Settings::all();
		});
		//convert named array
		foreach($settings as $setting)
			$settingArr[$setting->setting_name] = $setting->setting_value;

		$getUserType = Bus::dispatch(new getUserType($userInfo,$fb_id));

		$user_branch = '';
		if($userInfo->branch_id)
			$user_branch = Branch_list::find($userInfo->branch_id);
		
		//if branch has no event or not a member, get admin events
		if($userInfo->user_type == "xuser" || $userInfo->user_type == "xxuser" || $userInfo->user_type == "admin")
			$myEvents = Bus::dispatch(new onGoingAdminEvents());
		else
			$myEvents = Bus::dispatch(new getMyEvents($userInfo->branch_id));

		//add_points
		$addpoints = AddPoints::where('user_id',$fb_id)->get();
		$totaladdpoints = 0;
		foreach ($addpoints as $addpoint) {
			$totaladdpoints = $totaladdpoints + $addpoint->points;
		}

		return view('profile')
			->with('facebook_ids', $facebook_ids)
			->with('userInfo', $userInfo)
			->with('post_count', $post_count)
			->with('app_id', $app_id)
			->with('age', $age)
			->with('settingArr', $settingArr)
			->with('pending_count',$getUserType['pendingCount'])
			->with('UserBranch',$user_branch)
			->with('branches',$getUserType['branches'])
			->with('upcomingEvents',$myEvents['upComming'])
			->with('onGoingEvents',$myEvents['onGoing'])
			->withTotaladdpoints($totaladdpoints);
	}

	public function select_branch(){
		$input_all = Request::all();
		$input_all['facebook_id'];
    	$input_all['branch'];

		$Validator = Validator::make($input_all, [
	        'branch' => 'required|not_in:0'
	    ]);

	    if ($Validator->fails())
	    {
	        return redirect()->back()->withErrors($Validator->errors());
	    }

    	$user = User::find($input_all['facebook_id']);

    	//if testing branch
    	if ($input_all['branch'] == 1){
    		Bus::dispatch(new approvePendingUser($input_all['facebook_id']));
    	}

    	if($user->user_type != 'admin'){
	    	$user->user_type = 'xuser';
	    	$user->branch_id = $input_all['branch'];
	    	$user->save();
	    }

    	//if testing branch
    	if ($input_all['branch'] == 1){
    		return redirect('user/test-post');
    	}else{
    		return redirect('user')->with('message', 'Please Wait For Manager Approval. A notification will be Sent to your Account');
    	}

	}

	public function test_post(){
		$fb_id = session('facebook_id');
		//Get User Info
		$userInfo = User::find($fb_id);

		return view('test_post')->withUserinfo($userInfo);
	}

	public function update_user_post_to_my_wall(){
		$me_fb_id = Request::input('me_fb_id');
		$data = Request::input('data');
		
		$expiresAt = Carbon::now()->addMinutes(60);
		$switch_point = Cache::remember('posttowall_points', $expiresAt, function(){
		    return Settings::where('setting_name','posttowall_points')->pluck('setting_value');
		});

		$user = User::find($me_fb_id);

		if($data == 'yes')
			$newpoints = $user->points + $switch_point;
		else
			$newpoints = $user->points - $switch_point;

		$user->points = $newpoints;
		$user->post_to_my_wall = $data;
		$user->save();

		return "The switch is ".$data;
	}

	public function all_fb_id(){
		//get all user id
		$facebook_ids = User::lists('facebook_id');
		return json_encode($facebook_ids);
	}

	public function getLastScan($user_fb_id){
		//select the user and last scan column
		$user = User::find($user_fb_id);
		//convert to unix timestamp
		$timestamp = strtotime($user['last_scan']);
		
		if($timestamp < 0 || $timestamp == '')
			return 0;
		else
			return $timestamp;
	}

	public function savePost(){
		$inputdata = Request::all();

		//get current user
		$user = User::find($inputdata['fbid']);

		//check array for status and post
		if((is_array($inputdata['fbposts'])) && (is_array($inputdata['fbstatus']))){
			$allfbpost = array_merge($inputdata['fbposts'], $inputdata['fbstatus']);
		}
		elseif(is_array($inputdata['fbstatus'])){
			$allfbpost = $inputdata['fbstatus'];
		}
		elseif(is_array($inputdata['fbposts'])){
			$allfbpost = $inputdata['fbposts'];
		}

		$biggestdate = 0;

		//Save To DB
		foreach ($allfbpost as $fbpost) {
			//test the post where to go
			$messageoutput = $this->testmessage($fbpost);

			//other post table
			if($messageoutput == "Other") 
				$UserPost = new OtherPost;
			//goes to bad words table
			elseif($messageoutput == "BadWord")
				$UserPost = new BadPost;
			//goes to user post with keyword
			elseif($messageoutput == "KeyWord")
				$UserPost = new UserPost;

			//then save to db
			$UserPost->facebook_id = $inputdata['fbid'];
			//test if post_id has facebook_id 
			if(isset($fbpost['id'])){
				if (strpos($fbpost['id'],'_') !== false) {
					$UserPost->post_id = $fbpost['id'];
				}else{
					$UserPost->post_id = $inputdata['fbid']."_".$fbpost['id'];
				}
			}
			if(isset($fbpost['likes'])) $UserPost->likes = count($fbpost['likes']);
			if(isset($fbpost['privacy']['description'])) $UserPost->privacy = $fbpost['privacy']['description'];
			if(isset($fbpost['message'])) $UserPost->message = $fbpost['message'];
			if(isset($fbpost['story'])) $UserPost->story = $fbpost['story'];
			
			//check if post is auto
			if($user->post_to_my_wall == 'yes')
				$UserPost->type_auto = 1;
			else
				$UserPost->type_auto = 0;

			//add keyword
			if(isset($this->selectedkeyword))
				$UserPost->keyword = $this->selectedkeyword;

			//test if exist
			$TestUserPost = UserPost::find($UserPost->post_id);
			$TestUserBadPost = BadPost::find($UserPost->post_id);
			if((!isset($TestUserPost)) && (!isset($TestUserBadPost))){
				$UserPost->save();
			}

			//get the latest updated_time
			if(isset($fbpost['updated_time'])) {
				if(strtotime($fbpost['updated_time']) > $biggestdate){
					$biggestdate = strtotime($fbpost['updated_time']);
				}
			}
		}

		//update user
		$user->last_scan = date('Y-m-d H:i:s',$biggestdate);
		$user->save();
		
		//return result for javascript log
		return 'All New Post Save to DB!';

	}

	public function testmessage($fbpost){
		//if post has message
		if(isset($fbpost['message'])){
			return $this->check_for_bad_words($fbpost['message']);
		}else{
			return "Other";
		}
	}

	public function check_for_bad_words($message){
		//check for bad words
		$expiresAt = Carbon::now()->addMinutes(60);
		$allBadWords = Cache::remember('bad_word', $expiresAt, function(){
		    return badWords::lists('bad_word');
		});
		$lowercaseMessage = strtolower($message);
		$resultMessage = preg_replace("/[^a-z ]+/", "", $lowercaseMessage);
		$wordsperword = explode(" ",$resultMessage);
		if(count(array_intersect($wordsperword, $allBadWords)) > 0){
			return "BadWord";
		}else{
			return $this->check_for_keyword($resultMessage);
		}
	}

	public function check_for_keyword($resultMessage){
		//cache result
		$expiresAt = Carbon::now()->addMinutes(60);

		$keyword1 = Cache::remember('keyword1', $expiresAt, function(){
		    return Settings::where('setting_name','find_word')->pluck('setting_value');
		});
		$keyword2 = Cache::remember('keyword2', $expiresAt, function(){
		    return Settings::where('setting_name','find_word_2')->pluck('setting_value');
		});
		$keyword3 = Cache::remember('keyword3', $expiresAt, function(){
		    return Settings::where('setting_name','find_word_3')->pluck('setting_value');
		});
		$keyword4 = Cache::remember('keyword4', $expiresAt, function(){
		    return Settings::where('setting_name','find_word_4')->pluck('setting_value');
		});
		$keyword5 = Cache::remember('keyword5', $expiresAt, function(){
		    return Settings::where('setting_name','find_word_5')->pluck('setting_value');
		});

		
		if(strpos($resultMessage,$keyword1) !== false){
			$this->selectedkeyword = $keyword1;
		    return "KeyWord";
		}
		elseif(strpos($resultMessage,$keyword2) !== false){
			$this->selectedkeyword = $keyword2;
		    return "KeyWord";
		}
		elseif(strpos($resultMessage,$keyword3) !== false){
			$this->selectedkeyword = $keyword3;
		    return "KeyWord";
		}
		elseif(strpos($resultMessage,$keyword4) !== false){
			$this->selectedkeyword = $keyword4;
		    return "KeyWord";
		}
		elseif(strpos($resultMessage,$keyword5) !== false){
			$this->selectedkeyword = $keyword5;
		    return "KeyWord";
		}
		else{
			return "Other";
		}
	}

	

	public function all_post_id(){
		$fb_id = Request::input('fbid');

		$postIDs = UserPost::where('facebook_id', $fb_id)->lists('post_id');
		return json_encode($postIDs);
	}

	public function updateLikes(){
		//getting all update from json
		$ObjectLikeCount =  Request::all();
		//update the count of likes
		foreach($ObjectLikeCount as $perObjectLikeCount){
			$UserPost = UserPost::withTrashed()->find($perObjectLikeCount['postid']);
			$UserPost->likes = $perObjectLikeCount['likeCount'];
			$UserPost->comment_count = $perObjectLikeCount['comcount'];
			$UserPost->save();
		}
		return "Post->Likes Count and User->Points DB Updated";
	}

	public function insert_user(){
		$UserInput =  Request::all();

		$birthdayFormat = Cdf::convert_date_dmy_2_ymd($UserInput['userinfo']['birthday']);
		
		//insert data to DB
		$user = new User;
		$user->facebook_id 			= 	$UserInput['userinfo']['id'];
		$user->name 				= 	$UserInput['userinfo']['name'];
		$user->gender 				= 	$UserInput['userinfo']['gender'];
		$user->birthday 			= 	$birthdayFormat;
		$user->points 				= 	20;
		$user->long_access_token 	= 	$UserInput['newToken'];
		$user->user_type 			= 	'xuser';
		$user->post_to_my_wall		= 	'no';
		$user->save();
	
		echo 'New User Added!';
	}

	public function extend_token($cyd_token)
	{
		$extendedToken = file_get_contents('https://graph.facebook.com/oauth/access_token?client_id='.$_ENV['app_id'].'&client_secret='.$_ENV['app_secret'].'&grant_type=fb_exchange_token&fb_exchange_token='.$cyd_token);
		//explode data to get token
		$extendedToken2 = explode('&',$extendedToken);
		$extendedToken3 = $extendedToken2[0];
		$extendedToken4 = explode('=',$extendedToken3);
		return $extendedToken4[1];
	}

	public function renew_token($user_fb_id,$long_token_data)
	{
		User::where('facebook_id', $user_fb_id)
			->update(array('long_access_token' => $long_token_data));
		return 'Access Token Updated';
	}

	public function update_points(){
		//getting fbid by post method
		$fbid = Request::input('fbid');

		//setting expire time for options
		$expiresAt = Carbon::now()->addMinutes(60);
		//getting points per post
		$post_point = Cache::remember('post_point', $expiresAt, function(){
		    return Settings::where('setting_name','post_point')->pluck('setting_value');
		});
		//getting like points
		$like_point = Cache::remember('like_point', $expiresAt, function(){
		    return Settings::where('setting_name','like_point')->pluck('setting_value');
		});

		$switch_point = Cache::remember('posttowall_points', $expiresAt, function(){
		    return Settings::where('setting_name','posttowall_points')->pluck('setting_value');
		});
		
		$auto_post_points = Cache::remember('auto_post_points', $expiresAt, function(){
		    return Settings::where('setting_name','auto_post_points')->pluck('setting_value');
		});

		$comment_point = Cache::remember('comment_point', $expiresAt, function(){
		    return Settings::where('setting_name','comment_point')->pluck('setting_value');
		});

		//total points of user
		$totalpoints = 0;

		//getting new likes count
		$AllUserPost = UserPost::where('facebook_id', $fbid)->get();
		foreach ($AllUserPost as $userPost) {
			if(($userPost->privacy == 'Public') || ($userPost->privacy == 'Your friends')){
				$totalpoints = $totalpoints + $post_point;

				//add points if public
				if($userPost->privacy == 'Public')
					$totalpoints = $totalpoints + 3;

				//add likes to points
				$totalpoints = $totalpoints + ($userPost->likes * $like_point);

				//add comments to points
				$totalpoints = $totalpoints + ($userPost->comment_count * $comment_point);

				//add auto points
				if($userPost->type_auto == 1)
					$totalpoints = $totalpoints + $auto_post_points;
			}
		}

		//update user points
		$user = User::find($fbid);

		if($user->post_to_my_wall != 'no')
			$totalpoints = $totalpoints + $switch_point;

		$user->points = $totalpoints;
		$user->save();

		return '{
			"totalpost": '.$totalpoints.',
			"Message" : "User Points Updated'.$comment_point.'"
		}';
	}

	public function insert_suggestion(){
		$fb_id =  Request::input('fb_id');
		$suggestion_title =  Request::input('suggestion_title');
		$suggestion_content = Request::input('suggestion_content');

		$suggestion = new suggestions;
		$suggestion->code_name = $suggestion_title;
		$suggestion->description = $suggestion_content;
		$suggestion->facebook_id = $fb_id;
		$suggestion->save();

		echo 'Suggestion Saved';
	}

	public function get_event(){
		$event_id =  Request::input('event_id');

		$event = Events::find($event_id);
		$event->nice_date = date('d F Y | h:i:s A', strtotime($event->created_at));
		$event->toJson();

		return $event;
	}


	public function delete_user_post(){
		$user_post_post_id =  Request::input('user_post_post_id');
		$userpost = UserPost::find($user_post_post_id);
		$userpost->delete();
	}

	public function user_post_change_privacy(){
		$user_post_post_id =  Request::input('user_post_post_id');
		$privacy =  Request::input('privacy');

		$UserPost = UserPost::find($user_post_post_id);
		$UserPost->privacy = $privacy;
		$UserPost->save();
	}
}
