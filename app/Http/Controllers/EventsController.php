<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreEventRequest;

use Request;

use App\Events;
use App\event_category;
use App\Branch_list;
use App\event_branch;

use datemodify\Cdf;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
//Commands
use App\Commands\events\modifyBranchList;
use Illuminate\Support\Facades\Bus;

class EventsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$events = Events::Admin()->orderBy('event_date', 'desc')->get();
		
		return view('events')->with('events',$events);
	}

	public function selectBranch(){
		$Branch_list = Branch_list::all();

		return view('selectBranch')->withBranches($Branch_list);
	}

	public function new_event(){
		//old inputs|if validation fail
		$old = Request::old();
		$event_categories = event_category::all();
		$Branch_list = Branch_list::all();

		if(isset($old['locations'])){
			foreach($Branch_list as $branch){
				if(in_array($branch->id,$old['locations'])){
					$branch->checked = 'checked';
				}else{
					$branch->checked = '';
				}
			}
		}

		$selectedEvent = '';
		if(isset($old['event_category']))
			$selectedEvent = $old['event_category'];

		return view('new_event')
			->withOld($old)
			->withEvent_categories($event_categories)
			->with('selectedEvent',$selectedEvent)
			->withBranches($Branch_list);
	}

	public function insert(StoreEventRequest $request){
		$allinput = Request::all();

		//select if new event or edit
		if($allinput['event_id'] != ''){
			$events = Events::find($allinput['event_id']);
		}else{
			$events = new Events;
		}

		$events->title 			= $allinput['title'];
		$events->description 	= $allinput['description'];

		//Validate Image
		if (Request::hasFile('photo') && Request::file('photo')->isValid()){
		    $file = Request::file('photo');
		    $image_name = date('Y_m_d_his')."_".$file->getClientOriginalName();
			Request::file('photo')->move("public/event_img/", $image_name);
			$events->img = $image_name;
		}else{
			//test if its a new event
			if($allinput['event_id'] == ''){
				return redirect()->back()->withErrors("Please Upload an Image")->withInput();
			}
		}

		//event date
		$publish_date_time = Cdf::convert_date_dmy_2_ymd($allinput['publishdate']);
		$events->event_date = $publish_date_time;

		$events->shareable = 1;
		$events->is_manager = 0;
		$events->event_category_id = $allinput['event_category'];

		//save the data
		$events->save();

		$locations = $allinput['locations'];

		//delete event_branch first, to avoid double data
		event_branch::where('events_id', $events->id)->delete();

		foreach ($locations as $location) {
			$event_branch = new event_branch;
			$event_branch->events_id = $events->id;
			$event_branch->branch_id = $location;
			$event_branch->event_date = $publish_date_time;
			$event_branch->save();
		}

		return redirect('events');
	}

	public function edit($event_id){
		$event = Events::find($event_id);

		$event_categories = event_category::all();
		$Branch_list = Branch_list::all();
		
		if(isset($event->event_category_id))
			$selectedEvent = $event->event_category_id;

		$Branch_list = Bus::dispatch(new modifyBranchList($event_id,$Branch_list));
		$event->event_date = date('m/d/Y',strtotime($event->event_date));
		$event->change_image_link = url().'/events/change_image/'.$event_id;

		return view('new_event')
			->with('event',$event)
			->with('event_categories',$event_categories)
			->with('selectedEvent',$selectedEvent)
			->withBranches($Branch_list);
	}

	public function delete($event_id){
		$event_branches = event_branch::where('events_id',$event_id)->delete();
		$event = Events::find($event_id);
		$event->delete();
		return redirect('events')->with('event_id',$event_id)->with('event_title',$event->title);
	}
	
	public function restore($event_id){
		Events::withTrashed()->find($event_id)->restore();
		return redirect('events');
	}

	public function change_image($event_id){
		//protected $layout = 'DashPlate';

		$event = Events::find($event_id);

		return view('change_image')
			->withEvent($event);
	}

	public function change_image_submit(){

		//Validate Image
		if (Request::hasFile('photo') && Request::file('photo')->isValid()){}else{
			//test if its a new event
			return redirect()->back()->withErrors("Please Upload an Image")->withInput();
		}

		$file = Request::file('photo');
	    $image_name = date('Y_m_d_his')."_".$file->getClientOriginalName(); 
		Request::file('photo')->move("public/event_img/", $image_name);

		$event = Events::find(Request::input('eventid'));
		$event->img = $image_name;
		$event->save();

		return redirect()->back();

	}
}
