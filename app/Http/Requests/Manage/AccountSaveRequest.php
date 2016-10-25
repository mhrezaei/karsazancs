<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class AccountSaveRequest extends Request
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::user()->can('customers.edit') ;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$input = $this->all();
		if($input['_submit'] == 'save') {
			return [
				'id' => 'numeric' ,
				'bank_name' => 'required|persian' ,
				'sheba' => 'required|sheba|unique:accounts,sheba,'.$input['id'].',id',
				'account_no' => 'required' ,
				'beneficiary' => 'required|persian' ,
				'branch_name' => 'persian' ,
				'branch_code' => '',
			];
		}
		else {
			return [] ;
		}
	}

	public function all()
	{
		$value	= parent::all();
		$purified = ValidationServiceProvider::purifier($value,[
			'id' => 'number' ,
			'sheba' => 'ed|upper|sheba' ,
			'account_no' => 'ed' ,
		]);
		return $purified;

	}
}
