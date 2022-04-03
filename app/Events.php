<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model {

	use SoftDeletes;

	public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>' ,date('Y-m-d'));
    }

	public function scopeOnGoing($query)
    {
        return $query->where('event_date', '<=' ,date('Y-m-d'));
    }

    public function scopeLocalBranch($query, $branch_id)
    {
        return $query->Where('branch_id',$branch_id);
    }

    public function scopeGlobalBranch($query)
    {
        return $query->Where('branch_id', 0);
    }

    public function scopeLocalAndGlobalBranch($query, $branch_id)
    {
        $this->branch_id = $branch_id;
        return $query->where(function($query)
        {
            $query->where('branch_id',$this->branch_id)
                  ->orWhere('branch_id', 0);
        });
    }

    public function scopeManager($query)
    {
        return $query->where('is_manager',1);
    }

    public function scopeAdmin($query)
    {
        return $query->where('is_manager',0);
    }

    public function event_branch()
    {
        return $this->belongsTo('App\event_branch', 'events_id', 'id');
    }
}
