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
		'text' => $model->title,
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
		'link' => "urlN:manage/payments/browse/order-id-",
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => $model->amount_paid>0? trans('orders.status.partly_paid') : trans('orders.status.unpaid'),
		'color' => "danger",
		'icon' => "exclamation-triangle",
		'condition' => $model->amount_invoiced != $model->amount_paid,
		'link' => $model->amount_paid>0? "urlN:manage/payments/browse/order-id-" : null,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('validation.attributes.amount_paid').': '.number_format($model->amount_paid).' '.trans('currencies.IRR'),
		'color' => "success",
		'icon' => "check",
		'condition' => $model->amount_paid>0 and $model->amount_invoiced != $model->amount_paid ,
		'link' => "urlN:manage/payments/browse/order-id-",
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
		'link' => Auth::user()->can('payments.browse')? "modal:manage/orders/-id-/process" : '',
		'icon' => $model->status_icon ,
		'color' => $model->trashed()? 'grey' : $model->status_color ,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'icon' => "times",
		'text' => trans('posts.manage.deleted_by' , ['name' => $model->deleter()->full_name,]),
		'color' => "danger",
		'condition' => $model->trashed(),
	])
	@include('manage.frame.widgets.grid-date' , [
		'date' => $model->deleted_at,
		'condition' => $model->trashed(),
		'color' => "danger",
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
			['plus-square' , trans('payments.new') , "modal:manage/payments/create/-id-" , "payments.create" , $model->amount_payable > 0],
//			['money' , trans('currencies.update_price') , 'modal:manage/currencies/-id-/update' , 'currencies.process'],
//			['eye' , trans('currencies.query') , 'modal:manage/currencies/-id-/query' ],
			['history' , trans('orders.payments') , "urlN:manage/payments/browse/order-id-" , 'payments.browse'],

			['ban' , trans('forms.button.soft_delete') , 'modal:manage/orders/-id-/soft_delete' , 'orders.delete' , !$model->trashed()] ,
			['undo' , trans('forms.button.undelete') , 'modal:manage/orders/-id-/undelete' , 'orders.bin' , $model->trashed()] ,
			['times' , trans('forms.button.hard_delete') , 'modal:manage/orders/-id-/hard_delete' , 'orders.bin' , $model->trashed()] ,
]])