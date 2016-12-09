<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\jDate;

class Payment extends Model
{
	use TahaModelTrait, SoftDeletes;

	protected $guarded = ['id'];
	protected static $meta_fields = ['payment_date' , 'receiver' , 'sender' , 'description' , 'tracking_no' , 'cheque_no' ,
			'cheque_date' , 'own_account_id' , 'customer_account_id' , 'card_no' , 'account_no' , 'bank_name' , 'depositor' ] ;
	protected static $methods_selectable_for_admins = ['site_credit' , 'cash' , 'shetab' , 'transfer' , 'deposit' , 'cheque' , 'pos'];
	protected static $available_methods = ['site_credit' , 'cash' , 'shetab' , 'transfer' , 'deposit' , 'cheque' , 'gateway' , 'pos'];
	protected static $default_method_for_income = 'pos' ;
	protected static $default_method_for_outcome = 'site_credit' ;

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

	public function checker()
	{
		$user = User::findAdmin($this->checked_by , true) ;
		if(!$user) {
			$user = new User();
		}

		return $user ;
	}

	public function reindex()
	{
		$this->order->reindex() ;
		if($this->payment_method == 'site_credit') {
			$this->user->reindex();
		}
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

	public function getStatusAttribute()
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
		switch($this->status) {
			case 'rejected' :
				return 'danger' ;
			case 'pending' :
				return 'orange' ;
			case 'underpaid' :
				return 'danger' ;
			case 'overpaid' :
				return 'pink' ;
			case 'confirmed' :
				return 'success' ;
		}
	}

	public function getStatusIconAttribute()
	{
		switch($this->status) {
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

	public function getStatusInProcessAttribute()
	{
		switch($this->status) {
			case 'rejected' :
			case 'confirmed' :
				return $this->status ;

			case 'underpaid' :
			case 'overpaid' :
				return 'custom' ;

			default :
				return '' ;
		}
	}


	public function getPaymentTimeAttribute()
	{
		if($this->id) {
			$this->spreadMeta() ;
			return jDate::forge($this->payment_date)->format('H:i');
		}
		else
			return null ;
	}


	/*
	|--------------------------------------------------------------------------
	| Stators
	|--------------------------------------------------------------------------
	|
	*/
	public function canEdit()
	{
		if($this->trashed() or !Auth::user()->can('payments.edit'))
			return false ;
		else
			return true ;
	}

	public function canProcess()
	{
		if($this->trashed() or !Auth::user()->can('payments.process'))
			return false ;
		else
			return true ;
	}

	public function canSave()
	{
		if($this->view_only)
			return false ;
		elseif(!$this->id or $this->canEdit())
			return true ;
		else
			return false ;
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

		//Process User and Order...
		if($user_id>0)
			$table = $table->where('user_id' , $user_id);
		if($order_id>0)
			$table = $table->where('order_id' , $order_id);

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
		foreach(self::$methods_selectable_for_admins as $key => $method) {
			$result[$key] = [$method , trans("payments.methods.$method")] ;
		}

		return $result ;
	}


	public function accountsCombo($user_id = 0)
	{
		return Account::where('user_id' , $user_id)->orderBy('bank_name')->get() ;
	}

	public static function methodsAvailableForAdmins()
	{
		$array = self::$methods_selectable_for_admins ;
		$string = '' ;

		foreach($array as $item) {
			$string .= ",$item" ;
		}

		return substr($string,1) ;
	}


}
