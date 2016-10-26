@extends('manage.frame.use.0')

@section('section')
	{{--@include('manage.customers.tabs')--}}

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[2][1] . ' '.$model->title}}</p></div>
		<div class="col-md-8 tools">

			@include('manage.frame.widgets.toolbar_button' , [
				'target' => 'masterModal("'. url('manage/currencies/'.$model->id.'/query') . '") ',
				'type' => 'primary' ,
				'caption' => trans('currencies.query') ,
				'icon' => 'plus-circle' ,
			])
			@if(Auth::user()->can('currencies.process'))
				@include('manage.frame.widgets.toolbar_button' , [
					'target' => 'masterModal("'. url('manage/currencies/'.$model->id.'/update') . '") ',
					'type' => 'success' ,
					'caption' => trans('currencies.update_price') ,
					'icon' => 'plus-circle' ,
				])
			@endif

		</div>
	</div>


	{{--
	|--------------------------------------------------------------------------
	| Grid...
	|--------------------------------------------------------------------------
	|
	--}}

	@include('manage.frame.widgets.grid' , [
		'table_id' => 'tblHistory' ,
		'row_view' => 'manage.currencies.history-row' ,
		'counter' => true ,
		'headings' => [
			trans('validation.attributes.effective_date') ,
			trans('validation.attributes.price_to_buy'),
			trans('validation.attributes.price_to_sell'),
			trans('forms.general.created_at'),
			trans('forms.general.by')
		],
	])

@endsection