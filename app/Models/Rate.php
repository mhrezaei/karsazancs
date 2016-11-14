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
	public static $meta_fields = [];

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

	public function user()
	{
		return $this->belongsTo('App\Models\User' , 'created_by');
	}

}
