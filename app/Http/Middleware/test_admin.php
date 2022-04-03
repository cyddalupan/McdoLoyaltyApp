<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

use App\suggestions;

class test_admin {

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

		$suggestion_count =  suggestions::count();
		Session::put('suggestion_count', $suggestion_count);
		
		if($usertype == "admin"){
			return $next($request);
		}else{
			return redirect('/');
		}
	}

}
