@if(Auth::user()->can('posts-'.$model->branch.'.publish'))
	<div class="text-center m10">
		<button type="button" class="btn btn-success btn-sm" onclick="postSave('publish')">
			{{trans('posts.manage.publish') }}
		</button>
	</div>
@endif

