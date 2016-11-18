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
		['site_credit' , encrypt($model->user->site_credit)],
		['payment_method' , $model->payment_method],
	]])

	@include('manage.payments.editor-inputs')

	{{------------------------------------------------------------------------------------------}}
	@include('forms.sep')

	@include('forms.group-start')

	@include('forms.button' , [
		'condition' => $model->canSave(),
		'label' => trans('forms.button.save'),
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