@extends('manage.frame.use.0')

@section('section')
	@include('manage.customers.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[1][1] or ''}}</p></div>
		<div class="col-md-8 tools">

			{{--@include('manage.frame.widgets.grid-action' , [--}}
				{{--'id' => '0',--}}
				{{--'button_size' => 'md' ,--}}
				{{--'button_class' => 'primary' ,--}}
				{{--'button_label' => trans('forms.button.bulk_action'),--}}
				{{--'button_extra' => 'disabled' ,--}}
				{{--'actions' => [--}}
{{--//					['envelope-o' , trans('people.commands.send_email') , 'modal:manage/volunteers/-id-/email' , 'volunteers.send' ] ,--}}
{{--//					['mobile' , trans('people.commands.send_sms') , 'modal:manage/volunteers/-id-/sms' , 'volunteers.send' ] ,--}}
					{{--['check' , trans('people.commands.activate') , 'modal:manage/volunteers/-id-/publish' , 'volunteers.publish' , $page[1][2]!='bin' and $page[1][2]!='active'],--}}
					{{--['ban' , trans('people.commands.block') , 'modal:manage/volunteers/-id-/soft_delete' , 'volunteers.delete' , $page[1][2]!='bin'] ,--}}
					{{--['undo' , trans('people.commands.unblock') , 'modal:manage/volunteers/-id-/undelete' , 'volunteers.bin' , $page[1][2]=='bin'] ,--}}
					{{--['times' , trans('people.commands.hard_delete') , 'modal:manage/volunteers/-id-/hard_delete' , 'volunteers.developer' , $page[1][2]=='bin'] ,--}}

				{{--]--}}
			{{--])--}}

			@if(Auth::user()->can('customers.create'))
				@include('manage.frame.widgets.toolbar_button' , [
					'target' => 'masterModal("'. url('manage/customers/create') . '") ',
					'type' => 'success' ,
					'caption' => trans('people.customers.create') ,
					'icon' => 'plus-circle' ,
				])

			@endif

			@include('manage.frame.widgets.toolbar_search_inline' , [
				'target' => url('manage/customers/search/') ,
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
		'table_id' => 'tblCustomers' ,
		'row_view' => 'manage.customers.browse-row' ,
		'selector' => true ,
		'headings' => [
			trans('validation.attributes.name_first') ,
			trans('validation.attributes.status'),
			trans('people.commands.activity'),
			trans('forms.button.action'),
		],
	])
@endsection