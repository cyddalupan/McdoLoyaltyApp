<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Events;

use Illuminate\Support\Facades\Request;

class EventPageController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($event_id)
	{
		$event = Events::find($event_id);
		$app_id = $_ENV['app_id'];

		//check if upcoming
		if(strtotime($event->event_date) > strtotime(date('Y-m-d')))
			return redirect('/');

		//cant view direcly if not sharable
		if($event->shareable == 0)
			return redirect('/');

		return view('page_event')
			->with('event',$event)
			->with('app_id',$app_id);
	}

	public function ourEvent(){
		$event_id = Request::input('event_id');

		$event = Events::find($event_id);
		$app_id = $_ENV['app_id'];
		
		return view('page_event')
			->with('event',$event)
			->with('app_id',$app_id);
	}

}