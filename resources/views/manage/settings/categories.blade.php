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
		<div class="col-md-4"><p class="title">{{ trans('manage.settings.categories') }}</p></div>
		<div class="col-md-8 tools">

			@include('manage.frame.widgets.toolbar_button' , [
				'target' => "masterModal('".url('manage/upstream/edit/categories/0/'.$branch->id)."')" ,
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
					<td>#</td>
					<td>{{ trans('validation.attributes.title') }}</td>
					<td>{{ trans('validation.attributes.slug') }}</td>
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $key=> $model)
					<tr>
						<td>
							@pd($key+1)
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{url("manage/upstream/edit/categories/$model->id/")}}')">
								{{ $model->title }}
							</a>
						</td>
						<td>
							{{ $model->slug  }}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>


@endsection