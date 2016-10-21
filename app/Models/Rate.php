<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use TahaModelTrait ;

	protected $guarded = ['id'];
	protected $casts = [
		'meta' => 'array' ,
	];

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/
	public function currency()
	{
		return $this->belongsTo('App\Models\Currency');
	}

}
