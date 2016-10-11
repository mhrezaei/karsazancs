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
		<div class="col-md-4"><p class="title">{{ trans('manage.settings.states') }}</p></div>
		<div class="col-md-8 tools">

			@include('manage.frame.widgets.toolbar_button' , [
				'target' => 'masterModal("'.url('manage/upstream/edit/state/0').'")' ,
				'type' => 'success' ,
				'caption' => trans('forms.button.add') ,
				'icon' => 'plus-circle' ,
			])
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
					<td>{{ trans('validation.attributes.province_id') }}</td>
					<td>{{ trans('validation.attributes.capital_id') }}</td>
					<td>{{ trans('manage.settings.cities') }}</td>
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $model)
					<tr>
						<td id="domain-{{$model->id}}-title" data-toggle="{{$model->title}}">
							<a href="javascript:void(0)" onclick="masterModal('{{ url('manage/upstream/edit/state/'.$model->id) }}')">
								{{ $model->title }}
							</a>
						</td>
						<td id="domain-{{$model->id}}-capital" data-toggle="{{$model->capital()->title}}" >
							{{ $model->capital()->title }}
						</td>
						<td>
							<a href="{{url('manage/upstream/states/'.$model->id)}}" >
								@pd($model->cities()->count().' '.trans('manage.settings.city'))
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection