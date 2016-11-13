<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\jDate;

class Ticket extends Model
{
	use TahaModelTrait , SoftDeletes ;

	public static $departments = ['online' , 'sale' , ''] ;
	protected static $search_fields = ['subject'] ;
	protected $guarded = ['id'] ;
	public static $meta_fields = ['score' ];

	protected $casts = [
		'meta' => 'array' ,
		'newsletter' => 'boolean' ,
		'attended_at' => 'datetime' ,
		'archived_at' => 'datetime' ,
	];

	protected $priority_codes = [
		1 => ['low' , 'success' ] ,
		2 => ['medium' , 'warning'] ,
		3 => ['high' , 'danger'] ,
		4 => ['online' , 'primary']
	];
	protected $feedback_codes = [
		0 => ['spinner' , 'grey'],
		1 => ['frown-o' , 'danger'],
		2 => ['meh-o' , 'warning'],
		3 => ['smile-o' , 'success'],
	];


	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/

	public function talks()
	{
		return $this->hasMany('App\Models\Talk') ;
	}

	public function department()
	{
		return Department::where('slug' , $this->department)->first() ;
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User') ;
	}
	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/

	public static function counter($department ,$criteria = 'published')
	{
		return self::selector($department , $criteria)->count() ;
	}

	public static function searchRawQuery($keyword)
	{
		$fields = self::$search_fields ;

		$concat_string = " " ;
		foreach($fields as $field) {
			$concat_string .= " , `$field` " ;
		}

		return " LOCATE('$keyword' , CONCAT_WS(' ' $concat_string)) " ;
	}

	public static function selector($department='all' , $criteria='open')
	{
		$table = self::where('id' , '>' , '0');

		//Process departments...
		if(is_array($department)) {
			$table = $table->whereIn('department', $department) ;
		}
		elseif($department=='all') {
			//nothing required here :)
		}
		if($department == 'allowed' ) {
			//@TODO: Complete this part
			// $table = $table->whereRaw(" LOCATE(`department` , '".department::departmentesWithFeature('searchable')."' ) ") ;
		}
		else
			$table = $table->where('department' , $department) ;

		//Process Criteria...
		switch($criteria) {
			case 'all' :
				return $table ;
			case 'all_with_trashed' :
				return $table->withTrashed() ;
			case 'open' :
				return $table->whereNull('archived_at') ;
			case 'online' :
				return $table->where('priority' , '4')->whereNull('archived_at') ;
			case 'high' :
				return $table->where('priority' , '3')->whereNull('archived_at') ;
			case 'medium' :
				return $table->where('priority' , '2')->whereNull('archived_at') ;
			case 'low' :
				return $table->where('priority' , '1')->whereNull('archived_at') ;
			case 'archive':
				return $table->whereNotNull('archived_at') ;
			case 'bin' :
				return $table->onlyTrashed();
			default:
				return $table->where('id' , '0') ;
		}


	}

	/*
	|--------------------------------------------------------------------------
	| Accessors & Mutators
	|--------------------------------------------------------------------------
	|
	*/
	public function getDepartmentEnAttribute($value)
	{
		return encrypt($this->department);
	}

	public function getTextAttribute($value)
	{
		$talk = Talk::firstOrNew(['ticket_id' => $this->id]) ;
		return $talk->text ;
	}


	public function getTextLimitedAttribute()
	{
		return str_limit($this->text , 60);
	}

	public function getArchivedAttribute()
	{
		if($this->archived_at)
			return true ;
		else
			return false ;
	}

	public function getPriorityCodeAttribute()
	{
		return $this->priority_codes[$this->priority][0];
	}

	public function getPriorityColorAttribute()
	{
		return $this->priority_codes[$this->priority][1];
	}

	public function getFeedbackIconAttribute($value)
	{
		return $this->feedback_codes[$this->feedback][0];
	}

	public function getFeedbackColorAttribute($value)
	{
		return $this->feedback_codes[$this->feedback][1];
	}

	public function getFirstReplyAttribute($value)
	{
		return $this->talks()->where('is_admin' , '1')->first() ;
	}


	public function canEdit()
	{
		return Auth::user()->can('tickets-'.$this->department.'.edit') ;
	}

	public function canReply()
	{
		return !$this->trashed() and Auth::user()->can('tickets-'.$this->department.'.process');
	}

	public function canDelete()
	{
		return !$this->trashed() and Auth::user()->can('tickets-'.$this->department.'.delete');
	}

	public function canBin()
	{
		return $this->trashed() and Auth::user()->can('tickets-'.$this->department.'.bin');
	}

	/*
	|--------------------------------------------------------------------------
	| Helpers
	|--------------------------------------------------------------------------
	|
	*/

	public function departmentsCombo()
	{
		return Department::orderBy('title')->get() ;
	}
	public function priorityCombo($with_online = false)
	{
		$max = 3 ;
		$array = [] ;
		if($with_online)
			$max++ ;

		for($i=$max ; $i>0 ; $i--) {
			array_push($array , [
				$i , trans("tickets.status.".$this->priority_codes[$i][0])
			]);
		}
		return $array ;

	}

}
