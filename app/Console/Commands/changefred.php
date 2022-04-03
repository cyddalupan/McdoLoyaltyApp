<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\User;


class changefred extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:changefred';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Change FredZilla User Type';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

		$usertype = $this->argument('usertype');
		$fred = User::find(775995472469543);

		if($usertype == 'manager'){
			$fred->user_type = 'branchManager';
			$fred->save();
			$this->info('Fred is now manager');
		}
		elseif($usertype == 'user'){
			$fred->user_type = 'user';
			$fred->save();
			$this->info('Fred is now user');
		}
		elseif($usertype == 'admin'){
			$fred->user_type = 'admin';
			$fred->save();
			$this->info('Fred is now admin');
		}
		elseif($usertype == 'tester'){
			$fred->user_type = 'tester';
			$fred->save();
			$this->info('Fred is now tester');
		}
		elseif($usertype == 'pending'){
			$fred->user_type = 'xuser';
			$fred->save();
			$this->info('Fred is now Pending');
		}else{
			$this->comment('Incorrect format.');
			$this->comment('Example Format');
			$this->comment('artisan command:changefred admin');
			$this->comment('chose from manager, user, admin, tester, pending');	
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['usertype', InputArgument::REQUIRED, 'chose from manager, user, admin, tester, pending'],
		];
	}


}
