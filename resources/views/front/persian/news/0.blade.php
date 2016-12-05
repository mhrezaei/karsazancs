@extends('front.persian.frame.frame')

@section('page_title')
    {{ trans('front.site_title') }} | {{ trans('front.news') }}
@endsection
@section('content')
    @include('front.persian.news.content')
@endsection