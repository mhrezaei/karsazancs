<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Talk extends Model
{
	use TahaModelTrait;
	protected $guarded = ['id'] ;
	public static $meta_fields = [ ];


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

	public function user()
	{
		return $this->belongsTo('App\Models\User' , 'created_by') ;
	}

	/*
	|--------------------------------------------------------------------------
	| Accessors & Mutators
	|--------------------------------------------------------------------------
	|
	*/
	public function getByAttribute($value)
	{
		return trans('tickets.message_by' , [
			'name' => $this->user->full_name ,
			'date' => AppServiceProvider::pd(jDate::forge($this->created_at)->format('j F Y [H:m]')) ,
		]);
	}

	public function getCreatedAtFormattedAttribute($value)
	{
		return AppServiceProvider::pd(jDate::forge($this->created_at)->format('j F Y [H:m]')) ;
	}




}
