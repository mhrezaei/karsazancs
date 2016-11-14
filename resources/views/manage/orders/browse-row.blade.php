@include('manage.frame.widgets.grid-rowHeader' , [
	'refresh_url' => "manage/orders/update/$model->id"
])

{{--
|--------------------------------------------------------------------------
| Order Name
|--------------------------------------------------------------------------
|
--}}

<td>
	@include('manage.frame.widgets.grid-text' , [
		'text' => $model->slug.' ('.trans("orders.type.".$model->type).')',
		'link' => "modal:manage/orders/-id-/edit",
	])
	@include('manage.frame.widgets.grid-tiny' , [
		'icon' => 'user',
		'text' => $model->user->full_name,
		'link' => "modal:manage/customers/$model->user_id/view",
		'color' => "violet",
		'size' => "10",
	])
	@include('manage.frame.widgets.grid-tiny' , [
		'icon' => 'credit-card',
		'text' => $model->product->title.': '.number_format($model->product->initial_charge).' '.$model->product->currency_title,
		'link' => "modal:manage/products/$model->product_id/edit/1",
		'color' => "violet",
		'size' => "9",
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
		'text' => trans('currencies.rials' , ['amount' => number_format($model->amount_invoiced),]),
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('orders.status.paid'),
		'color' => "success",
		'icon' => "check",
		'condition' => $model->amount_invoiced == $model->amount_paid,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => $model->amount_paid>0? trans('orders.status.partly_paid') : trans('orders.status.unpaid'),
		'color' => "danger",
		'icon' => "exclamation-triangle",
		'condition' => $model->amount_invoiced != $model->amount_paid,
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
		'text' => trans("orders.status.$model->status_code") ,
		'link' => "modal:manage/orders/$model->product_id/process",
		'icon' => $model->status_icon ,
		'color' => $model->status_color ,
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