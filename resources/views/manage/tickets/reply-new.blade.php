@include('forms.sep' , [
	'label' => trans('tickets.your_reply')
])

@include('forms.hiddens' , ['fields' => [
	['id' , $model->id ],
	['original_department' , $model->department_en ],
]])


@include('forms.textarea' , [
	'name' => 'text',
	'class' => 'form-default form-required' ,
])

<div class="-more noDisplay">
	@include('forms.input' , [
		'name' => 'title',
		'value' => $model ,
		'class' => 'form-required' ,
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

</div>
@include('forms.sep')

@include('forms.group-start')

	@include('forms.button' , [
		'label' => trans('forms.button.send_and_save'),
		'shape' => 'success',
		'type' => 'submit' ,
		'value' => 'save' ,
	])
	@include('forms.button' , [
		'label' => trans('forms.button.details'),
		'shape' => 'primary',
		'type' => 'button' ,
		'link' => '$(".-more").slideToggle()' ,
	])
	@include('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '$(".modal").modal("hide")',
	])

@include('forms.group-end')

@include('forms.feed')

