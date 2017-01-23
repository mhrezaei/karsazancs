@extends('manage.frame.use.0')

@section('page_title' , Setting::get('fa_site_title'))

@section('section')
	{{--@include('manage.index.hello')--}}

	<div class="row">
		@foreach($digests as $digest)
			@include('manage.frame.widgets.digest' , $digest)
		@endforeach
	</div>
@endsection