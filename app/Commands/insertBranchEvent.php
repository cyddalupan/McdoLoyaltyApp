<?php namespace App\Commands;

use Request;

use App\Commands\Command;
use App\Events;
use App\User;
use App\event_branch;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use datemodify\Cdf;

class insertBranchEvent extends Command implements SelfHandling {

	 protected $branch_id;
	 protected $image;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($branch_id,$image)
	{
		$this->branch_id = $branch_id;
		$this->image = $image;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */

	public function handle()
	{		
		$allinput = Request::all();

		//conver date format to datetime
		$publish_date_time = Cdf::convert_date_dmy_2_ymd($allinput['publishdate']);

		//check if edit or insert
		if(Request::input('event_id') != '')
			$event = Events::find(Request::input('event_id'));
		else
			$event = new Events;

		$event->title = $allinput['title'];
		$event->description = $allinput['description'];
		if($this->image != '')
			$event->img = $this->image;
		$event->event_category_id = $allinput['event_category'];
		$event->shareable = $allinput['add_share_button'];
		$event->is_manager = 1;
		$event->event_date = $publish_date_time;
		$event->save();
		$eventid = $event->id;

		$event_branch = event_branch::where('events_id',$eventid)->delete();
		$event_branch = new event_branch;
		$event_branch->events_id = $eventid;
		$event_branch->branch_id = $this->branch_id;
		$event_branch->event_date = $publish_date_time;
		$event_branch->save();

		return exec('echo '.$eventid);
	}

}
