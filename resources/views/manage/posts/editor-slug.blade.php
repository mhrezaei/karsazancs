@if(Auth::user()->isDeveloper())
	<div class="panel panel-default w100">
		<div class="panel-heading">
			{{ trans('validation.attributes.slug') }}
		</div>

		<div class="text-center m10 ">
			<input type="text" name="slug" time="1" placeholder="{{trans('Slug (English Only)')}}"  value="{{$model->slug}}" class="form-control text-center ltr ">
		</div>

	</div>
@else

@endif

