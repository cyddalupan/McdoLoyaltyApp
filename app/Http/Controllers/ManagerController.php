<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreBranchEventRequest;

//model
use App\User;
use App\Events;
use App\event_category;
use App\Branch_list;
use App\event_branch;


use Request;

use Illuminate\Support\Facades\Validator;

//commands
use Illuminate\Support\Facades\Bus;
use App\Commands\testValidPhoto;
use App\Commands\insertBranchEvent;
use App\Commands\notifyBranch;
use App\Commands\getLocalBranchEvent;
use App\Commands\approvePendingUser;

//session
use Illuminate\Support\Facades\Session;
//facebook
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRequest;

class ManagerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index($manager_id)
	{
		$branch = User::find($manager_id)->branch_list;

		//test if manager has a branch
		if($branch == '')
			die("You don't Have a Branch to Manage Yet. Please Contact The Admin");

		$pendingUsers = User::pending()->myBranch($manager_id)->get();
		$approvedUsers = User::approved()->myBranch($manager_id)->get();

		//getLocalBranch
		$events = Bus::dispatch(new getLocalBranchEvent($branch->id));

		return view('pending')
			->with('pendingUsers',$pendingUsers)
			->with('approvedUsers',$approvedUsers)
			->with('manager_id',$manager_id)
			->with('events',$events);
	}

	public function not_on_my_branch($joiner_id,$manager_id)
	{
		$user = User::find($joiner_id);
		$user->user_type = 'xxuser';
		$user->branch_id = 0;
		$user->save();

		return redirect('manager-admin/'.$manager_id);
	}

	public function yes_accept_user($joiner_id,$manager_id)
	{
		Bus::dispatch(new approvePendingUser($joiner_id));
		return redirect('manager-admin/'.$manager_id);
	}

	public function edit_events($manager_id){

		return redirect('manager-admin/add-event/'.$manager_id)->withInput();
	}

	public function add_events($manager_id){
		$old = Request::old();
		$event_categories = event_category::get();

		if(isset($old['event_id']))
			$change_image_link = url().'/manager-admin/change_image/'.$old['event_id'].'/'.$manager_id;
		else
			$change_image_link = '';

		return view('add_event')
			->with('manager_id',$manager_id)
			->with('old',$old)
			->with('event_categories',$event_categories)
			->withChange_image_link($change_image_link);
	}

	public function submit_events(StoreBranchEventRequest $request){

		//test if hte photo uploading is valid
		$image_name = '';
		if(Request::input('event_id') == ''){
			Bus::dispatch(new testValidPhoto());
		    //upload photo
		    $file = Request::file('photo');
		    $image_name = date('Y_m_d_his')."_".$file->getClientOriginalName();
			$file->move("public/event_img/", $image_name);
		}

		//get branch
		$branch = User::find(Request::input('manager_id'))->branch_list;

		//insert input to db
		$eventid = Bus::dispatch(new insertBranchEvent($branch->id,$image_name));

		if(Request::input('event_id') == '')
			return redirect('manager-admin/send_notification/'.Request::input('manager_id').'/'.$eventid);
		else
			return redirect('/manager-admin/'.Request::input('manager_id'));
	}

	public function send_notification($manager_id,$event_id){
		$event = Events::find($event_id);
		$approvedUsers = User::approved()->myBranch($manager_id)->get();

		return view('send_notification')
			->withApproved_users($approvedUsers)
			->withEvent($event)
			->withManager_id($manager_id);
	}

	public function send_notification_contact_fb(){
		$facebook_id 	= Request::input('facebook_id');
		$access_token 	= Request::input('access_token');
		$message 		= Request::input('message');

		//send notification
		Bus::dispatch(
			new sendNotofication(
				$facebook_id,
				$access_token,
				$message
			)
		);

		echo $facebook_id.'success';
	}

	public function delete($event_id){

		$event_branches = event_branch::where('events_id',$event_id)->delete();

		$event = Events::find($event_id);
		$event->delete();


		return redirect()->back();
	}

	public function change_image($event_id,$manager_id){

		$event = Events::find($event_id);

		return view('change_image_manager')
			->withEvent($event)
			->withManagerid($manager_id);
	}

}