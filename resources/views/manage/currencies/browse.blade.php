@extends('manage.frame.use.0')

@section('section')
	@include('manage.currencies.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[1][1] or ''}}</p></div>
		<div class="col-md-8 tools">

			@if(Auth::user()->can('currencies.create'))
				@include('manage.frame.widgets.toolbar_button' , [
					'target' => 'masterModal("'. url('manage/currencies/create') . '") ',
					'type' => 'success' ,
					'caption' => trans('currencies.new_currency') ,
					'icon' => 'plus-circle' ,
				])

			@endif

			@include('manage.frame.widgets.toolbar_search_inline' , [
				'target' => url('manage/currencies/search/') ,
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
		'table_id' => 'tblCurrencies' ,
		'row_view' => 'manage.currencies.browse-row' ,
		'selector' => true ,
		'headings' => [
			trans('validation.attributes.currency_title') ,
			trans('validation.attributes.price_to_buy'),
			trans('validation.attributes.price_to_sell'),
			trans('forms.general.updated_at'),
			trans('forms.button.action'),
		],
	])
@endsection