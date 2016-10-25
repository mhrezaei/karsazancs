@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/currencies/save/query'),
	'modal_title' => trans('currencies.query'),
	'no_validation' => 1 ,
])
<div class='modal-body'>

	{{--
	|--------------------------------------------------------------------------
	| Form Begin
	|--------------------------------------------------------------------------
	| ID and `customer_type`
	--}}

	@include('forms.hiddens' , ['fields' => [
		['currency_id' , $model->id ],
	]])

	@include('forms.input' , [
		'name' => '' ,
		'label' => trans('validation.attributes.currency_title'),
		'value' => $model->full_name ,
		'extra' => 'disabled' ,
	])

	@include('forms.datepicker' , [
		'name' => 'date' ,
		'value' => time() ,
		'class' => 'form-required form-default'
	])
	@include('forms.input' , [
		'name' => 'time' ,
		'value' => \Carbon\Carbon::now()->format('H:i'),
		'class' => 'form-required ltr' ,
		'hint' => trans('validation.attributes_placeholder.time') ,
	])

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('currencies.query'),
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