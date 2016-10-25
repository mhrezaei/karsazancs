@if($model->branch()->hasFeature('preview'))
	<div class="text-center m10">
		<a href="{{ $model->say('preview') }}" target="_blank" class="btn btn-link btn-sm">
			{{ $text or trans('posts.manage.preview_in_site') }}
		</a>
	</div>
@endif