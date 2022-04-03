<?php namespace App\Commands\events;
use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use App\event_branch;

class modifyBranchList extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($event_id,$Branch_list)
	{
		$this->event_id = $event_id;
		$this->Branch_list = $Branch_list;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$locations = event_branch::where('events_id',$this->event_id)->lists('branch_id');

		foreach($this->Branch_list as $branch){
			if(in_array($branch->id,$locations)){
				$branch->checked = 'checked';
			}else{
				$branch->checked = '';
			}

		}

		return $this->Branch_list;

	}

}
