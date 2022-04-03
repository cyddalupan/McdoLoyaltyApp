<?php namespace App\Commands\home;

use App\Commands\Command;
use App\OurPost;

use Illuminate\Contracts\Bus\SelfHandling;

class ourPostToEvent extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($onGoing)
	{
		$this->onGoing = $onGoing;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$OurPosts = OurPost::all()->take(15);

		$allEvents = array();

		//convert OurPosts to events format
		foreach ($OurPosts as $ourpost) {
			$ourpost->title = $ourpost->post_name;
			$ourpost->description = $ourpost->post_description;
			$ourpost->img = $ourpost->post_image;
			$ourpost->shareable = 1;
			$ourpost->is_manager = 0;
			$ourpost->event_date = $ourpost->created_at;
			$ourpost->sharelink = $ourpost->post_link;
			$ourpost->logo = url().'/public/IMG/Alpha logo sample 100px.png';
			$ourpost->cyd_time = date('d F Y H:i:s', strtotime($ourpost->created_at));
			
			//insert to one array
			$timestamp = strtotime($ourpost->event_date);
			$allEvents[$timestamp] = $ourpost;
		}

		//fix and merge ongoing to ourposts
		foreach ($this->onGoing as $onGoingEvent) {

			$onGoingEvent->img = url().'/public/event_img/'.$onGoingEvent->img;
			$onGoingEvent->sharelink = url().'/page_event/'.$onGoingEvent->id;
			$onGoingEvent->cyd_time = date('d F Y H:i:s', strtotime($onGoingEvent->event_date));

			if($onGoingEvent->is_manager == 1)
				$onGoingEvent->logo = url().'/public/IMG/manager icon.png';
			else
				$onGoingEvent->logo = url().'/public/IMG/logo internal.png';


			//check ongoing if morethan 160characters
			if(strlen($onGoingEvent->description) > 160){
				$onGoingEvent->description = 
				'<form action="our_event" method="post">
					<input type="hidden" name="event_id" value="'.$onGoingEvent->id.'"/>'.
					substr($onGoingEvent->description,0,160).
					'...<input type="submit" class="event_continue" value="Contunue Reading" />
				</form>
				';
			}

			//insert to one array
			$timestamp = strtotime($onGoingEvent->event_date);
			$allEvents[$timestamp] = $onGoingEvent;
		}

		krsort($allEvents);

		return $allEvents;

	}

}
