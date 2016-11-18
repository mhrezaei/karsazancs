@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => $model->canSave() ? url('manage/payments/save/') : '' ,
	'modal_title' => $model->admin_editor_title,
	'no_validation' => 1 ,
])

<div class='modal-body'>
	@include("forms.hiddens" , [ 'fields' => [
		['id' , $model->id] ,
		['order_id' , encrypt($model->order_id)],
		['user_id' , encrypt($model->user_id)],
		['amount_payable' , encrypt($model->order->amount_payable)],
		['direction' , encrypt($model->order->direction),],
		['site_credit' , encrypt($model->user->site_credit)]
	]])
	
	@include("forms.input" , [
		'label' => trans('validation.attributes.order_id'),
		'value' => $model->order->title ,
		'disabled' => true,
	])

	@include('forms.input' , [
		'name' => 'customer_id',
		'value' => $model->user->full_name_with_credit ,
		'disabled' => true,
	])

	@include("forms.input" , [
		'name' => "amount_payable",
		'condition' => $model->order_id,
		'value' => $model->order_id? $model->order->amount_payable : '',
		'disabled' => true,
		'class' => "form-numberFormat",
	])

	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep')
	
	@include("forms.select" , [
		'id' => "cmbMethodSelector",
		'name' => "payment_method",
		'class' => "form-required",
		'options' => $model->methodCombo(),
		'caption_field' => "1",
		'value_field' => "0",
		'value' => $model->method ,
		'disabled' => $model->id or !$model->canSave()? true : false,
		'search' => 1,
		'size' => "10",
		'on_change' => "paymentEditor()",
	])

	@include("forms.select" , [
		'name' => "status",
		'class' => "form-required",
		'options' => [
			['confirmed' , trans('payments.status.confirmed')],
			['pending' , trans('payments.status.pending')],
		],
		'caption_field' => "1",
		'value_field' => "0",
		'value' => 'confirmed' ,
		'condition' => !$model->id and Auth::user()->can('payments.process'),
	])

	@include("forms.input" , [
		'name' => "amount_declared",
		'value' => $model,
		'class' => 'form-numberFormat form-required form-default' ,
		'disabled' => $model->id ? true : false,
	])

	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep')

	@include("forms.datepicker" , [
		'name' => "payment_date",
		'value' => $model,
		'class' => "form-required -detail -cash -shetab -transfer -deposit -pos",
	])
	
	@include("forms.input" , [
		'name' => "payment_time",
		'value' => $model,
		'class' => "form-required form-timeFormat -detail -cash -shetab -transfer -deposit -pos",
	])

	@include("forms.input" , [
		'name' => "account_no",
		'value' => $model,
		'class' => "ltr form-required -detail -transfer -cheque",
		'condition' => $model->order->direction == 'income',
	])

	@include("forms.input" , [
		'name' => "bank_name",
		'value' => $model,
		'class' => "ltr form-required -detail -transfer -cheque -deposit",
		'condition' => $model->order->direction == 'income',
	])

	@include("forms.input" , [
		'name' => "card_no",
		'value' => $model,
		'class' => "ltr form-required form-cardFormat -detail -shetab",
	])

	@include("forms.select" , [
		'name' => "own_account_id",
		'value' => $model,
		'class' => "form-required -detail -shetab -transfer -deposit -cheque -pos",
		'options' => $model->accountsCombo(),
		'search' => true,
		'blank_value' => "",
	])

	@include("forms.select" , [
		'name' => "customer_account_id",
		'value' => $model,
		'class' => "form-required -detail -shetab -transfer -deposit -cheque",
		'options' => $model->accountsCombo($model->user_id),
		'search' => true,
		'blank_value' => "",
		'condition' => $model->order->direction == 'outcome',
	])


	@include("forms.input" , [
		'name' => "depositor",
		'value' => $model,
		'class' => "form-required -detail -deposit",
	])

	@include("forms.input" , [
		'name' => "receiver",
		'value' => $model,
		'class' => "form-required -detail -cash",
	])
	@include("forms.input" , [
		'name' => "sender",
		'value' => $model,
		'class' => "form-required -detail -cash",
	])

	@include("forms.input" , [
		'name' => "tracking_no",
		'value' => $model,
		'class' => "form-required -detail -shetab -transfer -deposit -pos",
	])

	@include("forms.datepicker" , [
		'name' => "cheque_date",
		'value' => $model,
		'class' => "form-required -detail -cheque",
	])

	@include("forms.input" , [
		'name' => "cheque_no",
		'value' => $model,
		'class' => "form-required -detail -cheque",
	])


	@include("forms.textarea" , [
		'name' => "description",
		'rows' => "3",
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