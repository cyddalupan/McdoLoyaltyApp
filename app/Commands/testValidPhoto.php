<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

use Request;

class testValidPhoto extends Command implements SelfHandling {


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
		if (Request::file('photo')->isValid()){
			return redirect()
				->back()
				->withInput();

		}else{
			return redirect()
				->back()
				->withInput()
				->withErrors(
					['image' => 'Image is not Valid']
				);
		}
	}

}
