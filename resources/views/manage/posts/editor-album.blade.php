<div class="panel panel-default w100">
	{{--
	|--------------------------------------------------------------------------
	| Title
	|--------------------------------------------------------------------------
	| 
	--}}

	<div class="panel-heading">
		{{ trans('posts.post_photos.title') }}
		&nbsp;(
		<span id="spnPhotoCount" >@pd($model->photos_count)</span>
		)
	</div>

	{{--
	|--------------------------------------------------------------------------
	| Already uploaded photos
	|--------------------------------------------------------------------------
	| 
	--}}
	<div id="divPhotos">
		@foreach($model->photos as $key => $photo)
			@include('manage.posts.editor-album-one' , [
				'key' => $key ,
				'src' => $photo['src'] ,
				'label' => $photo['label'] ,
				'link' => isset($photo['link'])? $photo['link'] : '',
			])
		@endforeach
	</div>
	<div id="divNewPhoto">
		@include('manage.posts.editor-album-one' , [
			'key' => 'NEW' ,
			'class' => 'noDisplay'
		])
	</div>
	<input type="hidden" id="txtLastKey" value="{{$key or 0}}">


	{{--
	|--------------------------------------------------------------------------
	| New Panel
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="m10 text-center" style="">
		<btn id="btnAddPhoto" data-input="txtAddPhoto" data-preview="imgAddPhoto" data-callback="postPhotoAdded()" class="btn btn-default btn-lg">
			{{ trans('posts.post_photos.add') }}
		</btn>
		<input type="hidden" id="txtAddPhoto">
		<img id="imgAddPhoto" class="noDisplay" src="">
	</div>

</div>

{{--
|--------------------------------------------------------------------------
| Javascript function
|--------------------------------------------------------------------------
|
--}}

<script>
	$('#btnAddPhoto').filemanager('image');
</script>