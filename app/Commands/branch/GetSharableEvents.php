<?php namespace App\Commands\branch;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use App\event_branch;
use App\Events;

class GetSharableEvents extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $branchId;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($branchId)
	{
		$this->branchId =  $branchId;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$events = Events::Admin()->take(10)->get();

		foreach ($events as $event) {
			$eventBranch =  new event_branch;
			$eventBranch->events_id = $event->id;
			$eventBranch->branch_id = $this->branchId;
			$eventBranch->event_date = $event->event_date;
			$eventBranch->save();
		}
	}

}
