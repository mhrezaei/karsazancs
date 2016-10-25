@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/posts/save/hard_delete'),
	'modal_title' => trans('forms.button.hard_delete'),
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
		'label' => trans('validation.attributes.title'),
		'value' => $model->say('title') ,
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