<?php

namespace App\models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Branch extends Model
{
	use TahaModelTrait , SoftDeletes ;
	protected $guarded = ['id'];
	public static $available_features = ['image' , 'text' , 'abstract' , 'rss' , 'comment' , 'gallery' , 'category' , 'searchable' , 'preview' , 'digest' , 'schedule' , 'keyword' , 'title' , 'header'] ;
	public static $available_templates = ['album' , 'post' , 'slideshow' , 'developers' , 'custom'] ;
	public static $available_meta_types = ['text' , 'textarea' , 'date' , 'boolean' , 'photo'];
	public static $reserved_slugs = 'root,admin' ;


	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	| 
	*/
	

	public function posts($criteria='all')
	{
		return Post::selector($this->slug , $criteria);
	}

	public function allPosts()
	{
		return $this->posts('all_with_trashed');

	}

	public function categories()
	{
		return $this->hasMany('App\Models\Category');
	}

	/*
	|--------------------------------------------------------------------------
	| Stators
	|--------------------------------------------------------------------------
	|
	*/

	public function encrypted_slug()
	{
		return Crypt::encrypt($this->slug) ;
	}

	public function hasFeature($feature)
	{
		return str_contains($this->features , $feature) ;
	}

	public function allowedMeta()
	{
		$string = str_replace(' ' , null , $this->allowed_meta) ;
		$result = [] ;

		$array = explode(',',$string) ;
		foreach($array as $item) {
			if(str_contains($item , '*')) {
				$required = true ;
				$item = str_replace('*' , null , $item) ;
			}
			else
				$required = false ;

			$field = explode(':' , $item) ;
			if(!$field[0]) continue ;
			array_push($result , [
				'name' => $field[0] ,
				'type' => isset($field[1])? $field[1] : 'text' ,
				'required' => $required ,
			]) ;
		}

		return $result ;
	}

	public static function getTitle($slug , $is_singular=false)
	{
		$model = self::selectBySlug($slug);
		if(!$model)
			return false ;
		else
			return $model->title($is_singular);

	}

	public function title($is_singular=false)
	{
		if($is_singular)
			return $this->singular_title ;
		else
			return $this->plural_title ;
	}

	public function encrypted()
	{
		return Crypt::encrypt($this->slug);
	}

	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/

	public static function branchesWithFeature($feature)
	{
		$models = Self::whereRaw( "LOCATE('$feature' , `features`)" )->get() ;

		$result = null ;
		foreach($models as $model) {
			$result .= ' '.$model->slug.' ';
		}

		return $result ;
	}

	public static function selector($feature = null)
	{
		if($feature)
			return self::where('features' , 'like' , "%$feature%") ;
		else
			return self::where('id' , '>' , '0');
	}

	public static function groups()
	{
		return self::orderBy('header_title' , 'desc')->groupBy('header_title') ;
	}
}
