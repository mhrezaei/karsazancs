@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/currencies/save/update'),
	'modal_title' => trans('currencies.update_price'),
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

	@include('forms.sep' , [
		'class' => '-custom_time'  ,
		'label' => trans('currencies.price_effective_date')
	])

	@include('forms.select' , [
		'id' => 'cmbEffectiveDate' ,
		'name' => 'effective_date' ,
		'options' => [
			['now' , trans('forms.general.now')],
			['custom' , trans('forms.general.custom_time')]
		] ,
		'caption_field' => '1' ,
		'value_field' => '0' ,
		'value' => 'now' ,
		'class' => 'form-required' ,
		'on_change' => 'currencyRateUpdateEditor()'
	])

	@include('forms.datepicker' , [
		'name' => 'date' ,
		'value' => time() ,
		'class' => '-custom_time form-required'
	])
	@include('forms.input' , [
		'name' => 'time' ,
		'value' => \Carbon\Carbon::now()->format('H:i'),
		'class' => '-custom_time form-required ltr' ,
		'hint' => trans('validation.attributes_placeholder.time') ,
	])

	@include('forms.sep' , [
		'class' => '-custom_time' ,
		'label' => trans('currencies.price_details')
	])

	@include('forms.input' , [
		'name' => 'price_to_buy',
		'value' => $model ,
		'class' => 'form-required ltr form-default' ,
	])
	@include('forms.input' , [
		'name' => 'price_to_sell',
		'value' => $model ,
		'class' => 'form-required ltr' ,
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