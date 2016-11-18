@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/payments/save/create') ,
	'modal_title' => trans('payments.new'),
	'no_validation' => 1 ,
])

<div class='modal-body'>

	@include("forms.input" , [
		'name' => "order_no",
		'class' => "form-required form-default",
	])

	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep')

	@include('forms.group-start')

	@include('forms.button' , [
		'label' => trans('payments.new'),
		'shape' => 'success',
		'type' => 'submit' ,
		'value' => 'save' ,
	])

	@include('forms.button' , [
		'label' =>  trans('forms.button.cancel')  ,
		'shape' => 'link',
		'link' => '$(".modal").modal("hide")',
	])

	@include('forms.group-end')

	@include('forms.feed')

</div>
@include('templates.modal.end')