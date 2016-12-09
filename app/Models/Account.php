<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
	use TahaModelTrait , SoftDeletes;

	protected $guarded = ['deleted_at'];

	protected $casts = [
			'meta' => 'array' ,
	];

	public static $meta_fields = ['branch_name' , 'branch_code' ];


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
	| Accessors & Mutators
	|--------------------------------------------------------------------------
	|
	*/
	public function getTitleAttribute()
	{
		return $this->bank_name . ' '.trans('global.dash').' ' . $this->beneficiary ;
	}



	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/



}
