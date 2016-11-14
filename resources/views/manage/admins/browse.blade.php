@extends('manage.frame.use.0')

@section('section')
	@include('manage.admins.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[1][1] or ''}}</p></div>
		<div class="col-md-8 tools">

			@include('manage.frame.widgets.toolbar_button' , [
				'target' => 'masterModal("'. url('manage/admins/create') . '") ',
				'type' => 'success' ,
				'caption' => trans('people.admins.create') ,
				'icon' => 'plus-circle' ,
			])

			@include('manage.frame.widgets.toolbar_search_inline' , [
				'target' => url('manage/admins/search/') ,
				'label' => trans('forms.button.search') ,
				'value' => isset($keyword)? $keyword : '' ,
			])
		</div>
	</div>


	{{--
	|--------------------------------------------------------------------------
	| Grid...
	|--------------------------------------------------------------------------
	|
	--}}

	@include('manage.frame.widgets.grid' , [
		'table_id' => 'tblAdmins' ,
		'row_view' => 'manage.admins.browse-row' ,
		'selector' => true ,
		'headings' => [
			trans('validation.attributes.name_first') ,
			trans('people.commands.last_login'),
			trans('people.admins.roles'),
			trans('validation.attributes.status'),
			trans('forms.button.action'),
		],
	])
@endsection