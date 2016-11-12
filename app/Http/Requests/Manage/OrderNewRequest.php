<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class OrderNewRequest extends Request
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
			return Auth::user()->can('orders.edit') ;
		else
			return Auth::user()->can('orders.create');

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
			'initial_charge' => "required|numeric",
			'amount_invoiced' => "required|numeric",
		];
	}

	public function all()
	{
		$value	= parent::all();
		$purified = ValidationServiceProvider::purifier($value,[
			'initial_charge' => 'ed|number' ,
			'amount_invoiced' => 'ed|number' ,
			'status' => "number",
		]);
		return $purified;

	}
}
