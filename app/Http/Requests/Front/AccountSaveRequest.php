<?php

namespace App\Http\Requests\Front;

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
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$input = $this->all();
        return [
            'name_first' => 'required|persian:60|min:2|max:255',
            'name_last' => 'required|persian:60|min:2|max:255',
            'email' => 'required|email|max:255',
//            'email' => 'required|email|max:255|unique:users', //@TODO chon sabtename makhfi darim nemitoone unique bashe
            'mobile' => 'required|phone:mobile' ,
            'g-recaptcha-response' => 'required', 'recaptcha',
            //'password' => 'required|min:6|confirmed',
        ];
	}

	public function all()
	{
		$value	= parent::all();
		$purified = ValidationServiceProvider::purifier($value,[
            'name_first'  =>  'pd',
            'name_last'  =>  'pd',
            'email'  =>  'ed',
            'mobile' => 'ed' ,
        ]);
		return $purified;

	}
}
