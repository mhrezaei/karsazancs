@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/tickets/save/'),
	'modal_title' => $model->id? trans('tickets.edit_ticket') : trans('tickets.new_ticket') ,
	'no_validation' => 1 ,
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
		['user_id' , $model->user_id ],
	]])

	@if($model->user_id)
		@include('forms.input' , [
			'name' => '',
			'class' => '' ,
			'label' => trans('validation.attributes.sender'),
			'value' => $model->user->full_name ,
			'extra' => 'disabled' ,
		])
	@endif

	@if(!$model->id and $model->user_id==0)
		@include('forms.input' , [
			'name' => 'code_melli',
			'class' => 'form-required form-default' ,
			'hint' => trans('tickets.code_melli_hint'),
		])
	@endif

	@include('forms.input' , [
		'name' => 'title',
		'value' => $model ,
		'class' => $model->user_id? 'form-required form-default' : 'form-required' ,
	])

	@include('forms.textarea' , [
		'name' => 'text',
		'value' => $model ,
	])

	@include('forms.select' , [
		'name' => 'priority' ,
		'class' => 'form-required',
		'options' => $model->priorityCombo() ,
		'caption_field' => '1' ,
		'value_field' => '0' ,
		'value' => $model->priority ,
	])

	@include('forms.select' , [
		'name' => 'department' ,
		'class' => 'form-required',
		'options' => $model->departmentsCombo() ,
		'value_field' => 'slug' ,
		'value' => $model->department ,
		'blank_value' => $model->department? 'NO' : '' ,
	])


	@include('forms.sep')

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('forms.button.save'),
			'shape' => 'success',
			'type' => 'submit' ,
			'value' => 'save' ,
		])

		@if($model->id)
			@if($model->archived)
				@include('forms.button' , [
					'label' => trans('tickets.reopen_ticket'),
					'shape' => 'warning',
					'type' => 'submit' ,
					'value' => 'reopen' ,
				])
			@else
				@include('forms.button' , [
					'label' => trans('tickets.archive_ticket'),
					'shape' => 'danger',
					'type' => 'submit' ,
					'value' => 'archive' ,
				])
			@endif
		@endif


	@include('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '$(".modal").modal("hide")',
	])

	@include('forms.group-end')

	@include('forms.feed')

</div>
@include('templates.modal.end')