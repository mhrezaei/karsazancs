@if($model->canDelete())
	<div class="text-center m10">
		<a href="#" class="btn {{ $class or 'btn-danger' }}  btn-sm" onclick="$('#divDeleteWarning').slideDown('fast')">
			<span class="{{ isset($class)? 'text-danger' : '' }}">
				{{ trans('forms.button.soft_delete') }}
			</span>
		</a>
	</div>
@endif
