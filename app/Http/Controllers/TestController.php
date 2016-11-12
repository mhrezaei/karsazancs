<?php

namespace App\Http\Controllers;

use App\models\Branch;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
	public function index()
	{
		$user = Auth::user() ;


		dd(get_class($user))  ;
	}

}
