<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	use TahaModelTrait;

	protected $guarded = ['deleted_at'];

	protected $casts = [
			'meta' => 'array' ,
	];

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/



}
