@extends('manage.frame.use.0')

@section('section')
	@include('manage.orders.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-6">
			<p class="title">
				{{trans('orders.of')}}
				{{$page[1][1] or ''}}
				:
				{{$page[2][1] or ''}}
			</p>
		</div>
		<div class="col-md-6 tools">

			@if(Auth::user()->can('orders.create'))
				@include('manage.frame.widgets.toolbar_button' , [
					'target' => 'masterModal("'. url('manage/orders/create') . '") ',
					'type' => 'success' ,
					'caption' => trans('orders.new') ,
					'icon' => 'plus-circle' ,
				])

			@endif

			{{--@include('manage.frame.widgets.toolbar_search_inline' , [--}}
				{{--'target' => url('manage/orders/search/') ,--}}
				{{--'label' => trans('forms.button.search') ,--}}
				{{--'value' => isset($keyword)? $keyword : '' ,--}}
			{{--])--}}
		</div>
	</div>


	{{--
	|--------------------------------------------------------------------------
	| Grid...
	|--------------------------------------------------------------------------
	|
	--}}

	@include('manage.frame.widgets.grid' , [
		'table_id' => 'tblOrders' ,
		'row_view' => 'manage.orders.browse-row' ,
		'selector' => false ,
		'counter' => true ,
		'headings' => [
			trans('orders.type.title'),
//			trans('validation.attributes.product_id') ,
			trans('validation.attributes.invoice'),
			trans('validation.attributes.status'),
			trans('forms.button.action'),
		],
	])
@endsection