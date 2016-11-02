@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/tickets/save/hard_delete'),
	'modal_title' => trans('people.commands.hard_delete'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])

	@include('forms.note' , [
		'text' => trans('people.form.hard_delete_notice') ,
		'shape' => 'danger' ,
	])


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
			'label' => trans('people.commands.hard_delete'),
			'shape' => 'danger',
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