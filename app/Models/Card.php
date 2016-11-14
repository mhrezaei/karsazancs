<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
	use TahaModelTrait , SoftDeletes ;

	protected $guarded = ['id', 'deleted_at' , 'deleted_by'];
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

	public function product()
	{
		return $this->belongsTo('App\Models\Product');
	}

	public function orders()
	{
		return $this->hasMany('App\Models\Orders');
	}

}
