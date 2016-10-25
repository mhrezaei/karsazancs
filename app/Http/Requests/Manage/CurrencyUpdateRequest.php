<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class CurrencyUpdateRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       return Auth::user()->can('currencies.process') ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currency_id' => 'numeric' ,
            'effective_date' => 'required|in:now,custom' ,
            'date' => 'required_if:effective_date,custom' ,
            'time' => 'required_if:effective_date,custom|date_format:H:i' ,
            'price_to_buy' => 'required|numeric',
            'price_to_sell' => 'required|numeric',
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'currency_id' => 'number' ,
            'time' => 'ed|time' ,
            'price_to_buy' => 'ed' ,
            'price_to_sell' => 'ed' ,
        ]);
        return $purified;

    }
}
