<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;

class TicketReplyRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $input = $this->all() ;
        $department = $input['original_department'] ;

        return Auth::user()->can("tickets-$department.process");
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
            'original_department'  =>  'decrypt',
        ]);
        return $purified;

    }
}
