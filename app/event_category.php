<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class event_category extends Model {
	
	use SoftDeletes;

	protected $table = 'event_categories';

}
