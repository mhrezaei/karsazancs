<?php
namespace App\Traits;

use App\Models\Domain;
use Illuminate\Support\Facades\Crypt;

trait PermitsTrait
{
	protected static $available_modules = [
		'customers' => ['create' , 'view' , 'activation' , 'send' , 'edit' , 'report' , 'delete' , 'bin'] ,
		'products' => ['create' , 'edit' , 'delete' , 'bin'],
		'orders' => ['create'  , 'browse' , 'process' , 'edit' , 'report'  ,  'delete' , 'bin' ] ,
		'currencies' => ['create' , 'edit' , 'process' , 'delete' , 'bin'],
		'tickets' => ['browse' , 'process' , 'edit' , 'report' , 'delete' , 'bin'] ,
		'posts' => ['create','edit','publish','report','delete','bin'] ,
		'payments' => [ 'browse' , 'process' , 'create' , 'edit' , 'report' , 'delete' , 'bin'],
	];

	protected static $available_permits = [
			'browse' ,
			'process' ,
			'view',
			'send',
			'search',
			'create',
			'edit',
			'publish',
			'activation',
			'report',
			'cats',
			'delete',
			'bin',
	];

	protected static $public_modules = [
			'index' ,
			'profile' ,
			'logout' ,
	];

	protected static $wildcards = [
			'' ,
			'any' ,
			'*' ,
	];
	/*
	|--------------------------------------------------------------------------
	| Set
	|--------------------------------------------------------------------------
	|
	*/

	public function setPermits($roles , $super_admin=false)
	{
		$this->roles = Crypt::encrypt(json_encode($roles)) ;
		if($super_admin)
			$this->status = 99 ;
		else
			$this->status = 91 ;

		return $this->update() ;
	}

	/*
	|--------------------------------------------------------------------------
	| Get
	|--------------------------------------------------------------------------
	| 
	*/

	public static function availableModules($key=null)
	{
		if($key)
			return self::$available_modules[$key] ;
		else
			return self::$available_modules ;
	}

	public function getRoles()
	{
		if(!$this->roles)
			return null;
		else
			return Crypt::decrypt($this->roles) ;

	}

	public function getDomain()
	{
		if($this->isDeveloper())
			return 'global' ;
		else
			return $this->domain ;
	}

	public function isGlobal()
	{
		if($this->getDomain() == 'global')
			return true ;
		else
			return false ;
	}

	public function isAdmin()
	{
		if($this->isGlobal() and $this->can('settings'))
			return true ;
		else
			return false ;
	}

	public function getDomainName()
	{
		if($this->getDomain() == 'global')
			return trans('posts.manage.global') ;

		$domain = Domain::selectBySlug($this->getDomain()) ;
		if($domain)
			return $domain->title ;
		else
			return false ;
	}


	/*
	|--------------------------------------------------------------------------
	| Seek for Permissions / Domains
	|--------------------------------------------------------------------------
	|
	*/


	public function can($requested_role = NULL, $requested_domain = NULL)
	{
		if($this->isDeveloper())
			return true ;

		if(!$this->isAdmin() or $this->trashed())
			return false ;

		//Special things...
		switch($requested_role) {
			case 'admin' :
				if($this->isAdmin())
					return true ;
				else
					return false ;

			case 'super' :
			case 'superAdmin' :
			case 'global' :
				if($this->isSuperAdmin())
					return true ;
				else
					return false ;

			case 'developer' :
				return false ;
		}

		return $this->canRole($requested_role);
//		return $this->canDomain($requested_domain) AND $this->canRole($requested_role);
	}

	private function canDomain($requested_domain) //depreciated
	{
		//Obvious Conditions...
		if($this->domain == 'global')
			return true ;

		if(!$requested_domain)
			return true ;

		if(in_array($requested_domain , self::$wildcards ))
			return true ;

		//Check...
		if($this->domain == $requested_domain)
			return true ;
		else
			return false ;
	}

	private function canRole($requested_role)
	{
		//Obvious Conditions...
		if(in_array($requested_role, self::$wildcards))
			return true;

		if(!$requested_role)
			return true ;

		//Special Roles...
		if($requested_role == 'manage')
			return $this->isSuperAdmin() ;
//			return $this->canRole('settings') and $this->canRole('admins');


		//Module Check...
		$requested_role = str_replace('posts-' , null , $requested_role) ;
		$requested_role = str_replace('.*' , null , $requested_role) ;
		return str_contains($this->getRoles() , $requested_role);

	}

}