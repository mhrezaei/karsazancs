@if($model->status('slug')=='under_review')
	<div class="text-center m10">
		<button type="button" class="btn btn-primary btn-sm" onclick="postSave('save')">{{ trans('posts.manage.keep_to_review') }}</button>
	</div>
@else
	<div class="text-center m10">
		<button type="button" class="btn btn-primary btn-sm" onclick="postSave('save')">{{ trans('posts.manage.save_to_review') }}</button>
	</div>
@endif
