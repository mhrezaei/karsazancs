@extends('manage.frame.use.0')

@section('section')
	@include('manage.products.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[0][1] or ''}} ({{$page[1][1] or ''}})</p></div>
		<div class="col-md-8 tools">

			@if(Auth::user()->can('products.create'))
				@include('manage.frame.widgets.toolbar_button' , [
					'target' => 'masterModal("'. url('manage/products/create') . '") ',
					'type' => 'success' ,
					'caption' => trans('products.new') ,
					'icon' => 'plus-circle' ,
				])

			@endif

			@include('manage.frame.widgets.toolbar_search_inline' , [
				'target' => url('manage/products/search/') ,
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
		'table_id' => 'tblProducts' ,
		'row_view' => 'manage.products.browse-row' ,
		'selector' => false ,
		'counter' => true ,
		'headings' => [
			trans('validation.attributes.title') ,
			trans('validation.attributes.card_price'),
			trans('validation.attributes.initial_charge'),
			trans('validation.attributes.inventory'),
			trans('validation.attributes.status'),
			trans('forms.button.action'),
		],
	])
@endsection