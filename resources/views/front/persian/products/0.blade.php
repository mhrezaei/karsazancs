@extends('front.persian.frame.frame')

@section('page_title')
    {{ trans('front.site_title') }} | {{ trans('front.products') }}
@endsection
@section('content')
    @if(Setting::isLocale('en'))
        @include('front.english.products.content')
    @else
        @include('front.persian.products.content')
    @endif
@endsection