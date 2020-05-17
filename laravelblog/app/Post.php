<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/* version 1 
    //table name
    protected 		$table = 'posts';
    //primary key
    protected 		$primaryKey = 'id';
    //timestamps
	//public 			$timestamps = false; // manual timestamps
	public 			$timestamps = true; // eloquent timestamps
	*/
	public function user() {
		return $this->belongsTo('App\User');
	}
}
