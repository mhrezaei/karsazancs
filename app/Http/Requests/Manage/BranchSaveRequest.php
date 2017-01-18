<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\models\Branch;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;


class BranchSaveRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
        //Permission is checked from the Route
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
             'plural_title' => 'required|unique:branches,plural_title,'.$id,
             'singular_title' => 'required',
             'slug' => 'required|alpha_dash|forbidden_chars:_|not_in:'.Branch::$reserved_slugs.'|unique:branches,slug,'.$id.',id',
             'template'=>'required|in:'.implode(',',Branch::$available_templates) ,
             'icon' => 'required'
        ];

    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
             'slug'  =>  'lower',
             'template' => 'lower' ,
             'features' => 'lower' ,
             'allowed_meta' => 'lower' ,
             'icon' => 'lower' ,
        ]);
        return $purified;

    }

}
