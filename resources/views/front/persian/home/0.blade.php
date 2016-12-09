@extends('front.persian.frame.frame')

@section('page_title')
    {{ trans('front.site_title') }} | {{ trans('front.home_page') }}
@endsection
@section('content')
    @include('front.persian.home.main_title')
    @include('front.persian.home.feature')
    <div class="container">
        @include('front.persian.home.services')
        @include('front.persian.home.products')
    </div>
    @include('front.persian.home.about')
@endsection

