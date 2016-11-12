@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => $model->canSave() ? url('manage/orders/save/new') : '' ,
	'modal_title' => $model->admin_editor_title,
	'no_validation' => 1 ,
])
<div class='modal-body'>
	@include("forms.hiddens" , [ 'fields' => [
		['id' , $model->id] ,
		['user_id' , $model->user_id] ,
		['product_id' , $model->product_id],
		['rate' , $model->rate],
	]])

	@include('forms.input' , [
		'name' => 'customer_id',
		'value' => $model->user->full_name ,
		'extra' => 'disabled' ,
	])

	@include('forms.input' , [
		'name' => 'product_id',
		'value' => $model->product->title ,
		'extra' => 'disabled' ,
		'hint' => $model->canEdit()? $model->inventory_admin_hint : '',
		'hint_style' => "color:black;font-weight:200",
	])

	@if($model->canEdit() and $model->product->inventory < $model->product->inventory_low_action)
		@include("forms.note" , [
			'shape' => "danger",
			'text' => trans('orders.form.inventory_alarm'),
		])
	@endif

	@include("forms.input" , [
		'name' => "card_price",
		'value' => trans('currencies.rials' , ['amount' => number_format($model->product->card_price),]),
		'class' => 'form-numberFormat',
		'extra' => "disabled",
	])

	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep')

	@if($model->canProcess())
		@include('forms.select' , [
			'name' => 'status' ,
			'class' => 'form-required',
			'options' => [
				['1' , trans('orders.status.unprocessed')],
				['2' , trans('orders.status.processing')],
				['3' , trans('orders.status.under_payment')],
			] ,
			'caption_field' => '1' ,
			'value_field' => "0",
			'value' => $model,
		])
	@endif

	@include("forms.input" , [
		'name' => "initial_charge",
		'value' => $model,
		'hint' => $model->canEdit()? $model->charge_admin_hint : '',
		'class' => 'form-numberFormat form-required form-default' ,
		'on_change' => "orderEditor()",
		'on_focus' => "orderEditor()",
		'disabled' => !$model->canSave()? true : false,
	])

	@include("forms.input" , [
		'name' => "amount_invoiced",
		'value' => $model,
		'hint' => $model->canEdit()? trans('orders.form.invoice_hint' ) : '',
		'class' => 'form-numberFormat form-required' ,
		'disabled' => !$model->canSave()? true : false,
	])

	@include("forms.input" , [
		'name' => "original_invoice",
		'value' => $model->original_invoice,
		'hint' => $model->canEdit()?  trans('orders.form.original_invoice_hint' , ['rate' => number_format($model->rate),]) : '',
		'class' => 'form-numberFormat' ,
		'extra' => "disabled",
	])


	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep')

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