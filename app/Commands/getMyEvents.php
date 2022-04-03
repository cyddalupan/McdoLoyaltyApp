<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

use App\event_branch;


use Illuminate\Support\Facades\Bus;
use App\Commands\home\ourPostToEvent;

class getMyEvents extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($branch_id)
	{
		$this->branch_id = $branch_id;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		//get events id for this branch
		$my_event_branches = event_branch::where('branch_id',$this->branch_id)->orderBy('event_date', 'desc')->take(15)->get();

		//add events on the array
		$onGoing =  array();
		$upComming =  array();
		foreach ($my_event_branches as $my_event_branch) {

			if(strtotime($my_event_branch->event->event_date) <= strtotime(date('Y-m-d'))){
				array_push($onGoing,(object)$my_event_branch->event);
			}else{
				array_push($upComming,(object)$my_event_branch->event);
			}
		}

		$onGoing = Bus::dispatch(new ourPostToEvent($onGoing));

		//add to one data
		$events['onGoing'] = $onGoing;
		$events['upComming'] = $upComming;
		return $events;
	}

}
