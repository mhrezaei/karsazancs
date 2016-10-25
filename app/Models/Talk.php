<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
	use TahaModelTrait;

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/
	public function ticket()
	{
		return $this->belongsTo('App\Models\Ticket');
	}

}
