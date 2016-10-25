<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class TicketSaveRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $input = $this->all() ;
        $department = $input['department'] ;

        if($input['id'])
            return Auth::user()->can("tickets-$department.edit");
        else
            return true ;

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
            'code_melli' => 'required_if:user_id,0|code_melli' ,
            'title' => 'required|persian' ,
            'text' => 'required|persian:50' ,
            'priority' => 'required|numeric|min:1|max:3' ,
            'department' => 'required' ,
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'id'  =>  'ed|numeric',
            'code_melli'  =>  'ed',
        ]);
        return $purified;

    }
}
