<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
	use TahaModelTrait , SoftDeletes;

	protected $guarded = ['id', 'deleted_at' , 'deleted_by'];
	protected static $search_fields = ['slug' , 'title'] ;
	protected $casts = [
			'meta' => 'array' ,
	];
	protected $rates_loaded = false ;
	protected $current_rates = [0,0] ;

	public static $meta_fields = [ ];

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

	public function loadCurrentRates($fresh = false)
	{
		//Bypass if already loaded...
		if($this->rates_loaded and !$fresh)
			return $this->rates ;

		//Calculation...
		$rate = $this->loadRates('NOW' , $fresh) ;
		$this->rates_loaded = true ;
		$this->rates = $rate ;
		return $rate ;
	}

	public function loadRates($request_date = 'NOW' , $fresh = false)
	{
		if($request_date == 'NOW')
			$request_date = Carbon::now()->toDateTimeString() ;
//		else
//			$request_date = Carbon::createFromFormat('Y/m/d H:i' , $request_date)->toDateTimeString() ;

		$rate = $this->rates()->where('effective_date' , '<=' , $request_date)->orderBy('effective_date' , 'desc')->orderBy('created_at' , 'desc')->first();
		if(!$rate)
			return new Rate()  ;
		else
			return $rate ;

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

	public function getPriceToBuyAttribute()
	{
		return $this->loadCurrentRates()->price_to_buy ;
	}

	public function getPriceToSellAttribute()
	{
		return $this->loadCurrentRates()->price_to_sell ;
	}

	public function getLatestUpdateAttribute()
	{
		$rate = $this->rates()->orderBy('created_at' , 'desc')->first() ;
		if(!$rate)
			return '-' ;
		else
			return $rate->created_at ;
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

	public static function selector($criteria='actives')
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

	/*
	|--------------------------------------------------------------------------
	| Helpers
	|--------------------------------------------------------------------------
	|
	*/
	public static function irr($amount, $currency , $type = 'sell', $date = 'NOW')
	{
		// Rate Discovery...
		if(!is_object($currency)) {
			$currency = Currency::findBySlug($currency) ;
			if(!$currency)
				return 0 ;
		}
		$rates = $currency->loadRates($date) ;
		$rate = $rates->toArray()["price_to_$type"] ;

		//Return...
		return round($amount * $rate) ;
	}


}
