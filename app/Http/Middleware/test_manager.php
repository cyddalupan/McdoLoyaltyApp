<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class test_manager {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		
		$usertype = Session::get('admin_loged');

		if($usertype == "branchManager"){
			return $next($request);
		}else{
			return redirect('/');
		}
	}

}
