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
		'condition' => !$model->id,
		'value' => $model->order->amount_payable ,
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
		'value' => $model->payment_method ,
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
		'id' => "txtDeclared",
		'value' => $model,
		'class' => 'form-numberFormat form-required form-default' ,
		'disabled' => $model->id ? true : false,
	])

	<div class="payment_details" style="display: {{$displayDetails or 'block'}}">

		{{------------------------------------------------------------------------------------------}}
		@include('forms.sep')

		@include("forms.datepicker" , [
			'name' => "payment_date",
			'value' => $model,
			'class' => "form-required -detail -cash -shetab -transfer -deposit -pos",
			'disabled' => $model->canSave()? false : true,
		])

		@include("forms.input" , [
			'name' => "payment_time",
			'value' => $model,
			'class' => "form-required form-timeFormat -detail -cash -shetab -transfer -deposit -pos",
			'disabled' => $model->canSave()? false : true,
		])

		@include("forms.input" , [
			'name' => "account_no",
			'value' => $model,
			'class' => "ltr form-required -detail -transfer -cheque",
			'condition' => $model->order->direction == 'income',
			'disabled' => $model->canSave()? false : true,
		])

		@include("forms.input" , [
			'name' => "bank_name",
			'value' => $model,
			'class' => "form-required -detail -transfer -cheque -deposit",
			'condition' => $model->order->direction == 'income',
			'disabled' => $model->canSave()? false : true,
		])

		@include("forms.input" , [
			'name' => "card_no",
			'value' => $model,
			'class' => "ltr form-required form-cardFormat -detail -shetab",
			'disabled' => $model->canSave()? false : true,
		])

		@include("forms.select" , [
			'name' => "own_account_id",
			'value' => $model,
			'class' => "form-required -detail -shetab -transfer -deposit -cheque -pos",
			'options' => $model->accountsCombo(),
			'search' => true,
			'blank_value' => "",
			'disabled' => $model->canSave()? false : true,
		])

		@include("forms.select" , [
			'name' => "customer_account_id",
			'value' => $model,
			'class' => "form-required -detail -shetab -transfer -deposit -cheque",
			'options' => $model->accountsCombo($model->user_id),
			'search' => true,
			'blank_value' => "",
			'condition' => $model->order->direction == 'outcome',
			'disabled' => $model->canSave()? false : true,
		])


		@include("forms.input" , [
			'name' => "depositor",
			'value' => $model,
			'class' => "form-required -detail -deposit",
			'disabled' => $model->canSave()? false : true,
		])

		@include("forms.input" , [
			'name' => "receiver",
			'value' => $model,
			'class' => "form-required -detail -cash",
			'disabled' => $model->canSave()? false : true,
		])
		@include("forms.input" , [
			'name' => "sender",
			'value' => $model,
			'class' => "form-required -detail -cash",
			'disabled' => $model->canSave()? false : true,
		])

		@include("forms.input" , [
			'name' => "tracking_no",
			'value' => $model,
			'class' => "form-required -detail -shetab -transfer -deposit -pos",
			'disabled' => $model->canSave()? false : true,
		])

		@include("forms.datepicker" , [
			'name' => "cheque_date",
			'value' => $model,
			'class' => "form-required -detail -cheque",
			'disabled' => $model->canSave()? false : true,
		])

		@include("forms.input" , [
			'name' => "cheque_no",
			'value' => $model,
			'class' => "form-required -detail -cheque",
			'disabled' => $model->canSave()? false : true,
		])


		@include("forms.textarea" , [
			'name' => "description",
			'value' => $model,
			'rows' => "3",
			'disabled' => $model->canSave()? false : true,
		])
	</div>
