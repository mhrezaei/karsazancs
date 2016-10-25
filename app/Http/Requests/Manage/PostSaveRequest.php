<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Models\Post;
use App\Providers\ValidationServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostSaveRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $input = $this->all() ;
        $module = $input['branch'] ;

        if($input['id']) {
            $model = Post::find($input['id']);

            if($model->published_by)
                return Auth::user()->can("posts-$module.edit");
            elseif($input['action']=='publish')
                return Auth::user()->can("posts-$module.publish");
            else
                return $model->canEdit() ;


        }
        else {
            if($input['action']=='publish')
                return Auth::user()->can("posts-$module.publish");
            else
                return Auth::user()->can("posts-$module.create") ;
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
        $now = Carbon::now()->format('Y/m/d');
        return [
            'id' => 'numeric' ,
            'action' => 'required|in:draft,save,publish' ,
            'title' => 'required' ,
            'text' => 'required' ,
//            'category_id' => 'required_if:action,publish',
            'publish_date' => 'date' ,
//            'featured_image' => 'url' ,
            'slug' => 'alpha_dash|not_in:'.Post::$reserved_slugs.'|unique:posts,slug,'.$input['id'].',id',

        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'id'  =>  'ed|numeric',
            'action'  =>  'lower',
            'branch' => 'decrypt' ,
            'publish_date' => 'date' ,
            'featured_image' => 'stripUrl' ,
        ]);
        return $purified;

    }
}
