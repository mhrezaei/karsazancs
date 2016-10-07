<?php
/*
|--------------------------------------------------------------------------
| A Trait to define all the methods required to access the central meta system
|--------------------------------------------------------------------------
| Depends on TahaModelTrait to use the className() method.
*/

namespace App\Traits;
use App\models\Meta;

trait TahaMetaTrait
{


	/**
	 * @return an Eloquent table of all metas designated to the object
	 */
	public function metas()
	{
		return Meta::where('model_name' , $this->className())->where('record_id', $this->id) ;

	}


	/**
	 * Automatic read an write to meta. Provide a value to perform write. Do not enter value to perform read.
	 * @param        $key
	 * @param string $value
	 * @return bool|null
	 */
	public function meta($key , $value='READ' , $type='text')
	{
		//If read...
		if($value==='READ')
			return Meta::get($this->className() , $this->id , $key) ;

		//If writes
		return Meta::set($this->className() , $this->id , $key , $value) ;
	}

}