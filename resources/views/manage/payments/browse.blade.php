@extends('manage.frame.use.0')

@section('section')
	@include('manage.payments.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-6">
			<p class="title">
				{{trans('payments.of')}}
				{{$page[1][1] or ''}}
				:
				{{$page[2][1] or ''}}
			</p>
		</div>
		<div class="col-md-6 tools">

			@if(Auth::user()->can('payments.create'))
				@include('manage.frame.widgets.toolbar_button' , [
					'target' => 'masterModal("'. url('manage/payments/create') . '") ',
					'type' => 'success' ,
					'caption' => trans('payments.new') ,
					'icon' => 'plus-circle' ,
				])

			@endif

			{{--@include('manage.frame.widgets.toolbar_search_inline' , [--}}
				{{--'target' => url('manage/payments/search/') ,--}}
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
		'table_id' => 'tblPayments' ,
		'row_view' => 'manage.payments.browse-row' ,
		'selector' => false ,
		'counter' => true ,
		'headings' => [
			trans('orders.type.title'),
			trans('validation.attributes.amount'),
			trans('validation.attributes.status'),
			trans('forms.button.action'),
		],
	])
@endsection