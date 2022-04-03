<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class event_branch extends Model {

	use SoftDeletes;

	public function scopeLocal($query, $branch_id)
    {
        return $query->where('branch_id',$branch_id);
    }

	public function event()
    {
        return $this->hasOne('App\Events', 'id', 'events_id');
    }

}
