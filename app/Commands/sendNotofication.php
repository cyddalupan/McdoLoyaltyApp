<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

//facebook
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRequest;

class sendNotofication extends Command implements SelfHandling {

	protected $facebook_id,$access_token,$message;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($facebook_id,$access_token,$message)
	{
		$this->facebook_id = $facebook_id;
		$this->access_token = $access_token;
		$this->message = $message;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$app_access_token = $_ENV['app_id'] . '|' . $_ENV['app_secret'];
		FacebookSession::setDefaultApplication($_ENV['app_id'], $_ENV['app_secret']);
		FacebookSession::enableAppSecretProof(false);
		$session = new FacebookSession($this->access_token);
		/* PHP SDK v4.0.0 */
		/* make the API call */
		$request = new FacebookRequest(
			$session,
			'POST',
			'/'.$this->facebook_id.'/notifications',
			array (
				'href' => '/',
				'template' => $this->message,
				'access_token' => $app_access_token
			)
		);
		$response = $request->execute();
		return $this->facebook_id.'success';
	}

}
