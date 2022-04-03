<?php namespace App\Http\Middleware;

use Closure;

class check_login {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(null !== session('facebook_id'))
			return $next($request);
		else
			return redirect('/');
	}

}
