<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::NotApproved()->orderBy('user_type', 'asc')->get();
		$usertypes = DB::table('user_types')->lists('types');

		return view('Users')
			->with('users', $users)
			->with('usertypes', $usertypes);
	}

	public function change_user_type($facebook_id,$new_user_type){
		$user = User::find($facebook_id);
		$user->user_type = $new_user_type;
		$user->save();
		return redirect('dashboard');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($facebook_id)
	{
		$user = User::find($facebook_id);
		$user->delete();
		return redirect('dashboard')->with('facebook_id',$facebook_id)->with('user_name',$user->name);
	}

	public function restore($facebook_id)
	{
		User::withTrashed()->find($facebook_id)->restore();
		return redirect('dashboard');
	}

}
