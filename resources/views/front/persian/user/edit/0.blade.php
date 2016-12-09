@extends('front.persian.frame.frame')

@section('page_title')
    {{ trans('front.site_title') }} | {{ trans('front.profile') . ' ' . $user->name_first }}
@endsection
@section('content')
    @include('front.persian.user.edit.content')
@endsection