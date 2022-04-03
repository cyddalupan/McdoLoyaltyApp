<?php namespace App\Commands;

use App\Commands\Command;

use App\Events;

use Illuminate\Contracts\Bus\SelfHandling;

use Illuminate\Support\Facades\Bus;
use App\Commands\home\ourPostToEvent;

class onGoingAdminEvents extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$events['onGoing'] = Events::Admin()->OnGoing()->orderBy('event_date', 'desc')->take(5)->get();
		$events['upComming'] = Events::Admin()->Upcoming()->orderBy('event_date', 'desc')->take(5)->get();

		$events['onGoing'] = Bus::dispatch(new ourPostToEvent($events['onGoing']));

		return $events;
	}

}
