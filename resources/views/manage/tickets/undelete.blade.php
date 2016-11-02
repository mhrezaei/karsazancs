@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/tickets/save/undelete'),
	'modal_title' => trans('forms.button.undelete'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])


	@include('forms.input' , [
		'name' => '',
		'class' => '' ,
		'label' => trans('validation.attributes.sender'),
		'value' => $model->user->full_name ,
		'extra' => 'disabled' ,
	])

	@include('forms.input' , [
		'name' => 'title',
		'label' => trans('validation.attributes.title'),
		'value' => $model ,
		'extra' => 'disabled' ,
	])

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('forms.button.undelete'),
			'shape' => 'primary',
			'type' => 'submit' ,
		])
		@include('forms.button' , [
			'label' => trans('forms.button.cancel'),
			'shape' => 'link',
			'link' => '$(".modal").modal("hide")',
		])

	@include('forms.group-end')

	@include('forms.feed')

</div>
@include('templates.modal.end')