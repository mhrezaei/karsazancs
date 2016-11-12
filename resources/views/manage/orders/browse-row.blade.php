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
		'text' => trans("orders.type.".$model->type).' ('.$model->product->title.')',
		'link' => "modal:manage/orders/-id-/edit",
	])
	@include('manage.frame.widgets.grid-tiny' , [
		'icon' => 'credit-card',
		'text' => $model->product->title.': '.number_format($model->product->initial_charge).' '.$model->product->currency_title,
		'link' => "modal:manage/products/$model->product_id/edit/0",
	])
	@include('manage.frame.widgets.grid-tiny' , [
		'icon' => 'user',
		'text' => $model->user->full_name,
		'link' => "modal:manage/customers/$model->user_id/view",
	])
	@include('manage.frame.widgets.grid-date' , [
		'date' => $model->created_at,
	])
</td>

{{--
|--------------------------------------------------------------------------
| Product Name
|--------------------------------------------------------------------------
|
--}}
@if(0)
<td>
	@include('manage.frame.widgets.grid-text' , [
		'text' => $model->product->title ,
		'link' => "modal:manage/products/$model->product_id/edit/0",
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('validation.attributes.card_price').': '.number_format($model->product->card_price).' '.trans('currencies.IRR'),
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('validation.attributes.charge').': '.number_format($model->charge).' '.$model->product->currency_title.' = '.number_format($model->irr()).' '.trans('currencies.IRR'),
	])
</td>
@endif

{{--
|--------------------------------------------------------------------------
| Invoice
|--------------------------------------------------------------------------
|
--}}

<td>
	...
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
			['pencil' , trans('manage.permits.edit') , "modal:manage/currencies/-id-/edit" , "currencies.edit"],
//			['money' , trans('currencies.update_price') , 'modal:manage/currencies/-id-/update' , 'currencies.process'],
//			['eye' , trans('currencies.query') , 'modal:manage/currencies/-id-/query' ],
//			['history' , trans('currencies.price_history') , "urlN:manage/currencies/-id-/history" , 'currencies.process'],

			['ban' , trans('forms.button.soft_delete') , 'modal:manage/currencies/-id-/soft_delete' , 'currencies.delete' , !$model->trashed()] ,
			['undo' , trans('forms.button.undelete') , 'modal:manage/currencies/-id-/undelete' , 'currencies.bin' , $model->trashed()] ,
			['times' , trans('forms.button.hard_delete') , 'modal:manage/currencies/-id-/hard_delete' , 'currencies.bin' , $model->trashed()] ,
]])