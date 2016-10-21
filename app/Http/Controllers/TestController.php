<?php

namespace App\Http\Controllers;

use App\models\Branch;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
	public function index()
	{
		return Carbon::now();

	}

}
