<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurPost extends Model {

	use SoftDeletes;

    protected $primaryKey = 'our_post_id';
	protected $table = 'our_post';

}
