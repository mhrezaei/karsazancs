@extends('front.persian.frame.frame')

@section('page_title')
    {{ trans('front.site_title') }} | {{ trans('front.faq') }}
@endsection
@section('content')
    @include('front.persian.faq.content')
@endsection