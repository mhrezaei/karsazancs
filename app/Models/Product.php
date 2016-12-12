<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\jDate;

class Product extends Model
{
    use TahaModelTrait , SoftDeletes ;

	protected $guarded = ['id', 'deleted_at' , 'deleted_by'];
	protected static $search_fields = ['slug' , 'title' , 'description'] ;
	protected static $meta_fields = ['min_charge' , 'max_charge' , 'is_rechargeable' , 'is_extensible' , 'image' , 'max_purchasable' , 'expiry' , 'color_code'] ;
	protected static $color_codes = ['red','orange','purple','green','teal','blue','gray','dark','brown'] ;
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

	public function currency()
	{
		$currency = Currency::findBySlug($this->currency) ;
		if(!$currency)
			return new Currency() ;
		else
			return $currency ;
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

	public function getCurrencyTitleAttribute()
	{
		return $this->currency()->title ;
	}

	public function getAdminEditorTitleAttribute()
	{
		if(!$this->id)
			return trans('products.new');
		elseif($this->canEdit())
			return trans('products.edit');
		else
			return trans('products.view');
	}

	public function getStatusAttribute()
	{
		if($this->inventory==0)
			return 'available' ;
		elseif($this->inventory < $this->inventory_low_action)
			return 'not_available' ;
		elseif($this->inventory < $this->inventory_low_alarm)
			return 'alarm' ;
		else
			return 'available' ;
	}

	public function getStatusColorAttribute()
	{
		switch($this->status) {
			case 'available' :
				return 'success' ;
			case 'alarm' :
				return 'warning' ;
			case 'not_available' :
				return 'danger' ;
		}
	}

	public function getStatusIconAttribute()
	{
		switch($this->status) {
			case 'available' :
				return 'check' ;
			case 'alarm' :
				return 'exclamation-circle' ;
			case 'not_available' :
				return 'exclamation-triangle' ;
		}
	}

	public function getCreatorAttribute()
	{
		$user = User::findAdmin($this->created_by) ;
		if(!$user) {
			$user = new User() ;
			$user->name_first = trans('people.form.deleted_person') ;
		}

		return $user ;
	}

	public function getCreatedAtFormattedAttribute()
	{
		return AppServiceProvider::pd(jDate::forge($this->created_at)->format('j F Y [H:m]')) ;
	}
	public function getDeleterAttribute()
	{
		$user = User::findAdmin($this->deleted_by) ;
		if(!$user) {
			$user = new User() ;
			$user->name_first = trans('people.form.deleted_person') ;
		}

		return $user ;

	}

	public function getDeletedAtFormattedAttribute()
	{
		return AppServiceProvider::pd(jDate::forge($this->deleted_at)->format('j F Y [H:m]')) ;
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


	public function canSave()
	{
		if($this->id)
			return $this->canEdit() ;
		else
			return Auth::user()->can("products.create") ;

	}

	public function canEdit()
	{
		if($this->locked or $this->trashed() or !Auth::user()->can('orders.edit'))
			return false ;
		else
			return true ;
	}

	public function canPurchase($user = 'auto')
	{
		return 2 ;
		//@TODO: Complete this after writing the Cards class


		//Selection...
		if($user=='auto')
			$user = Auth::user() ;
		elseif(is_integer($user))
			$user = User::findUser($user) ;
		elseif(is_object($user)) {
			if(get_class($user) != 'App\Models\User')
				return false ;
		}
		else
			return false ;

		//User Eligibility...
		if(!$user or !$user->isActiveCustomer() or $user->trashed())
			return false ;



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

	public static function selector($criteria='available')
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
				return $table->where('inventory' , '>' , '0')->whereRaw("`inventory` > `inventory_low_action`")->whereRaw("`inventory` > `inventory_low_alarm`") ;
			case "not_available" :
				return $table->whereRaw("(`inventory` = 0 OR `inventory` < `inventory_low_action`)") ;
			case 'alarm' :
				return $table->whereRaw("`inventory` < `inventory_low_alarm`")->whereRaw("`inventory` > `inventory_low_action`") ;
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
	public function currenciesCombo()
	{
		return Currency::selector() ;
	}

	public function colorsCombo()
	{
		$result = [] ;
		foreach(self::$color_codes as $key => $color_code) {
			$result[$key] = [
				'id' => $color_code,
				'title' => trans("forms.color.$color_code"),
			];
		}

		return $result ;
	}
}
