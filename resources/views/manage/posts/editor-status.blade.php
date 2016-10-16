<div class="panel panel-default w100">
	<div class="panel-heading">
		{{ trans('posts.manage.current_status') }}
	</div>

	<div class="text-center m10 alert alert-{{$model->status('color')}}">
		{{ $model->status('text') }}
	</div>
</div>