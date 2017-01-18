<?php

namespace App\Http\Controllers\Manage;

use App\Models\Account;
use App\models\Branch;
use App\Models\Domain;
use App\Models\Post_cat;
use App\Models\Setting;
use App\Models\State;
use App\Traits\TahaControllerTrait;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hamcrest\Core\Set;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SettingsController extends Controller
{
	use TahaControllerTrait ;
	private $page = array();

	public function __construct()
	{
	}

	public function index($request_tab = 'contact')
	{
		//Preparetions...
		$page[0] = ['settings' , trans('manage.settings.downstream')];
		$page[1] = [$request_tab , trans("manage.settings.downstream_settings.category.$request_tab")];
		$db = new Setting() ;

		//Show...
		switch($request_tab) {
			case 'accounts' :
				$model_data = Account::where('user_id' , '0')->paginate(50) ;
				return view("manage.customers.accounts" , compact('page', 'model_data' , 'request_tab' , 'db')) ;

			default :
				$model_data = Setting::where('category' , $request_tab)->where('developers_only' , '0')->orderBy('title')->get() ;
				return view("manage.settings.settings", compact('page', 'model_data' , 'request_tab' , 'db'));

		}

	}



	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save(Requests\Manage\SettingSaveRequest $request)
	{
		$data = $request->toArray() ;

		foreach($data as $item => $value ) {
			if($item[0] == '_')
				continue ;

			$ok = Setting::set($item , $value) ;
		}

		return $this->jsonSaveFeedback($ok , [
			'success_refresh' => true  ,
		]);


	}


}
