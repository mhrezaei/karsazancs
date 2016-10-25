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

class TestController extends Controller
{
	public function index()
	{
		Ticket::store( [
			'id' => 1 ,
			'archived_at' => null ,
			'feedback' => 0 ,
			'first_replied_by' => 3 ,
			'first_replied_at' => Carbon::now()->toDateTimeString()
		]);
	}

}
