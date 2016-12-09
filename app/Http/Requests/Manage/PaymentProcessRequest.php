<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Models\Payment;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class PaymentProcessRequest extends Request
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::user()->can('payments.process') ;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'amount_confirmed' => "required_if:status,custom",
			'status' => "required",
		];
	}

	public function all()
	{
		$value	= parent::all();
		$purified = ValidationServiceProvider::purifier($value,[
			'amount_confirmed' => "ed|number",
		]);
		return $purified;

	}
}
