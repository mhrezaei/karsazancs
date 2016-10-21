@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/currencies/save/'),
	'modal_title' => $model->id? trans('currencies.edit_currency')  : trans('currencies.new_currency'),
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
		['id' , $model->id ],
	]])

	@include('forms.input' , [
		'name' => 'currency_title',
		'value' => $model->title ,
		'class' => 'form-required form-default' ,
		'hint' => trans('currencies.title_hint'),
	])
	@include('forms.input' , [
		'name' => 'currency_slug',
		'value' => $model->slug ,
		'class' => 'form-required ltr' ,
		'hint' => trans('currencies.slug_hint'),
	])

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