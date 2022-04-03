<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

use App\event_branch;
use App\event_category;

class getLocalBranchEvent extends Command implements SelfHandling {

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
		$event_branches = event_branch::Local($this->branch_id)->orderBy('event_date', 'desc')->get();
		//add events
		$event = array();
		foreach ($event_branches as $event_branch) {
			$event_branch->event = $event_branch->event;
 
			$event_branch->event->event_date_formated = date('F dS, Y',strtotime($event_branch->event->event_date));
			$event_branch->event->event_date_raw = date('m/d/Y',strtotime($event_branch->event->event_date));
			$event_branch->event->description_shortened = substr(strip_tags($event_branch->event->description), 0,100);
			if($event_branch->event->event_category_id == 0){
				$event_branch->event->event_category_id = 1;
			}
			$event_category = event_category::find($event_branch->event->event_category_id);
			$event_branch->event->event_category  = $event_category->category;

			if($event_branch->event->is_manager == 1){
				array_push($event, $event_branch->event);
			}
		}
		return $event;
	}

}
