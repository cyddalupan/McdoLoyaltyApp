<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;

use App\Http\Requests\StoreAddPointsRequest;

use App\User;
use App\AddPoints;

class AddpointsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$users = User::orderBy('name')->get();

		$points = AddPoints::all();

		foreach ($points as $point) {
			$point->admin_name =  $point->admin_user->name;
			$point->user_name =  $point->user->name;
		}

		return view('addpoints')
			->with('users',$users)
			->with('points',$points);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StoreAddPointsRequest $request)
	{

		$addpoints = new AddPoints;
		$addpoints->admin_id = session('facebook_id');
		$addpoints->user_id = Request::input('user_id');
		$addpoints->points = Request::input('points');
		$addpoints->save();

		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
