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
	
	@include("forms.input" , [
		'name' => "order_id",
		'value' => $model->title ,
		'disabled' => true,
		'condition' => $model->id,
	])

	@include('forms.input' , [
		'name' => 'customer_id',
		'value' => $model->user->full_name ,
		'extra' => 'disabled' ,
	])

	@include("forms.note" , [
		'condition' => $total_owned = $model->checkPurchaseLimit(),
		'shape' => "danger",
		'text' => trans('orders.form.purchase_limit_alarm' , [
			'total' => $total_owned,
			'limit' => $model->product->max_purchasable,
		]),
	])

	@include('forms.input' , [
		'name' => 'product_id',
		'value' => $model->product->title ,
		'extra' => 'disabled' ,
		'hint' => $model->canEdit()? $model->inventory_admin_hint : '',
		'hint_style' => "color:black;font-weight:200",
	])

	@include("forms.note" , [
		'condition' => $model->canEdit() and $model->product->inventory < $model->product->inventory_low_action,
		'shape' => "danger",
		'text' => trans('orders.form.inventory_alarm'),
	])

	@include("forms.input" , [
		'name' => "card_price",
		'value' => trans('currencies.rials' , ['amount' => number_format($model->product->card_price),]),
		'class' => 'form-numberFormat',
		'extra' => "disabled",
	])

	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep')

	{{--@include('forms.select' , [--}}
		{{--'name' => 'status' ,--}}
		{{--'class' => 'form-required',--}}
		{{--'options' => [--}}
			{{--['3' , trans('orders.status.under_payment')],--}}
			{{--['1' , trans('orders.status.unprocessed')],--}}
			{{--['2' , trans('orders.status.processing')],--}}
		{{--] ,--}}
		{{--'caption_field' => '1' ,--}}
		{{--'value_field' => "0",--}}
		{{--'value' => $model,--}}
		{{--'condition' => $model->canProcess(),--}}
		{{--'disabled' => !$model->canSave()? true : false,--}}
	{{--])--}}

	@include("forms.input" , [
		'name' => "initial_charge",
		'value' => $model,
		'hint' => $model->canEdit()? $model->charge_admin_hint : '',
		'class' => 'form-numberFormat form-required form-default' ,
		'on_change' => "orderEditor()",
		'on_focus' => $model->id? '' : "orderEditor()",
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

	@include('forms.button' , [
		'condition' => $model->canSave(),
		'label' => $model->admin_editor_title,
		'shape' => 'success',
		'type' => 'submit' ,
		'value' => 'save' ,
	])

	@include('forms.button' , [
		'label' =>  $model->canSave() ? trans('forms.button.cancel') : trans('forms.button.ok') ,
		'shape' => $model->canSave() ? 'link' : 'primary',
		'link' => '$(".modal").modal("hide")',
	])

	@include('forms.group-end')

	@include('forms.feed' , [
		'condition' => $model->canSave(),
	])

</div>
@include('templates.modal.end')