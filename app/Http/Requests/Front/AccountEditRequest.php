<?php

namespace App\Http\Requests\Front;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class AccountEditRequest extends Request
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if (Auth::check())
        {
            return true;
        }
        else
        {
            return false;
        }
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
            'mobile' => 'required|phone:mobile' ,
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
