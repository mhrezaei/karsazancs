@extends('manage.frame.use.0')

@section('section')
	@include('manage.settings.tabs-upstream')
	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}

	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[2][1]}}</p></div>
		<div class="col-md-8 tools">

			@if(isset($province))
				@include('manage.frame.widgets.toolbar_button' , [
					'target' => "masterModal('". url('manage/upstream/edit/city/0/'.$province->id) ."')" ,
					'type' => 'success' ,
					'caption' => trans('forms.button.add') ,
					'icon' => 'plus-circle' ,
				])
			@endif
			@include('manage.frame.widgets.toolbar_search' , [
				'target' => url('manage/upstream/states/search/-key-') ,
				'label' => trans('manage.settings.search_states') ,
			])
		</div>
	</div>

	{{--
	|--------------------------------------------------------------------------
	| Grid
	|--------------------------------------------------------------------------
	|
	--}}

	<div class="panel panel-default m20">
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
				<tr>
					<td>{{ trans('manage.settings.city') }}</td>
					<td>{{ trans('validation.attributes.province_id') }}</td>
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $model)
					<tr>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{ url('manage/upstream/edit/city/'.$model->id) }}')">
								{{ $model->title }}
								@if($model->isCapital())
									<span class="badge badge-success mh10 f7">{{ trans('validation.attributes.capital_id') }}</span>
								@endif
							</a>
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{ url('manage/upstream/edit/state/'.$model->province()->id) }}')">
								{{ $model->province()->title }}
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection