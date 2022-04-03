<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BadPost extends Model {
	protected $table = 'bad_user_post';
    protected $primaryKey  = 'post_id';

    public function scopeFromUser($query,$facebook_id)
    {
        return $query->where('facebook_id', $facebook_id);
    }
}
