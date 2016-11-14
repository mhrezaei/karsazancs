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
		for($i=1 ; $i<10 ; $i++) {
			echo substr(time(),4) . rand(10,99) . '<br>';
		}
	}

}
