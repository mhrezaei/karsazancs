<?php

namespace App\Http\Controllers;

use App\models\Branch;
use App\Models\Order;
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
		$order = Order::find(1);

		echo view('templates.say' , ['array'=>Order::$meta_fields]);

		dd(in_array('rate' ,Order::$meta_fields));

	}

}
