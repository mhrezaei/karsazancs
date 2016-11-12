@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/products/save/'),
	'modal_title' => $model->id? trans('products.edit')  : trans('products.new'),
	'no_validation' => 1 ,
])
<div class='modal-body'>

	@if(!$savable)
		@include('forms.note' , [
			'text' => trans('products.form.not_editable') ,
			'shape' => 'warning' ,
		])
	@endif

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])

	@include('forms.input' , [
		'name' => 'title',
		'value' => $model ,
		'class' => 'form-required form-default' ,
	])

	@include('forms.select' , [
		'name' => 'currency' ,
		'class' => 'form-required',
		'options' => $model->currenciesCombo()->get() ,
		'caption_field' => 'full_name' ,
		'value_field' => 'slug' ,
		'value' => $model ,
		'search' => true ,
		''
	])


	@include('forms.textarea' , [
		'name' => 'description',
		'value' => $model ,
		'class' => 'form-required' ,
	])

	@include('manage.frame.widgets.input-photo' , [
		'name' => 'image' ,
		'value' => $model->image ,
		'class' => 'form-required' ,
	])

	@include('forms.sep')

	@include('forms.input' , [
		'name' => 'card_price',
		'value' => $model ,
		'class' => 'form-required' ,
		'hint' => trans('products.form.card_price_hint') ,
	])
	@include('forms.input' , [
		'name' => 'max_purchasable',
		'value' => $model ,
		'hint' => trans('products.form.max_purchasable_hint') ,
	])

	@include('forms.input' , [
		'name' => 'expiry',
		'value' => $model ,
		'hint' => trans('products.form.expiry_hint') ,
	])


	@include('forms.check-form' , [
		'label' => trans('products.form.extensible') ,
		'self_label' => trans('products.form.extensible_hint'),
		'name' => 'is_extensible' ,
		'value' => $model ,
	])

	@include('forms.sep' , [
		'label' => trans('products.form.charge_management')  //=========================================
	])

	@include('forms.input' , [
		'name' => 'initial_charge',
		'value' => $model ,
		'hint' => trans('products.form.charge_hint') ,
	])

	@include('forms.input' , [
		'name' => 'min_charge',
		'value' => $model ,
		'hint' => trans('products.form.zero_for_no_limitation') ,
	])
	@include('forms.input' , [
		'name' => 'max_charge',
		'value' => $model ,
		'hint' => trans('products.form.zero_for_no_limitation') ,
	])

	@include('forms.check-form' , [
		'label' => trans('products.form.rechargeable') ,
		'self_label' => trans('products.form.rechargeable_hint'),
		'name' => 'is_rechargeable' ,
		'value' => $model ,
	])


	@include('forms.sep' , [
		'label' => trans('products.form.inventory_management')  //=========================================
	])

	@include('forms.input' , [
		'name' => 'inventory',
		'value' => $model ,
		'class' => 'form-required' ,
	])
	@include('forms.input' , [
		'name' => 'inventory_low_alarm',
		'value' => $model ,
		'hint' => trans('products.form.inventory_alarm_hint') ,
	])
	@include('forms.input' , [
		'name' => 'inventory_low_action',
		'value' => $model ,
		'hint' => trans('products.form.inventory_action_hint') ,
	])



	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('forms.button.save'),
			'shape' => 'success',
			'type' => 'submit' ,
			'extra' => $savable ? '' : 'disabled' ,
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