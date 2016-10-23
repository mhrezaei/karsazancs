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
		<div class="col-md-4"><p class="title">{{ trans('manage.settings.departments') }}</p></div>
		<div class="col-md-8 tools">
			@include('manage.frame.widgets.toolbar_button' , [
				'target' => "masterModal('".url('manage/upstream/edit/department')."')" ,
				'type' => 'success' ,
				'caption' => trans('forms.button.add') ,
				'icon' => 'plus-circle' ,
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
					<td>&nbsp;</td>
					<td>{{ trans('validation.attributes.title') }}</td>
					<td>{{ trans('validation.attributes.slug') }}</td>
					<td>{{ trans('forms.general.online') }}</td>
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $model)
					<tr>
						<td>
							<i class="fa fa-{{$model->icon}}"></i>
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{url("manage/upstream/edit/department/$model->id")}}')">
								{{ $model->title }}
							</a>
						</td>
						<td>{{ $model->slug }}</td>
						<td>
							@if($model->can_online)
								<i class="fa fa-check text-success"></i>
							@else
								-
							@endif
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>


@endsection
