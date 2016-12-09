@include('manage.frame.widgets.grid-rowHeader' , [
	'refresh_url' => "manage/payments/update/$model->id"
])

{{--
|--------------------------------------------------------------------------
| Order Name
|--------------------------------------------------------------------------
|
--}}

<td>
	@include('manage.frame.widgets.grid-text' , [
		'text' => $model->order->title,
		'link' => "modal:manage/orders/$model->order_id/view",
	])
	@include('manage.frame.widgets.grid-tiny' , [
		'icon' => 'user',
		'text' => $model->user->full_name,
		'link' => "modal:manage/customers/$model->user_id/view",
		'color' => "black",
		'size' => "10",
	])
	@include('manage.frame.widgets.grid-tiny' , [
		'icon' => 'credit-card',
		'text' => $model->order->product->title.': '.number_format($model->order->product->initial_charge).' '.$model->order->product->currency_title,
		'link' => "modal:manage/products/".$model->order->product_id."/edit/1",
		'color' => "black",
		'size' => "10",
	])
	@include('manage.frame.widgets.grid-date' , [
		'date' => $model->created_at,
	])
</td>


{{--
|--------------------------------------------------------------------------
| Invoice
|--------------------------------------------------------------------------
|
--}}

<td>
	@include("manage.frame.widgets.grid-text" , [
		'text' => trans('currencies.rials' , ['amount' => number_format($model->amount_declared),]),
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('payments.status.confirmed').': '.trans('currencies.rials' , ['amount' => number_format($model->amount_confirmed),]),
		'color' => $model->status_color,
		'condition' => !in_array($model->status , ['confirmed','pending']),
		'size' => "10",
		'icon' => $model->status_icon,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('payments.status.confirmed'),
		'color' => "success",
		'condition' => $model->status == 'confirmed',
		'icon' => $model->status_icon,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans("payments.methods.$model->payment_method"),
	])
</td>

{{--
|--------------------------------------------------------------------------
| Status
|--------------------------------------------------------------------------
|
--}}

<td>
	@include('manage.frame.widgets.grid-text' , [
		'text' => trans("payments.status.$model->status") ,
		'link' => "modal:manage/payments/$model->id/process",
		'icon' => $model->status_icon ,
		'color' => $model->status_color ,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('validation.attributes.checked_by').": ".$model->checker()->full_name,
		'condition' => $model->checked_by,
	])
	@include("manage.frame.widgets.grid-date" , [
		'date' => $model->checked_at,
		'condition' => $model->checked_by,
	])
</td>

{{--
|--------------------------------------------------------------------------
| Action
|--------------------------------------------------------------------------
|
--}}

@include('manage.frame.widgets.grid-actionCol' , [ 'actions' => [
			['pencil' , trans('manage.permits.edit') , "modal:manage/payments/-id-/edit" , "payments.edit"],
			['diamond' , trans('payments.process') , "modal:manage/payments/-id-/process" , "payments.process"],

//			['ban' , trans('forms.button.soft_delete') , 'modal:manage/payments/-id-/soft_delete' , 'payments.delete' , !$model->trashed()] ,
//			['undo' , trans('forms.button.undelete') , 'modal:manage/payments/-id-/undelete' , 'payments.bin' , $model->trashed()] ,
//			['times' , trans('forms.button.hard_delete') , 'modal:manage/payments/-id-/hard_delete' , 'payments.bin' , $model->trashed()] ,
]])