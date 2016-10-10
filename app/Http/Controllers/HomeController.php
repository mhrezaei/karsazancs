<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->isAdmin())
            return redirect('/manage') ;
        else
            return redirect('/profile') ;
        dd(Auth::user()->isAdmin()) ;
        return view('home');
    }

    public function logout()
    {
        Auth::logout() ;
        return redirect('/login');
    }
}
