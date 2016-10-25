@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/admins/save/hard_delete'),
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
		'label' => trans('validation.attributes.name_first'),
		'value' => $model->fullName() ,
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