<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use TahaModelTrait , SoftDeletes ;

	protected $guarded = ['id', 'deleted_at' , 'deleted_by'];
	protected $casts = [
		'meta' => 'array' ,
	];
	public static $valid_types = ['new' , 'extend' , 'recharge' , 'refund' , 'block'] ;

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

	public function card()
	{
		return $this->belongsTo('App\Models\Card');
	}

	/*
	|--------------------------------------------------------------------------
	| Accessors & Mutators
	|--------------------------------------------------------------------------
	|
	*/
	public function getStatusCodeAttribute()
	{
		switch($this->status) {
			case 1 :
				return 'unprocessed' ;
			case 2 :
				return 'processing' ;
			case 3 :
				return 'under_payment' ;
			case 4 :
				return 'dispatched' ;
			case 9 :
				return 'archive' ;
		}
	}
	public function getStatusColorAttribute()
	{
		switch($this->status_code) {
			case 'unprocessed' :
				return 'danger' ;
			case 'processing' :
				return 'warning' ;
			case 'under_payment' :
				return 'warning' ;
			case 'dispatched' :
				return 'warning' ;
			case 'archive' :
				return 'success' ;
		}
	}

	public function getStatusIconAttribute()
	{
		switch($this->status_code) {
			case 'unprocessed' :
				return 'fire' ;
			case 'processing' :
				return 'diamond' ;
			case 'under_payment' :
				return 'money' ;
			case 'dispatched' :
				return 'truck' ;
			case 'archive' :
				return 'check' ;
		}
		switch($this->status) {
			case 'available' :
				return 'check' ;
			case 'alarm' :
				return 'exclamation-circle' ;
			case 'not_available' :
				return 'exclamation-triangle' ;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Stators
	|--------------------------------------------------------------------------
	|
	*/
	public function irr($type = 'sell' , $date='NOW')
	{
		return Currency::irr($this->charge , $this->currency , $type , $date);
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


	public static function counter($criteria ,$user_id,$product_id, $persian=false)
	{
		$return = self::selector($criteria,$user_id,$product_id)->count();
		if($persian)
			return AppServiceProvider::pd($return);
		else
			return $return ;
	}

	public static function selector($criteria='all' , $user_id =0 , $product_id=0)
	{
		$table = self::where('id' , '>' , 0) ;

		//Process Search...
		if(str_contains($criteria , 'search')) {
			$keyword = str_replace('search:' , null , $criteria) ;
			$criteria = 'search' ;
		}

		//Process User and Product...
		if($user_id>0)
			$table = $table->where('user_id' , $user_id);
		if($product_id>0)
			$table = $table->where('product_id' , $product_id);

		//Process Criteria...
		switch ($criteria) {
			case 'bin' :
				return $table->onlyTrashed();
			case 'all' :
				return $table ;

			case 'unprocessed' :
				return $table->where('status' , '1') ;
			case 'processing' :
				return $table->where('status' , '2') ;
			case 'under_payment' :
				return $table->where('status' , '3');
			case 'dispatched' :
				return $table->where('status' , '4') ;
			case 'archive' :
				return $table->where('status' , '9') ;
			case 'open' :
				return $table->where('status' , '<' , '9') ;
			case 'search' :
				return $table->whereRaw(self::searchRawQuery($keyword, self::$search_fields));
			default:
				return $table->whereNull('id');
		}

	}

}
