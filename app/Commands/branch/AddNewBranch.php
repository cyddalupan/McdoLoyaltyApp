<?php namespace App\Commands\branch;

use App\Commands\Command;

use App\Branch_list;

use Illuminate\Contracts\Bus\SelfHandling;

class AddNewBranch extends Command implements SelfHandling {

	protected $all;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($all)
	{
		$this->all = $all;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		//add new branch
		$Branch_list = new Branch_list;
		$Branch_list->branch_name = $this->all['Branch_Location'];
		$Branch_list->city = $this->all['Branch_City'];
		$Branch_list->facebook_id = $this->all['Branch_Manager'];
		$Branch_list->save();

		return $Branch_list['id'];
	}

}
