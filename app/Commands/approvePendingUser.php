<?php namespace App\Commands;

use Illuminate\Support\Facades\Bus;
use App\Commands\Command;
use App\Commands\sendNotofication;

use Illuminate\Contracts\Bus\SelfHandling;

use App\User;

class approvePendingUser extends Command implements SelfHandling {

	protected $user_id;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($user_id)
	{
		$this->user_id = $user_id;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$user = User::find($this->user_id);
		$message = "You have been accepted as registered employee in your applied branch. Please see your profile.";
		$access_token = $user->long_access_token;
		Bus::dispatch(new sendNotofication($this->user_id,$access_token,$message));
		
		$user->user_type = 'user';
		$user->save();
	}

}
