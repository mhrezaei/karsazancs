<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
	use TahaModelTrait , SoftDeletes;

	protected $guarded = ['id'];
	public static $reserved_slugs = 'root,admin,support,supports,ticket,tickets,all' ;

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/
	public function tickets()
	{
//		return $this->hasMany('App\Models\Ticket');
	}

	/*
	|--------------------------------------------------------------------------
	| Helpers
	|--------------------------------------------------------------------------
	|
	*/
}