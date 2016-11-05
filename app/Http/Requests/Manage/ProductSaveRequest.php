<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class ProductSaveRequest extends Request
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$id = $this->all()['id'] ;
		if($id)
			return Auth::user()->can('products.edit') ;
		else
			return Auth::user()->can('products.create');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$input = $this->all() ;
		return [
			'id' => 'numeric' ,
			'title' => 'required|unique:products,title,'.$input['id'].',id' ,
			'currency' => 'required|exists:currencies,slug' ,
			'description' => 'required' ,
			'image' => 'required',
			'card_price' => 'required|numeric' ,
			'max_purchasable' => 'numeric' ,
			'charge' => 'numeric' ,
			'min_charge' => 'numeric' ,
			'max_charge' => 'numeric' ,
			'inventory' => 'required|numeric' ,
			'inventory_low_alarm' => 'numeric' ,
			'inventory_low_action' => 'numeric' ,
		];
	}

	public function all()
	{
		$value	= parent::all();
		$purified = ValidationServiceProvider::purifier($value,[
			'id' => 'number' ,
			'title' => 'pd' ,
			'description' => 'pd' ,
			'image' => 'stripUrl' ,
			'card_price' => 'ed' ,
			'max_purchasable' => 'ed|number' ,
			'charge' => 'ed' ,
			'min_charge' => 'ed|number' ,
			'max_charge' => 'ed|number' ,
			'inventory' => 'ed' ,
			'inventory_low_alarm' => 'ed|number' ,
			'inventory_low_action' => 'ed|number' ,
		]);
		return $purified;

	}
}
