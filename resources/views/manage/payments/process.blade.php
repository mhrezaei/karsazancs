@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/payments/save/process') ,
	'modal_title' => trans('payments.process'),
	'no_validation' => 1 ,
])

<div class='modal-body'>
	@include("forms.hiddens" , [ 'fields' => [
		['id' , $model->id] ,
	]])

	@include('manage.payments.editor-inputs' , [
		'displayDetails' => "none",
	])

	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep')

	@include("forms.select" , [
		'name' => "status",
		'id' => "cmbStatus",
		'class' => "form-required form-default",
		'options' => [
			['confirmed' , trans('payments.form.fully_confirm')],
			['rejected' , trans('payments.form.fully_reject')],
			['custom' , trans('payments.form.process_other_options')],
		],
		'caption_field' => "1",
		'value_field' => "0",
		'value' => '' ,
		'blank_value' => "",
		'blank_label' => trans('forms.general.select_default'),
		'on_change' => "paymentProcessEditor()",
		'value' => $model->status_in_process,
	])

	@include("forms.input" , [
		'name' => "amount_confirmed",
		'id' => "txtConfirmed",
		'class' => "form-required form-numberFormat",
		'value' => $model,
	])

	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep')

	@include('forms.group-start')

	@include('forms.button' , [
		'label' => trans('payments.form.fully_confirm'),
		'id' => "btnConfirm",
		'shape' => 'primary',
		'type' => 'submit' ,
		'value' => 'save' ,
		'class' => "saveButton noDisplay",
	])
	@include('forms.button' , [
		'label' => trans('forms.button.save'),
		'id' => "btnSave",
		'shape' => 'success',
		'type' => 'submit' ,
		'value' => 'save' ,
		'class' => "saveButton",
	])
	@include('forms.button' , [
		'label' => trans('payments.form.fully_reject'),
		'id' => "btnReject",
		'shape' => 'danger',
		'type' => 'submit' ,
		'value' => 'save' ,
		'class' => "saveButton noDisplay",
	])

	@include("forms.button" , [
		'shape' => "default",
		'label' => trans('forms.button.show_details'),
		'link' => "$('.payment_details').slideToggle('fast' , function() { $('#cmbStatus').focus() } )",
		'class' => "payment_details",
	])

	@include('forms.button' , [
		'label' =>  trans('forms.button.cancel')  ,
		'shape' => 'link' ,
		'link' => '$(".modal").modal("hide")',
	])

	@include('forms.group-end')

	@include('forms.feed')

</div>
@include('templates.modal.end')