<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class CurrencySaveRequest extends Request
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
            return Auth::user()->can('currencies.edit') ;
        else
            return Auth::user()->can('currencies.create');
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
            'id' => 'numeric' ,
            'currency_title' => 'required|persian|unique:currencies,title,'.$input['id'].',id',
            'currency_slug' => 'required|alpha|size:3|unique:currencies,slug,'.$input['id'].',id',
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'id' => 'number' ,
            'currency_slug' => 'upper' ,
        ]);
        return $purified;

    }
}
