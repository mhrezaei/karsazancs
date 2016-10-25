@if($model->branch()->hasFeature('image'))
	<div class="panel panel-default w100">
		<div class="panel-heading">
			{{ trans('posts.manage.featured_image') }}
		</div>

		<div class="m10 text-center" style="">
			<btn id="btnFeaturedImage" data-input="txtFeaturedImage" data-preview="imgFeaturedImage" data-callback="postEditorFeatures('featured_image_inserted')" class="btn btn-{{ $model->featured_image? 'default' : 'primary' }}">
				{{ trans('forms.button.browse_image') }}
			</btn>
			<input id="txtFeaturedImage" type="hidden" name="featured_image" value="{{ $model->featured_image? url($model->featured_image) : '' }}">
			<div id="divFeaturedImage" class="{{ $model->featured_image? '' : 'noDisplay' }}">
				<div class="text-center">
					<img id="imgFeaturedImage" src="{{ $model->featured_image? url($model->featured_image) : '' }}" style="margin-top:15px;max-height:100px;max-width: 100%">
				</div>
				<btn id="btnDeleteFeaturedImage" class="btn btn-link btn-xs">
				<span class="text-danger clickable" onclick="postEditorFeatures('featured_image_deleted')">
					{{ trans('posts.manage.delete_featured_image') }}
				</span>
				</btn>
			</div>
		</div>
	</div>

	<script>
		$('#btnFeaturedImage').filemanager('image');
	</script>
@endif