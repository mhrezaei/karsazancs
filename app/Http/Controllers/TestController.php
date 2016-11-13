<?php

namespace App\Http\Controllers;

use App\models\Branch;
use App\Models\Order;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
	public function index()
	{
		$hash = new Hashids('' , 5) ;
		$h = new Hashids('',4);

		$a['original'] = '1' ;
		$a['encoded'] = $hash->encode($a['original']);
		$a['decoded'] = $h->decode($a['encoded']);

		echo view('templates.say' , ['array'=>$a]);
//		return view('templates.say' , ['array'=>$a['decoded']]);

//		dd($a['decoded'][0]);

	}

}
