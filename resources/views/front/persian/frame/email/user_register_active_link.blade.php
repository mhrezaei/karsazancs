@extends('front.persian.frame.email.email_frame')

@section('email_content')
	{{ $data['name_first'] }} عزیز
    <br>
    جهت فعال سازی حساب خود برروی لینک زیر کلیک نمائید.
    <br>
    <a href="{{ url('/register/confirm/') . $data['remember_token'] }}">{{ url('/register/confirm/') . $data['remember_token'] }}</a>
@endsection