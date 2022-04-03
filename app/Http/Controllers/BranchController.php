<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Branch_list;
use App\UserPost;
use App\BadPost;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\BranchRequest;

//Commands
use Illuminate\Support\Facades\Bus;
use App\Commands\branch\AddNewBranch;
use App\Commands\branch\ChangeUserBranchId;
use App\Commands\branch\GetSharableEvents;


class BranchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$Branch_list = Branch_list::all();

		$managers = User::branchManager()->whereNotIn('facebook_id', $Branch_list->lists('facebook_id'))->get();
 
		foreach ($Branch_list as $branch) {
			$branch->member_count = User::where('branch_id',$branch->id)->count();
		}

		return view('branchtab')
			->with('managers',$managers)
			->with('Branch_list',$Branch_list);
	}

	public function branchMembers($branch_id){
		$branch = Branch_list::find($branch_id);
		$manager = User::find($branch->facebook_id);
		$members = User::NotManager()->LocalBranch($branch_id)->get();

		foreach ($members  as $member) {
			$member->link_to_user_post = url().'/branch/user_post/'.$member->facebook_id;
		}

		return view('branchMembers')
			->withBranch($branch)
			->withManager($manager)
			->withMembers($members);
	}

	public function user_post($facebook_id){
		$user 			= user::find($facebook_id);
		$good_posts 	= UserPost::FromUser($facebook_id)->get();
		$bad_posts 	= BadPost::FromUser($facebook_id)->get();

		return view('user_post_branch')
			->withUser($user)
			->withGood_posts($good_posts)
			->withBad_posts($bad_posts);
	}

	public function add(BranchRequest $request)
	{
		$all = Request::all();

		//save new branch to db
		$Branch_list_id = Bus::dispatch(new AddNewBranch($all));
		
		//change user
		Bus::dispatch(new ChangeUserBranchId($all['Branch_Manager'],$Branch_list_id));

		//Give New Branch, Public Events, from Admin
		Bus::dispatch(new GetSharableEvents($Branch_list_id));

		return redirect('branch');
	}

	public function delete($branch_id){

		$branch_list = Branch_list::find($branch_id);
		$branch_list->delete();

		return redirect('branch')->with('branch_id', $branch_id)->with('branch_name', $branch_list->branch_name);
	}

	public function restore($branch_id){
		$branch_list = Branch_list::where('id', $branch_id)->restore();

		return redirect('branch');
	}

}
