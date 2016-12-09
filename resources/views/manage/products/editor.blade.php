@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => $model->canSave() ? url('manage/products/save/') : '' ,
	'modal_title' => $model->admin_editor_title,
	'no_validation' => 1 ,
])

<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])

	@include('forms.input' , [
		'name' => 'title',
		'value' => $model ,
		'class' => 'form-required form-default' ,
		'disabled' => !$model->canSave()? true : false,
	])

	@include('forms.select' , [
		'name' => 'currency' ,
		'class' => 'form-required',
		'options' => $model->currenciesCombo()->get() ,
		'caption_field' => 'full_name' ,
		'value_field' => 'slug' ,
		'value' => $model ,
		'search' => true ,
		'disabled' => !$model->canSave()? true : false,
	])


	@include('forms.textarea' , [
		'name' => 'description',
		'value' => $model ,
		'class' => 'form-required' ,
		'disabled' => !$model->canSave()? true : false,
	])

	@include('manage.frame.widgets.input-photo' , [
		'name' => 'image' ,
		'value' => $model->image ,
		'required' => "true",
		'disabled' => !$model->canSave()? true : false,
	])

	@include('forms.select' , [
		'name' => 'color_code' ,
		'class' => 'form-required',
		'options' => $model->colorsCombo(),
//		'caption_field' => 'full_name' ,
//		'value_field' => 'slug' ,
		'value' => $model ,
		'disabled' => !$model->canSave()? true : false,
	])

	@include('forms.sep')

	@include('forms.input' , [
		'name' => 'card_price',
		'value' => $model ,
		'class' => 'form-required form-numberFormat' ,
		'hint' => trans('products.form.card_price_hint') ,
		'disabled' => !$model->canSave()? true : false,
	])
	@include('forms.input' , [
		'name' => 'max_purchasable',
		'value' => $model ,
		'hint' => trans('products.form.max_purchasable_hint') ,
		'disabled' => !$model->canSave()? true : false,
	])

	@include('forms.input' , [
		'name' => 'expiry',
		'value' => $model ,
		'hint' => trans('products.form.expiry_hint') ,
		'disabled' => !$model->canSave()? true : false,
	])


	@include('forms.check-form' , [
		'label' => trans('products.form.extensible') ,
		'self_label' => trans('products.form.extensible_hint'),
		'name' => 'is_extensible' ,
		'value' => $model ,
		'disabled' => !$model->canSave()? true : false,
	])

	@include('forms.sep' , [
		'label' => trans('products.form.charge_management')  //=========================================
	])

	@include('forms.input' , [
		'name' => 'initial_charge',
		'value' => $model ,
		'hint' => trans('products.form.charge_hint') ,
		'disabled' => !$model->canSave()? true : false,
		'class' => "form-numberFormat",
	])

	@include('forms.input' , [
		'name' => 'min_charge',
		'value' => $model ,
		'hint' => trans('products.form.zero_for_no_limitation') ,
		'disabled' => !$model->canSave()? true : false,
		'class' => "form-numberFormat",
	])
	@include('forms.input' , [
		'name' => 'max_charge',
		'value' => $model ,
		'hint' => trans('products.form.zero_for_no_limitation') ,
		'disabled' => !$model->canSave()? true : false,
		'class' => "form-numberFormat",
	])

	@include('forms.check-form' , [
		'label' => trans('products.form.rechargeable') ,
		'self_label' => trans('products.form.rechargeable_hint'),
		'name' => 'is_rechargeable' ,
		'value' => $model ,
		'disabled' => !$model->canSave()? true : false,
	])


	@include('forms.sep' , [
		'label' => trans('products.form.inventory_management')  //=========================================
	])

	@include('forms.input' , [
		'name' => 'inventory',
		'value' => $model ,
		'class' => 'form-required form-numberFormat' ,
		'disabled' => !$model->canSave()? true : false,
	])
	@include('forms.input' , [
		'name' => 'inventory_low_alarm',
		'value' => $model ,
		'hint' => trans('products.form.inventory_alarm_hint') ,
		'disabled' => !$model->canSave()? true : false,
		'class' => "form-numberFormat",
	])
	@include('forms.input' , [
		'name' => 'inventory_low_action',
		'value' => $model ,
		'hint' => trans('products.form.inventory_action_hint') ,
		'disabled' => !$model->canSave()? true : false,
		'class' => "form-numberFormat",
	])

	@include('forms.group-start')

	@if($model->canSave())
		@include('forms.button' , [
				'label' => $model->admin_editor_title,
				'shape' => 'success',
				'type' => 'submit' ,
				'value' => 'save' ,
		])
	@endif

	@include('forms.button' , [
		'label' =>  $model->canSave() ? trans('forms.button.cancel') : trans('forms.button.ok') ,
		'shape' => $model->canSave() ? 'link' : 'primary',
		'link' => '$(".modal").modal("hide")',
	])

	@include('forms.group-end')

	@if($model->canSave())
		@include('forms.feed')
	@endif

</div>
@include('templates.modal.end')