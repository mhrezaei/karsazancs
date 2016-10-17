@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/admins/save/change_password'),
	'modal_title' => trans('people.commands.change_password'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , isset($model)? $model->id : '0'],
	]])


	@include('forms.input' , [
		'name' => '',
		'label' => trans('validation.attributes.name_first'),
		'value' => $model->fullName() ,
		'extra' => 'disabled' ,
	])

	@include('forms.input' , [
		'name' => 'password',
		'value' => rand(10000000 , 99999999),
		'class' => 'form-required ltr form-default'
	])

	@include('forms.group-start')

		@include('forms.check' , [
			'name' => 'sms_notify',
			'label' => trans('people.form.notify-with-sms'),
			'value' => 1,
		])

	@include('forms.group-end')


	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('forms.button.save'),
			'shape' => 'success',
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