<div id="divUndeleteConfirm" class="alert alert-warning row w95 margin-auto">
	<div class="col-md-1 p10 f45 text-center">
		<div class="fa fa-warning"></div>
	</div>
	<div class="col-md-11">
		<div class="m10">
			{{ trans('posts.manage.warn_deleted_post') }}
		</div>
		@if($model->canBin() or $model->canDelete())
			<div class="m10">
				{{ trans('posts.manage.warn_deleted_post_hint') }}
			</div>
			<div class="m10">
				<button class="btn btn-warning w20" onclick="postChange('undelete')">{{ trans('forms.button.undelete') }}</button>
			</div>
		@endif
	</div>
</div>
