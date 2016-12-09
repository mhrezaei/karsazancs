<?php

namespace App\Http\Requests\Front;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class AccountSetPasswordRequest extends Request
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
            'password' => 'required|same:password2|min:8',
        ];
	}

	public function all()
	{
		$value	= parent::all();
		$purified = ValidationServiceProvider::purifier($value,[
            'password' => 'ed',
            'password2' => 'ed',
        ]);
		return $purified;

	}
}
