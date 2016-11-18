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
		'link' => "modal:manage/payments/-id-/edit",
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
			['pencil' , trans('manage.permits.edit') , "modal:manage/orders/-id-/edit" , "currencies.edit"],
//			['money' , trans('currencies.update_price') , 'modal:manage/currencies/-id-/update' , 'currencies.process'],
//			['eye' , trans('currencies.query') , 'modal:manage/currencies/-id-/query' ],
//			['history' , trans('currencies.price_history') , "urlN:manage/currencies/-id-/history" , 'currencies.process'],

			['ban' , trans('forms.button.soft_delete') , 'modal:manage/orders/-id-/soft_delete' , 'currencies.delete' , !$model->trashed()] ,
			['undo' , trans('forms.button.undelete') , 'modal:manage/orders/-id-/undelete' , 'currencies.bin' , $model->trashed()] ,
			['times' , trans('forms.button.hard_delete') , 'modal:manage/orders/-id-/hard_delete' , 'currencies.bin' , $model->trashed()] ,
]])