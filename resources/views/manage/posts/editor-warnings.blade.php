{{--
|--------------------------------------------------------------------------
| Delete Warning
|--------------------------------------------------------------------------
|
--}}
<div id="divDeleteWarning" class="alert alert-danger row w95 margin-auto noDisplay">
	<div class="col-md-1 p10 f45 text-center">
		<div class="fa fa-warning"></div>
	</div>
	<div class="col-md-11">
		<div class="m10">
			@if($model->isPublished())
				{{ trans('posts.manage.confirm_published_delete') }}
			@else
				{{ trans('posts.manage.confirm_delete') }}
			@endif
		</div>
		<div class="m10">
			{{ trans('forms.general.ask_confirm') }}
		</div>
		<div class="m10">
			<button class="btn btn-danger w20" onclick="postChange('delete')">{{ trans('forms.button.soft_delete') }}</button>
			<button class="btn btn-link w10" onclick="$('#divDeleteWarning').slideUp('fast')">{{ trans('forms.button.oh_no') }}</button>
		</div>
	</div>
</div>


{{--
|--------------------------------------------------------------------------
| Unpublish Warning
|--------------------------------------------------------------------------
|
--}}
<div id="divUnpublishWarning" class="alert alert-warning row w95 margin-auto noDisplay">
	<div class="col-md-1 p10 f45 text-center">
		<div class="fa fa-warning"></div>
	</div>
	<div class="col-md-11">
		<div class="m10">
			{{ trans('posts.manage.confirm_unpublish') }}
		</div>
		<div class="m10">
			{{ trans('forms.general.ask_confirm') }}
		</div>
		<div class="m10">
			<button class="btn btn-warning w20" onclick="postChange('unpublish')">{{ trans('posts.manage.unpublish') }}</button>
			<button class="btn btn-link w10" onclick="$('#divUnpublishWarning').slideUp('fast')">{{ trans('forms.button.oh_no') }}</button>
		</div>
	</div>
</div>