<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class Branch_list extends Model {

    use SoftDeletes;

	protected $table = 'branch_list';

	public function user()
    {
        return $this->hasOne('App\User', 'facebook_id', 'facebook_id');
    }

}
