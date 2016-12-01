@extends('front.persian.frame.frame')

@section('page_title')
    {{ trans('front.site_title') }} | {{ $page->title }}
@endsection
@section('content')
    @include('front.persian.page.content')
@endsection