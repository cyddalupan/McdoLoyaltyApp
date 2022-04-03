<?php namespace App\Commands\branch;

use App\Commands\Command;

use App\User;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class ChangeUserBranchId extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $fb_id,$new_branch_id;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($fb_id,$new_branch_id)
	{
		$this->fb_id = $fb_id;
		$this->new_branch_id = $new_branch_id;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{

		$user = User::find($this->fb_id);
		$user->branch_id = $this->new_branch_id;
		$user->save();
	}

}
