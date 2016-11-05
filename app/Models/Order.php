<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
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

}
