<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\models\Branch;
use App\Models\Department;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;


class DepartmentSaveRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
        $id = $input['id'] ;
        return [
             'title' => 'required|unique:departments,title,'.$id,
             'slug' => 'required|alpha_dash|not_in:'.Department::$reserved_slugs.'|unique:departments,slug,'.$id.',id',
             'icon' => 'required'
        ];

    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
             'slug'  =>  'lower',
             'icon' => 'lower' ,
        ]);
        return $purified;

    }

}
