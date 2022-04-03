<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AddPoints extends Model {

	protected $table = 'add_points';
	
	use SoftDeletes;

	public function user()
    {
        return $this->hasOne('App\User', 'facebook_id', 'user_id');
    }
    
    public function admin_user()
    {
        return $this->hasOne('App\User', 'facebook_id', 'admin_id');
    }
}