<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

//facebook
use Facebook\FacebookRequest;

class checkAccessToken extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $facebook_id;
	protected $access_token;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($facebook_id,$access_token)
	{
		$this->facebook_id = $facebook_id;
		$this->access_token = $access_token;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		/* PHP SDK v4.0.0 */
		/* make the API call */
		$request = new FacebookRequest(
		  session('fbsession'),
		  'GET',
		  '/debug_token?input_token='.$this->facebook_id.'|'.$this->access_token
		);
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		/* handle the result */

  		echo "<pre>"; 
		print_r($graphObject); 
		echo "</pre>";
		echo "<br><br><br><br>";
	}

}
