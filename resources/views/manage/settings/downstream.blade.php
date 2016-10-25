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
		<div class="col-md-4"><p class="title">{{ trans('manage.settings.downstream') }}</p></div>
		<div class="col-md-8 tools">

			@include('manage.frame.widgets.toolbar_button' , [
				'target' => "masterModal('".url('manage/upstream/edit/downstream/')."')" ,
				'type' => 'success' ,
				'caption' => trans('forms.button.add') ,
				'icon' => 'plus-circle' ,
			])
			@include('manage.frame.widgets.toolbar_search' , [
				'target' => url('manage/upstream/downstream/search/-key-') ,
				'label' => trans('forms.button.search') ,
				'value' => isset($key)? $key : '' ,
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
					<td>{{ trans('validation.attributes.category_id') }}</td>
					<td>{{ trans('validation.attributes.data_type') }}</td>
					<td>{{ trans('validation.attributes.value') }}</td>
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $key=> $model)
					<tr>
						<td>
							@pd($key+1)
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{ url('manage/upstream/edit/downstream/'.$model->id)  }}')">
								{{ $model->title }}
							</a>
							<i class="mh5 text-grey f10">{{ $model->slug }}</i>
							@if($model->developers_only)
								<i class="fa fa-minus-circle text-danger"></i>
							@endif
						</td>
						<td>
							{{ trans("manage.settings.downstream_settings.category.$model->category") }}
						</td>
						<td>
							{{ trans("manage.settings.downstream_settings.data_type.$model->data_type")  }}
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{url("manage/upstream/downstream/$model->id")}}')">
								@if($model->value())
									@if(in_array($model->data_type , ['text' , 'textarea' , 'array']))
										{{ str_limit($model->value() , 50) }}
									@elseif($model->data_type == 'boolean')
										<i class="fa fa-check"></i>
									@elseif($model->data_type == 'date')
										@pd(jdate($model->value())->format('Y/m/d'))
									@elseif($model->data_type == 'photo')
										<i class="fa fa-image"></i>
									@endif
								@else
									<i class="text-grey">{{ trans('manage.settings.downstream_settings.unset') }}</i>
								@endif
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="paginate">
		{!! $model_data->render() !!}
	</div>



@endsection