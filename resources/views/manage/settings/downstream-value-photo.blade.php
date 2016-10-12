{{--@include('forms.sep')--}}

@include('forms.group-start' , [
    'label' => isset($domain)? $domain->title : trans('validation.attributes.global_value'),
])

	<div class="row">
		<div class="col-md-3">
			<button id="{{ isset($domain)? "btn-".$domain->slug : "btn-global" }}" data-input="{{ $input_id = isset($domain)? "txt-".$domain->slug : "txt-global" }}" data-callback="downstreamPhotoSelected('#{{ $input_id }}')" class="btn btn-default btn-sm">
				{{ trans('forms.button.browse_image') }}
			</button>
		</div>
		<div class="col-md-9">
			<input id="{{ $input_id }}" type="text" name="{{ isset($domain)? $domain->slug : 'global_value' }}" value="{{ $value or ''  }}" readonly class="form-control ltr clickable text-grey italic" onclick="downstreamPhotoPreview('#{{ $input_id }}')">
			<i class="fa fa-times text-grey clickable" style="position: relative;top:-25px;left:-10px" onclick="$('#{{$input_id}}').val('')"></i>
		</div>
	</div>


	<script>
		$('#{{ isset($domain)? "btn-".$domain->slug : "btn-global" }}').filemanager('image');
	</script>

@include('forms.group-end')
