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
		<div class="col-md-4"><p class="title">{{$page[1][1] or ''}}</p></div>
		<div class="col-md-8 tools">

			@if(Auth::user()->can('customers.edit'))
				@include('manage.frame.widgets.toolbar_button' , [
					'target' => 'masterModal("'. url('manage/customers/'.$model->id.'/new_account') . '") ',
					'type' => 'success' ,
					'caption' => trans('posts.manage.create' , ['thing' => trans('people.commands.bank_account')]) ,
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
		'table_id' => 'tblAccounts' ,
		'row_view' => 'manage.customers.accounts-row' ,
		'counter' => true ,
		'headings' => [
			trans('validation.attributes.bank_name') ,
			trans('validation.attributes.beneficiary'),
			trans('validation.attributes.sheba'),
		],
	])


@endsection