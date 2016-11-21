@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/orders/save/process') ,
	'modal_title' => trans('orders.process'),
	'no_validation' => 1 ,
])

<div class='modal-body'>
	@include("forms.hiddens" , [ 'fields' => [
		['id' , $model->id] ,
	]])
	
	@include("forms.input" , [
		'name' => "order_id",
		'value' => $model->title ,
		'disabled' => true,
	])

	@include("forms.note" , [
		'condition' => $total_owned = $model->checkPurchaseLimit(),
		'shape' => "danger",
		'text' => trans('orders.form.purchase_limit_alarm' , [
			'total' => $total_owned,
			'limit' => $model->product->max_purchasable,
		]),
	])

	@if($model->product_id > 0)
		@include('forms.input' , [
			'name' => 'product_id',
			'value' => $model->product->title ,
			'extra' => 'disabled' ,
			'hint' => $model->inventory_admin_hint ,
			'hint_style' => "color:black;font-weight:200",
		])

		@include("forms.note" , [
			'condition' => $model->type=='new' and $model->product->inventory < $model->product->inventory_low_action,
			'shape' => "danger",
			'text' => trans('orders.form.inventory_alarm'),
		])
	@endif

	@include('forms.input' , [
		'name' => 'current_status',
		'value' => $model->status_full_title ,
		'extra' => 'disabled' ,
	])


	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep' )


	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep')

	@include('forms.group-start')

	@include('forms.button' , [
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