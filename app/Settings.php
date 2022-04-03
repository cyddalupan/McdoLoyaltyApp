<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model {
	use SoftDeletes;

	protected $table = 'settings';
	
    protected $primaryKey  = 'setting_name';
}
