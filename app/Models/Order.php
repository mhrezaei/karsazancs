<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Order extends Model
{
	use TahaModelTrait , SoftDeletes ;

	protected $guarded = ['id', 'deleted_at' , 'deleted_by'];
	protected $casts = [
		'meta' => 'array' ,
	];
	public static $valid_types = ['new' , 'extend' , 'recharge' , 'refund' , 'block' ,'credit_charge' , 'credit_refund'] ;
	public static $meta_fields = ['initial_charge' , 'rate' ];

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

	public function payments()
	{
		return $this->hasMany('App\Models\Payment');
	}

	public function reindex()
	{
		$this->amount_paid = $this->payments()->where('direction',$this->direction)->where('amount_confirmed' , '>' , '0')->sum('amount_confirmed') ;
		if($this->status_code=='under_payment' and $this->amount_paid >= $this->amount_invoiced)
			$this->status = 2 ;
		$this->save() ;
	}

	public function deleter()
	{
		$user = User::withTrashed()->find($this->deleted_by) ;
		if(!$user) {
			$user = new User();
		}

		return $user ;
	}

	/*
	|--------------------------------------------------------------------------
	| Accessors & Mutators
	|--------------------------------------------------------------------------
	|
	*/
	public function getTitleAttribute()
	{
		return AppServiceProvider::pd($this->slug.' ('.trans("orders.type.".$this->type).')') ;
	}

	public function getAdminEditorTitleAttribute()
	{
		if(!$this->id)
			return trans('orders.new');
		elseif($this->canEdit())
			return trans('orders.edit') ;
		else
			return trans('orders.view') ;
	}

	public function getStatusCodeAttribute()
	{
		switch($this->status) {
			case 1 :
				return 'under_payment' ;
			case 2 :
				return 'unprocessed' ;
			case 3 :
				return 'processing' ;
			case 4 :
				return 'ready' ;
			case 5 :
				return 'dispatched' ;
			case 9 :
				return 'archive' ;
		}
	}

	public function getStatusTitleAttribute()
	{
		return trans("orders.status.".$this->status_code) ;
	}

	public function getStatusFullTitleAttribute()
	{
		$result = $this->status_title ;

		if($this->status_code == 'under_payment' and $this->amount_paid > 0 ) {
			$percent = floor(100 * $this->amount_paid / $this->amount_invoiced) ;
			$percent_statement = AppServiceProvider::pd($percent).' '.trans('orders.status.paid');
			$result .= " (% $percent_statement) " ;
		}

		return $result ;
	}


	public function getStatusColorAttribute()
	{
		switch($this->status_code) {
			case 'under_payment' :
				return 'warning' ;
			case 'unprocessed' :
				return 'danger' ;
			case 'processing' :
				return 'orange' ;
			case 'ready' :
				return 'pink' ;
			case 'dispatched' :
				return 'violet' ;
			case 'archive' :
				return 'success' ;
		}
	}

	public function getStatusIconAttribute()
	{
		switch($this->status_code) {
			case 'under_payment' :
				return 'money' ;
			case 'unprocessed' :
				return 'fire' ;
			case 'processing' :
				return 'diamond' ;
			case 'ready' :
				return 'diamond' ;
			case 'dispatched' :
				return 'truck' ;
			case 'archive' :
				return 'check' ;
		}
	}

	public function getInventoryAdminHintAttribute()
	{
		$product = $this->product ;
		$hint = '' ;
		$translate_parameters = [
				'min_charge' => $product->inventory_low_action,
				'inventory' => $product->inventory ,
				'currency' => trans('forms.general.numbers'),
		];

		$hint = trans('orders.form.inventory_hint' , $translate_parameters).'. ';
		if($product->inventory_low_action)
			$hint .= trans('orders.form.original_charge_min' , $translate_parameters).'. ' ;

		return $hint ;
	}


	public function getChargeAdminHintAttribute()
	{
		$product = $this->product ;
		$product->spreadMeta() ;
		$hint = '' ;
		$translate_parameters = [
			'min_charge' => number_format($product->min_charge),
			'max_charge' => number_format($product->max_charge),
			'charge' => number_format($product->initial_charge),
			'currency' => $product->currency_title,
		];

		if($product->min_charge + $product->max_charge + $product->initial_charge == 0) {
			$hint = trans('orders.form.original_charge_no_limit' , $translate_parameters);
		}
		if($product->charge>0) {
			$hint = trans('orders.form.original_charge' , $translate_parameters).'. ' ;
		}
		if($product->min_charge>0) {
			$hint .= trans('orders.form.original_charge_min' , $translate_parameters).'. ' ;
		}
		if($product->max_charge>0) {
			$hint .= trans('orders.form.original_charge_max' , $translate_parameters).'. ' ;
		}

		return $hint ;

	}

	public function getAmountPayableAttribute()
	{
		return $this->amount_invoiced - $this->amount_paid ;
	}

	public function getDirectionAttribute()
	{
		if(in_array($this->type , ['refund' , 'block' , 'credit_refund']))
			return 'outcome' ;
		else
			return 'income' ;
	}
	


	/*
	|--------------------------------------------------------------------------
	| Stators
	|--------------------------------------------------------------------------
	|
	*/
	public function irr($type = 'sell' , $date='NOW')
	{
		return Currency::irr($this->initial_charge , $this->currency , $type , $date);
	}

	public function canEdit()
	{
		if($this->view_only)
			return false ;
		if($this->status>3 or $this->trashed() or !Auth::user()->can('orders.edit'))
			return false ;
		else
			return true ;
	}

	public function canProcess()
	{
		if($this->trashed() or !Auth::user()->can('orders.process'))
			return false ;
		else
			return true ;
	}

	public function canSave()
	{
		if($this->view_only)
			return false ;
		if(!$this->id or $this->canEdit())
			return true ;
		else
			return false ;
	}

	public function checkPurchaseLimit()
	{
		if($this->status > 3)
			return false ;

		return false ;
		//@TODO: Complete this when Cards are ready.
		return $this->product->canPurchase($this->user) ;
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

			case 'under_payment' :
				return $table->where('status' , '1');
			case 'unprocessed' :
				return $table->where('status' , '2') ;
			case 'processing' :
				return $table->where('status' , '3') ;
			case 'ready' :
				return $table->where('status' , '4') ;
			case 'dispatched' :
				return $table->where('status' , '5') ;
			case 'live' :                                // <-- anything before archive
				return $table->where('status' , '<' , '9');
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


	/*
	|--------------------------------------------------------------------------
	| Helpers
	|--------------------------------------------------------------------------
	|
	*/
	public function generateSlug()
	{
		return substr(time(),4) . rand(10,99) ;
	}

}
