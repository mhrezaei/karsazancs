<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	use TahaModelTrait ;

	public static $departments = ['online' , 'sale' , ''] ;

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/

	public function talks()
	{
		return $this->hasMany('App\Models\Talk') ;
	}

	public function department()
	{
		return $this->belongsTo('App\Models\Department');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User' , 'created_by') ;
	}
}
