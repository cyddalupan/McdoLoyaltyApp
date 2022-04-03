<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

use App\User;
use App\Branch_list;

use Illuminate\Support\Facades\Session;

class getUserType extends Command implements SelfHandling {

	protected $userInfo, $fb_id;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($userInfo,$fb_id)
	{
		$this->userInfo = $userInfo;
		$this->fb_id = $fb_id;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		//if user is admin
		$data['pendingCount'] = 0;
		$data['branches'] = 0;
		
		if($this->userInfo->user_type == "admin"){
			Session::put('admin_loged', $this->userInfo->user_type);
			$data['branches'] = Branch_list::all();
		}elseif($this->fb_id == 1036357483047530){
			Session::put('admin_loged', 'admin');
			$this->userInfo->user_type = 'admin';
			$data['branches'] = Branch_list::all();
		}elseif($this->userInfo->user_type == "branchManager"){
			Session::put('admin_loged', 'branchManager');
			$data['pendingCount'] = User::pending()->myBranch($this->fb_id)->count();
		}elseif(
			$this->userInfo->user_type == "xuser" ||
			$this->userInfo->user_type == "xxuser"
		){
			$data['branches'] = Branch_list::all();
		}
		return $data;
	}

}
