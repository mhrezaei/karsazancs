<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class CustomerSaveRequest extends Request
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
            return Auth::user()->can('customers.edit') ;
        else
            return Auth::user()->can('customers.create');
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
            'customer_type' => 'in:1,2' ,
            'name_firm' => 'required_if:customer_type,legal|persian' ,
            'national_id' => 'required_if:customer_type,legal|national_id|unique:users,national_id,'.$input['id'].',id',
            'register_no' => 'required_if:customer_type,legal' ,
            'register_date' => 'required_if:customer_type,legal|date' ,
            'register_firm' => 'required_if:customer_type,legal' ,
            'gazette_url' => 'url',
            'name_first' => 'required|persian' ,
            'name_last' => 'required|persian' ,
            'code_melli' => 'required|code_melli|unique:users,code_melli,'.$input['id'].',id',
            'email' => 'required|email|unique:users,email,'.$input['id'].',id',
            'mobile' => 'required|phone:mobile|unique:users,mobile,'.$input['id'].',id',
            'code_id' => 'required_if:customer_type,individual' ,
            'name_father' => 'required_if:customer_type,individual|persian' ,
            'birth_date' => 'required_if:customer_type,individual|date' ,
            'city_id' => 'required|numeric' ,
            'postal_code' => 'required|numeric|postal_code' ,
            'telephone' => 'required|phone:fixed' ,
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'id' => 'number' ,
            'national_id' => 'ed' ,
            'register_no' => 'ed' ,
            'economy_code' => 'ed' ,
            'code_melli' => 'ed' ,
            'mobile' => 'ed' ,
            'code_id' => 'ed' ,
            'postal_code' => 'ed' ,
            'telephone' => 'ed' ,
        ]);
        return $purified;

    }
}
