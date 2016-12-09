@extends('front.persian.frame.frame')

@section('page_title')
    {{ trans('front.site_title') }} | {{ trans('front.contact_us') }}
@endsection
@section('content')
    @include('front.persian.contact.content')
@endsection