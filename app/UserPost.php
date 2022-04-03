<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPost extends Model {
	use SoftDeletes;
	
	protected $table = 'user_post';

    protected $primaryKey  = 'post_id';

    public function scopeFromUser($query,$facebook_id)
    {
        return $query->where('facebook_id', $facebook_id);
    }

}
