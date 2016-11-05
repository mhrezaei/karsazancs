<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use TahaModelTrait , SoftDeletes ;

	protected $guarded = ['id', 'deleted_at' , 'deleted_by'];
	protected static $search_fields = ['slug' , 'title' , 'abstract'] ;
	protected static $meta_fields = ['min_charge' , 'max_charge' , 'is_rechargeable' , 'is_extensible' , 'image' , 'max_purchasable'] ;
	protected $casts = [
		'meta' => 'array' ,
		'is_available' => 'boolean' ,
	];

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/

	public function orders()
	{
		return $this->hasMany('App\Models\Order');
	}

	/*
	|--------------------------------------------------------------------------
	| Accessors & Mutators
	|--------------------------------------------------------------------------
	|
	*/
	public function getPriceInRialsAttribute($value)
	{
		//@TODO: Complete this
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

	public static function selector($criteria='all')
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
			case 'all' :
				return $table ;
			case 'available' :
				return $table->where('is_available' , '1') ;
			case "not_available" :
				return $table->where('is_available' , '0') ;
			case 'alarm' :
				return $table->whereRaw("`inventory` < `inventory_low_alarm`") ;
			case 'search' :
				return $table->whereRaw(self::searchRawQuery($keyword, self::$search_fields));
			default:
				return $table->whereNull('id');
		}

	}

}
