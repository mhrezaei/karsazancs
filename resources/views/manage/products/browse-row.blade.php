@include('manage.frame.widgets.grid-rowHeader' , [
	'refresh_url' => "manage/products/update/$model->id",
	'fake' => $model->spreadMeta(),
])


{{--
|--------------------------------------------------------------------------
| Product Title
|--------------------------------------------------------------------------
|
--}}
<td>
	@include("manage.frame.widgets.grid-text" , [
		'text' => $model->title,
		'link' => "modal:manage/products/-id-/edit",
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('products.created_by' , ['name' => $model->creator->full_name,]),
		'icon' => "universal-access",
	])
	@include('manage.frame.widgets.grid-date' , [
		'date' => $model->created_at,
	])
</td>

{{--
|--------------------------------------------------------------------------
| Price
|--------------------------------------------------------------------------
|
--}}

<td>
	@include("manage.frame.widgets.grid-text" , [
		'text' => trans('currencies.rials' , ['amount' => number_format($model->card_price),]),
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('products.expiry' , ['months' => $model->expiry,]),
		'icon' => "hourglass-end",
		'condition' => $model->expiry>0,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('products.lifetime' ),
		'icon' => "hourglass-o",
		'condition' => $model->expiry==0,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('products.extensible' ),
		'icon' => "chain-broken",
		'condition' => $model->is_extensible,
	])
</td>

{{--
|--------------------------------------------------------------------------
| Charge
|--------------------------------------------------------------------------
|
--}}
<td>
	@include("manage.frame.widgets.grid-text" , [
		'text' => $model->initial_charge > 0 ? number_format($model->initial_charge).' '.$model->currency_title : trans('products.custom_charge' , ['currency' => "$model->currency_title",]),
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('forms.general.min_value' , ['value' => number_format($model->min_charge),]),
		'condition' => $model->min_charge > 0,
		'icon' => "level-down",
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('forms.general.max_value' , ['value' => number_format($model->max_charge),]),
		'condition' => $model->max_charge > 0,
		'icon' => "level-up",
	])
</td>


{{--
|--------------------------------------------------------------------------
| Inventory
|--------------------------------------------------------------------------
|
--}}
<td>
	@include("manage.frame.widgets.grid-text" , [
		'text' => trans('products.unlimited'),
		'condition' => $model->inventory == 0,
	])
	@include("manage.frame.widgets.grid-text" , [
		'text' => trans('products.inventory' , ['count' => number_format($model->inventory)]),
		'condition' => $model->inventory > 0,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('products.min_inventory').': '.number_format($model->inventory_low_action),
		'icon' => "level-down",
		'condition' => $model->inventory>0 and $model->inventory_low_action,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('products.min_inventory').': '.number_format($model->inventory_low_alarm),
		'icon' => "bell-o",
		'condition' => $model->inventory>0 and $model->inventory_low_alarm,
	])
</td>

{{--
|--------------------------------------------------------------------------
| Status
|--------------------------------------------------------------------------
|
--}}

<td>
	@include("manage.frame.widgets.grid-text" , [
		'icon' => $model->status_icon,
		'text' => trans("products.status.$model->status"),
		'color' => $model->status_color,
	])
</td>

@include('manage.frame.widgets.grid-actionCol' , [ 'actions' => [
			['pencil' , trans('manage.permits.edit') , "modal:manage/products/-id-/edit" , "products.edit"],
			['cart-plus' , trans('orders.new') , 'modal:manage/orders/create/-id-' , 'orders.create'],
			['shopping-basket' , trans('manage.modules.orders') , 'urlN:manage/orders/browse/product-id-' , 'orders.browse'],

			['ban' , trans('forms.button.soft_delete') , 'modal:manage/products/-id-/soft_delete' , 'products.delete' , !$model->trashed()] ,
			['undo' , trans('forms.button.undelete') , 'modal:manage/products/-id-/undelete' , 'products.bin' , $model->trashed()] ,
			['times' , trans('forms.button.hard_delete') , 'modal:manage/products/-id-/hard_delete' , 'products.bin' , $model->trashed()] ,
]])