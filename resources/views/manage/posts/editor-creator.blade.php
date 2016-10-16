<div class="panel panel-default w100">
	<div class="panel-heading">
		{{ trans('posts.manage.creator') }}
	</div>

	@if($model->id)
		<div class="m10 text-center">
			{{ $model->say('created_by') }}
		</div>
		<div class="m10 text-center text-grey">
			{{ $model->say('created_at') }}
		</div>
	@else
		<div class="m10 text-center">
			{{ Auth::user()->fullName() }}
		</div>
	@endif

</div>