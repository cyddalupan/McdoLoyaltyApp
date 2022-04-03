<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model {
	use SoftDeletes;

    protected $primaryKey = 'facebook_id';
	protected $table = 'users';
	protected $dates = ['deleted_at'];

	public function branch_list()
    {
        return $this->belongsTo('App\Branch_list', 'facebook_id', 'facebook_id');
    }

    //user types
    public function scopeAdmin($query)
    {
        return $query->where('user_type', 'admin');
    }
    public function scopeBranchManager($query)
    {
    	return $query->where('user_type', 'branchManager');
    }
    public function scopeTester($query)
    {
        return $query->where('user_type', 'tester');
    }
    public function scopePending($query)
    {
        return $query->where('user_type', 'xuser');
    }
    public function scopeApproved($query)
    {
        return $query->where('user_type', 'user');
    }
    public function scopeNotTester($query)
    {
        return $query->where('user_type', '!=', 'tester');
    }
    public function scopeNotApproved($query)
    {
        return $query->where('user_type', '!=', 'user');
    }

    public function scopeNotManager($query)
    {
        return $query->where('user_type', '!=', 'branchManager');
    }

    public function scopePostToWall($query)
    {
        return $query->Where('post_to_my_wall', '!=', 'no');
    }

    public function scopeLocalBranch($query, $branch_id)
    {
        return $query->where('branch_id',$branch_id);
    }

    public function scopeMyBranch($query,$fb_id)
    {
    	$userInfo = User::find($fb_id);
    	if(isset($userInfo->branch_list->id)){
			$user_branch_id = $userInfo->branch_list->id;
            return $query->where('branch_id', $user_branch_id);
        }
		else{
            return $query->where('branch_id', '<' , 0);
        }
    }

}
