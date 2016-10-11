<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TahaModelTrait ;

class State extends Model
{
	use SoftDeletes , TahaModelTrait ;

	protected $guarded = ['id'];


	public static function get_provinces($mood='self')
	{
		return self::where('parent_id' , 0);
	}

	public function fullName()
	{
		if($this->isProvince())
			return  trans('manage.devSettings.states.province')."  ".$this->title ;
		else
			return $this->province()->title." / ".$this->title ;
	}

	public static function findByName($state_name)
	{
		return self::findBySlug($state_name , 'title') ;
	}

	public static function get_cities($given_province=0, $mood = 'self')
	{
		if(is_numeric($given_province))
			if($given_province==0)
				$return = self::where('parent_id','>','0') ;
			else
				$return = self::where('parent_id' , $given_province) ;
		else {
			$province = self::where([
				'title' => $given_province ,
				'parent_id' => '0'
			])->first() ;
			if(!$province)
				$return = self::where('parent_id' , 0) ; //safely returns nothing!
			else
				$return = self::where('parent_id' , $province->id) ;
		}

		return $return ;
	}

	public function cities()
	{
		if($this->id)
			return self::where('parent_id' , $this->id) ;
		else
			return self::where('parent_id' , '>' , '0') ;
	}

	public static function setCapital($province_name, $city_name)
	{
		if(!$city_name) $city_name = $province_name ;
		$province = self::where([
				'title'=>$province_name,
				'parent_id'=>'0',
		])->first() ;
		$city = self::where([
				['title',$city_name],
				['parent_id','!=','0'],
		])->first() ;

		$province->capital_id = $city->id ;
		$province->save() ;
	}

	public function isProvince()
	{
		return !$this->parent_id ;
	}

	public function isCapital()
	{
		if($this->isProvince())
			return false ;

		if($this->province()->capital_id == $this->id)
			return true ;
		else
			return false ;

	}

	public function capital()
	{
		if($this->isProvince())
			return self::find($this->capital_id) ;
		else
			return $this->province()->capital() ;
	}

	public function province()
	{
		if($this->isProvince())
			return $this ;
		else {
			return self::find($this->parent_id) ;
		}
	}

	public static function get_combo()
	{
		$provinces = self::get_provinces('self')->orderBy('title')->get();
		$output    = [] ;
		$states = self::where('parent_id' , '>' , '0')->orderBy('parent_id')->get()->toArray();

		foreach($provinces as $province) {
			$states = self::get_cities($province->id)->orderBy('title')->get()->toArray() ;
			foreach($states as $idx => $state) {
				$states[$idx]['title'] = $province->title .  " / " . $state['title'] ;
			}
			$output = array_merge($output,$states);
		}

		return $output ;
	}

}


