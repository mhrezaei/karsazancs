@extends('manage.frame.use.0')

@section('section')
	@include('manage.tickets.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-6">
			<p class="title">
				{{$page[0][1]. ': ' . $page[1][1]}}
			</p>
		</div>
		<div class="col-md-6 tools">
			@include('manage.frame.widgets.toolbar_button' , [
				'target' => 'window.open("'. url('manage/tickets/'.$department->slug.'/chat') . '") ',
				'type' => 'primary' ,
				'caption' => trans('tickets.online_chat_hull') ,
				'icon' => 'plus-circle' ,
			])
			@include('manage.frame.widgets.toolbar_button' , [
				'target' => 'masterModal("'. url('manage/tickets/'.$department->slug.'/create') . '") ',
				'type' => 'success' ,
				'caption' => trans('tickets.new_ticket') ,
				'icon' => 'plus-circle' ,
			])

			{{--@include('manage.frame.widgets.toolbar_search_inline' , [--}}
				{{--'target' => url('manage/posts/'.$department->slug.'/searched/') ,--}}
				{{--'label' => trans('forms.button.search') ,--}}
				{{--'value' => isset($keyword)? $keyword : '' ,--}}
			{{--])--}}
		</div>
	</div>



	{{--
	|--------------------------------------------------------------------------
	| Grid
	|--------------------------------------------------------------------------
	|
	--}}

	@include('manage.frame.widgets.grid' , [
		'table_id' => 'tblTickets' ,
		'row_view' => 'manage.tickets.browse-row' ,
		'selector' => true ,
		'headings' => [
			trans('validation.attributes.title'),
			trans('tickets.dialogue'),
			trans('validation.attributes.status'),
			trans('validation.attributes.feedback'),
			trans('forms.button.action'),
		],
	])


@endsection