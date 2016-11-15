<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
	use TahaModelTrait, SoftDeletes;

	protected $guarded = ['id'];
	protected static $meta_fields = ['payment_time' , 'account_no' , 'card_no' , 'beneficiary' , 'bank_name' , 'branch_name' , 'branch_code' , 'own_account_id' , 'cheque_number' , 'receipt_no'] ;
	protected static $methods = ['cash' , 'shetab' , 'transfer' , 'deposit' , 'cheque' , 'gateway' , 'pos'];
	protected static $available_methods = ['cash' , 'shetab' , 'transfer' , 'deposit' , 'cheque' , 'gateway' , 'pos'];

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/

	public function order()
	{
		return $this->belongsTo('App\Models\Order') ;
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User') ;
	}

	/*
	|--------------------------------------------------------------------------
	| Accessors & Mutators
	|--------------------------------------------------------------------------
	|
	*/
	public function getMethodNameAttribute()
	{
		return trans("payments.methods.$this->method") ;
	}

	public function getAdminEditorTitleAttribute()
	{
		if(!$this->id)
			return trans('payments.new');
		elseif($this->canEdit())
			return trans('payments.edit') ;
		else
			return trans('payments.view') ;
	}

	public function getStatusCodeAttribute()
	{
		if($this->amount_declared == $this->amount_confirmed)
			return 'confirmed' ;
		elseif(!$this->amount_confirmed and !$this->checked_at)
			return 'pending' ;
		elseif(!$this->amount_confirmed and $this->checked_at)
			return 'rejected' ;
		elseif($this->amount_declared > $this->amount_confirmed)
			return 'underpaid' ;
		elseif($this->amount_declared < $this->amount_confirmed)
			return 'overpaid' ;

	}
	public function getStatusColorAttribute()
	{
		switch($this->status_code) {
			case 'rejected' :
				return 'danger' ;
			case 'pending' :
				return 'orange' ;
			case 'underpaid' :
				return 'warning' ;
			case 'overpaid' :
				return 'violet' ;
			case 'confirmed' :
				return 'success' ;
		}
	}

	public function getStatusIconAttribute()
	{
		switch($this->status_code) {
			case 'rejected' :
				return 'times' ;
			case 'pending' :
				return 'diamond' ;
			case 'underpaid' :
				return 'adjust' ;
			case 'overpaid' :
				return 'expand' ;
			case 'confirmed' :
				return 'check' ;
		}
	}


	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/
	public static function counter($criteria ,$user_id,$order_id, $persian=false)
	{
		$return = self::selector($criteria,$user_id,$order_id)->count();
		if($persian)
			return AppServiceProvider::pd($return);
		else
			return $return ;
	}

	public static function selector($criteria='all' , $user_id =0 , $order_id=0)
	{
		$table = self::where('id' , '>' , 0) ;

		//Process Search...
//		if(str_contains($criteria , 'search')) {
//			$keyword = str_replace('search:' , null , $criteria) ;
//			$criteria = 'search' ;
//		}

		//Process User and Product...
		if($user_id>0)
			$table = $table->where('user_id' , $user_id);
		if($order_id>0)
			$table = $table->where('product_id' , $order_id);

		//Process Criteria...
		switch ($criteria) {
			case 'bin' :
				return $table->onlyTrashed();
			case 'all' :
				return $table ;

			case 'confirmed' :
				return $table->whereRaw("`amount_declared` = `amount_confirmed`") ;
			case 'pending' :
				return $table->whereNull('checked_at')->where('amount_confirmed' , '0') ;
			case 'partial' :
				return $table->whereRaw("`amount_declared` > `amount_confirmed`") ;
			case 'underpaid' :
				return $table->whereRaw("`amount_declared` > `amount_confirmed`") ;
			case 'overpaid' :
				return $table->whereRaw("`amount_declared` < `amount_confirmed`") ;
			case 'rejected' :
				return $table->whereNotNull('checked_at')->where('amount_confirmed' , '0') ;
//			case 'search' :
//				return $table->whereRaw(self::searchRawQuery($keyword, self::$search_fields));
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

	public function methodCombo()
	{
		$result = [] ;
		foreach(self::$available_methods as $method) {
			$result[$method] = trans("payments.methods.$method") ;
		}

		return $result ;
	}


}
