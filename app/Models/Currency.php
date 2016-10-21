<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
	use TahaModelTrait , SoftDeletes;

	protected $guarded = ['id', 'deleted_at' , 'deleted_by'];
	protected $search_fields = ['slug' , 'title'] ;
	protected $casts = [
			'meta' => 'array' ,
	];

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/
	public function rates()
	{
		return $this->hasMany('App\Models\Rate') ;
	}

	public function loadCurrentRates()
	{
		$this->loadRates() ;
	}

	public function loadRates($request_date = 'NOW')
	{

	}

	/*
	|--------------------------------------------------------------------------
	| Accessors & Mutators
	|--------------------------------------------------------------------------
	|
	*/
	public function getFullNameAttribute()
	{
		return $this->title . " ($this->slug) " ;
	}



	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/

	public static function searchRawQuery($keyword, $fields = null)
	{
		if(!$fields)
			$fields = self::$search_fields ;

		$concat_string = " " ;
		foreach($fields as $field) {
			$concat_string .= " , `$field` " ;
		}

		return " LOCATE('$keyword' , CONCAT_WS(' ' $concat_string)) " ;
	}


	public static function counter($criteria , $persian=false)
	{
		$return = self::selector($criteria)->count();
		if($persian)
			return AppServiceProvider::pd($return);
		else
			return $return ;
	}

	public static function selector($criteria='active')
	{

		$table = self::where('id' , '>' , 0) ;

		//Process Search...
		if(str_contains($criteria , 'search')) {
			$keyword = str_replace('search:' , null , $criteria) ;
			$criteria = 'search' ;
		}

		//Process Criteria...
			switch ($criteria) {
				case 'bin' :
					return $table->onlyTrashed();
				case 'actives' :
					return $table ;
				case 'search' :
					return $table->whereRaw(self::searchRawQuery($keyword, self::$search_fields));
				default:
					return $table->whereNull('id');
			}

	}


}
