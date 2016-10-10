<?php

namespace App\Models;

use App\Traits\PermitsTrait;
use App\Traits\TahaModelTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use TahaModelTrait ;
    use PermitsTrait ;

    protected $guarded = ['id' , 'deleted_at' ] ;
    protected static $search_fields = ['name_first' , 'name_last' , 'code_melli' , 'email' , 'mobile'] ;

    protected static $settings_fields = [] ;

    public static $mandatory_info_for_legals = [] ;
    public static $optional_info_for_legals = [] ;
    public static $mandatory_info_for_individuals = [] ;
    public static $optional_info_for_individuals = [] ;

    public static $mandatory_media_for_legals = [] ;
    public static $optional_media_for_legals = [] ;
    public static $mandatory_media_for_individuals = [] ;
    public static $optional_media_for_individuals = [] ;

    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
|--------------------------------------------------------------------------
| Relations
|--------------------------------------------------------------------------
|
*/

    public function orders()
    {
        //@TODO: Complete this
    }

    public function logins()
    {
        return $this->hasMany('App\Models\Login') ;
    }

    public function lastLogin()
    {
        return $this->logins()->orderBy('created_at' , 'desc')->first() ;
    }

    /*
    |--------------------------------------------------------------------------
    | Stators
    |--------------------------------------------------------------------------
    |
    */

    public function info($in_array_format = false)
    {
        return $this->meta('info' , $in_array_format) ;
    }

    public function media($in_array_format = false)
    {
        return $this->meta('media' , $in_array_format) ;
    }

    public static function searchRawQuery($keyword, $fields = null)
    {
        if(!$fields)
            $fields = self::$search_fields ;

        $concat_string = " " ;
        foreach($fields as $field) {
            $concat_string .= " , `$field` " ;
        }

        return " LOCATE('$keyword' , CONCAT_WS(' ' $concat_string)) " ;
    }

    public function isComplete()
    {
        if($this->name_firm) {
            foreach(self::$mandatory_media_for_legals as $key) {
                if(!isset($this->media()->$key) or !$this->media()->$key or $this->media()->$key == '0')
                    return false ;
            }
            foreach(self::$mandatory_media_for_legals as $key) {
                if(!isset($this->info()->$key) or !$this->info()->$key or $this->info()->$key == '0')
                    return false ;
            }
        }
        else {
            foreach(self::$mandatory_media_for_individuals as $key) {
                if(!isset($this->media()->$key) or !$this->media()->$key or $this->media()->$key == '0')
                    return false ;
            }
            foreach(self::$mandatory_media_for_individuals as $key) {
                if(!isset($this->info()->$key) or !$this->info()->$key or $this->info()->$key == '0')
                    return false ;
            }
        }
        return true ;
    }

    public function isAdmin()
    {
        if($this->status > 90 or $this->isDeveloper())
            return true ;
        else
            return false ;
    }

    public function isSuperAdmin()
    {
        if($this->status == 99 or $this->isDeveloper())
            return true ;
        else
            return false ;
    }

    public function deleteStatus()
    {
        if($this->trashed()) {
            if($this->deleted_by == $this->id)
                return trans('people.status.deleted');
            else
                return trans('people.status.blocked');
        }
        else
            return false ;

    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getStatus($key = 'text' , $status=null)
    {
        if(!$status)
            $status = $this->status ;

        switch($status) {
            case 1 :
                $return['text'] = trans('people.status.stealthy_signed_up');
                $return['color'] = 'info';
                break;
            case 2:
                $return['text'] = trans('people.status.willingly_signed_up');
                $return['color'] = 'info';
                break;
            case 3:
                $return['text'] = trans('people.status.profile_completion');
                $return['color'] = 'info';
                break;
            case 4:
                $return['text'] = trans('people.status.pending');
                $return['color'] = 'warning';
                break;
            case 8:
                $return['text'] = trans('people.status.active');
                $return['color'] = 'success';
                break;
            case 9 :
                $return['text'] = trans('people.status.active');
                $return['color'] = 'success';
                break;
            case 91:
                $return['text'] = trans('people.status.admin');
                $return['color'] = 'black';
                break;
            case 99:
                $return['text'] = trans('people.status.super_admin');
                $return['color'] = 'black';
                break;
            default:
                $return['texst'] = $return['color'] = null;
        }

        if($key=='array')
            return $return ;
        else
            return $return[$key] ;
    }


    /**
     * @return bool
     */
    public function isDeveloper()
    {
        return in_array($this->code_melli , ['0074715623' , '0012071110' ]) ;
    }

    public function canPurchase()
    {
        if($this->status >= 8 and !$this->trashed())
            return true;
        else
            return false;
    }

    public function title()
    {
        if($this->gender==1)
            $title = trans('people.mr');
        else
            $title = trans('people.mrs');

        if($this->edu_level >= 6)
            $title .= ' '.trans('people.dr');

        return $title ;
    }

    public function fullName($with_title = false)
    {
        if(!$this) return false ;
        $return = $this->name_first . " " . $this->name_last ;
        if($with_title)
            $return = $this->title() . " " . $return ;

        return $return ;
    }


    public function say($property, $default='-')
    {
        switch($property) {
            case 'created_at' :
            case 'updated_at' :
            case 'published_at' :
            case 'deleted_at' :
                if($this->$property) {
                    return AppServiceProvider::pd(jDate::forge($this->$property)->format('j F Y [H:m]'));
                }
                else
                    return $default ;

            case 'created_by' :
            case 'updated_by' :
            case 'published_by' :
            case 'deleted_by' :
                $model = self::find($this->$property);
                if($model)
                    return $model->fullName() ;
                else
                    return trans('forms.general.deleted');

            case 'encrypted_code_melli' :
                return Crypt::encrypt($this->code_melli) ;

            case 'status' :
                return $this->getStatus() ;

            case 'name_first' :
            case 'name_last' :
            case 'name_firm' :
            case 'code_melli' :
                return AppServiceProvider::pd($this->$property);

            case 'name' :
                return $this->fullName() ;

            case 'birth_date' :
                return AppServiceProvider::pd(jDate::forge($this->$property)->format('j F Y'));

            case 'gender' :
                if(!$this->$property)
                    return '-' ;
                else
                    return trans("people.$property.".$this->$property) ;

            case 'city' :
            case 'city_id' :
                $state = State::find($this->city_id);
                if($state)
                    return $state->fullName();
                else
                    return $default;

            default:
                return $this->$property ;
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Password Activities
    |--------------------------------------------------------------------------
    |
    */
    /**
     * @return mixed
     */
    public function makeForgotPasswordToken()
    {
        $token['reset_token'] = rand(100000, 999999);
        $token['expire_token'] = Carbon::now()->addMinutes(5);

        $this->reset_token = json_encode($token);
        $this->save();

        return $token['reset_token'];
    }

    /**
     * @param $password
     * @return bool
     */
    public function oldPasswordChange($password)
    {
        $this->password = Hash::make($password);
        $this->password_force_change = 0;
        return $this->save();
    }

    /**
     * @param int $password_force_change
     * @return bool
     */
    public function updateUserForResetPassword($password_force_change = 1)
    {
        $this->reset_token = null;
        $this->password_force_change = $password_force_change;
        return $this->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Selectors
    |--------------------------------------------------------------------------
    |
    */

    public static function counter($type, $criteria , $domain='auto')
    {
        return self::selector($type,$criteria,$domain)->count();
    }
    public static function selector($criteria='')
    {

        $table = self::where('id' , '>' , 0) ;

        //Process Search...
        if(str_contains($criteria , 'search_user')) {
            $keyword = str_replace('search:' , null , $criteria) ;
            $criteria = 'search_user' ;
        }
        if(str_contains($criteria , 'search_admin')) {
            $keyword = str_replace('search:' , null , $criteria) ;
            $criteria = 'search_admin' ;
        }

        //Process Developer...
        if(!Auth::user()->isDeveloper())
            $table = $table->where('code_melli' , '<>' , '0074715623' );

        //Process Criteria...
        switch($criteria) {
            case 'blocked' :
                return $table->onlyTrashed()->whereRaw("`deleted_by` != `id`") ;
            case 'deleted' :
                return $table->onlyTrashed()->whereRaw("`deleted_by` = `id`") ;
            case 'bin' :
                return $table->onlyTrashed() ;
            case 'stealthy_signed_up' :
                return $table->where('status' , 1);
            case 'willingly_signed_up' :
                return $table->where('status' , 2);
            case 'pending' :
                return $table->where('status' , 3);
            case 'active' :
                return $table->whereBetween('status' , [8,9]);
            case 'admin' :
                return $table->whereBetween('status' , [90,99]);
            case 'super_admin' :
                return $table->where('status' , 99);
            case 'newsletter' :
                return $table->where('newsletter' , 1);
            case 'search_user' :
                return $table->whereBetween('status' , [1,89])->whereRaw(self::searchRawQuery($keyword,self::$search_fields)) ;
            case 'search_admin' :
                return $table->whereBetween('status' , [90,99])->whereRaw(self::searchRawQuery($keyword,self::$search_fields)) ;
            default:
                return $table->whereNull('id') ;
        }

    }

    private static function incompleteRawQuery()
    {
        //@TODO: Complete This
        //		$query = " false " ;
        //		foreach(self::$cards_mandatory_fields as $field) {
        //			$query .= " or `$field` = null or `$field` = '0' " ;
        //		}
        //
        //		return " ( $query ) " ;
    }

    /**
     * Determines if the logged user can modify the premissions of this user
     */
    public function canBePermitted()
    {
        $logged_user = Auth::user() ;

        if(!$this->isActive())
            return false ;

        if($this->isDeveloper())
            return false ;

        if($this->isSuperAdmin())
            return false ;

        if($logged_user->isSuperAdmin() and $this->isAdmin())
            return true ;
        else
            return false ;

    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    |
    */


}
