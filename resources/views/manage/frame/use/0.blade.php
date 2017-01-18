@extends('manage.frame.home')

@section('navbar-brand' ,view('manage.frame.use.brand',['page'=>$page]) )
@section('navbar-menus' ,view('manage.frame.use.topbar'))
@section('sidebar' , view('manage.frame.use.sidebar'))

@section('page_title')
	@if(isset($page[0][1]))
		{{$page[0][1]}} |&nbsp;
	@endif
	{{ Setting::get('fa_site_title') }}
@endsection

@section('modal')
	<div id="masterModal-lg" class="modal fade">
		<div class="modal-dialog modal-lg" >
			<div class="modal-content">
			</div>
		</div>
	</div>

	<div id="masterModal-md" class="modal fade">
		<div class="modal-dialog" >
			<div class="modal-content">
			</div>
		</div>
	</div>

	<div id="masterModal-sm" class="modal fade">
		<div class="modal-dialog" >
			<div class="modal-content modal-sm">
			</div>
		</div>
	</div>

@endsection