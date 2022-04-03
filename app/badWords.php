<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class badWords extends Model {

	public $timestamps = true;

    protected $primaryKey = 'bad_word_id';
	protected $table = 'bad_words';

}
