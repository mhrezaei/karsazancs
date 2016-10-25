@if(Auth::user()->can("$module.*"))
	@include('forms.group-start' , [
		'label' => $label,
	])

	<div class="row w100 m5">
		@foreach($model->availableModules($permits) as $permit)
			@if(Auth::user()->can("$module.$permit"))
				<div class="col-md-3">
					<div class="checkbox">
						<label>
							<input type="hidden" name="role_{{$module}}_{{$permit}}" value="0">
							{!! Form::checkbox("role_".$module."_".$permit , '1' , $model->can("$module.$permit")? '1' : '0' , ['class' => '-permits']) !!}
							{{ trans('manage.permits.'.$permit) }}
						</label>
					</div>
				</div>
			@endif
		@endforeach
	</div>

	@include('forms.group-end')
@endif
