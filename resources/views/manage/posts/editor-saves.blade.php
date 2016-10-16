@if(!$model->trashed())
	<div class="panel panel-default w100">
		<div class="panel-heading">
			{{ trans('posts.manage.operation') }}
		</div>

		@if($model->isPublished())
			@include('manage.posts.editor-saves-preview' , ['text'=>trans('posts.manage.view_in_site')])
			@include('manage.posts.editor-saves-update' )
			<hr>
			@include('manage.posts.editor-saves-unpublish')
			@include('manage.posts.editor-saves-delete')
		@elseif($model->isScheduled())
			@include('manage.posts.editor-saves-preview')
			@include('manage.posts.editor-saves-update' )
			<hr>
			@include('manage.posts.editor-saves-unpublish')
			@include('manage.posts.editor-saves-delete')
		@else
			@include('manage.posts.editor-saves-preview')
			@include('manage.posts.editor-saves-draft')
			@include('manage.posts.editor-saves-review')
			@include('manage.posts.editor-saves-publish')
			@include('manage.posts.editor-saves-delete' , ['class' => 'btn-link'])
		@endif
	</div>
@endif