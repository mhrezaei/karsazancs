<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Models\Payment;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class PaymentSaveRequest extends Request
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
			return Auth::user()->can('payments.edit') ;
		else
			return Auth::user()->can('payments.create');
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
			'payment_method' => "required_if:id,0|in:".Payment::methodsAvailableForAdmins(),
			'status' => "in:confirmed,pending",
			'amount_declared' => "required_if:id,0|numeric|min:1000|max:".$input['amount_payable'],
			'payment_date' => "date|required_if:payment_method,cash,shetab,transfer,deposit,pos",
			'payment_time' => "time|required_if:payment_method,cash,shetab,transfer,deposit,pos",
			'account_no' => "required_if:payment_method,transfer,cheque",
			'bank_name' => "required_if:payment_method,transfer,cheque,deposit",
			'card_no' => "required_if:payment_method,shetab|shetab",
			'own_account_id' => "required_if:payment_method,shetab,transfer,deposit,cheque,pos|exists:accounts,id",
			'depositor' => "required_if:payment_method,deposit",
			'receiver' => "required_if:payment_method,cash",
			'sender' => "required_if:payment_method,cash",
			'tracking_no' => "required_if:payment_method,shetab,transfer,deposit,pos",
			'cheque_date' => "required_if:payment_method,cheque|date",
			'cheque_no' => "required_if:payment_method,cheque",
		];
	}

	public function all()
	{
		$value	= parent::all();
		$purified = ValidationServiceProvider::purifier($value,[
			'order_id' => "decrypt",
			'user_id' => "decrypt",
			'direction' => "decrypt",
			'site_credit' => "decrypt",
			'amount_payable' => "decrypt",
			'amount_declared' => "ed|number",
			'payment_date' => "ed",
			'payment_time' => "ed",
			'card_no' => "ed|shetab",
			'cheque_date' => "ed",
		]);
		return $purified;

	}
}
