@if($model->created_by == Auth::user()->id or !$model->id)
	<div class="text-center m10">
		<button type="button" class="btn btn-info btn-sm" onclick="postSave('draft')">{{ trans('posts.manage.save_as_draft') }}</button>
	</div>
@elseif($model->is_draft)
	<div class="text-center m10">
		<button type="button" class="btn btn-info btn-sm" onclick="postSave('draft')">{{ trans('posts.manage.keep_as_draft') }}</button>
	</div>
@else
	<div class="text-center m10">
		<button type="button" class="btn btn-danger btn-sm" onclick="postSave('draft')">{{ trans('posts.manage.reject_as_draft') }}</button>
	</div>
@endif
