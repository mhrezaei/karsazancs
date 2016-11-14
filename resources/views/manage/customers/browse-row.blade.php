@include('manage.frame.widgets.grid-rowHeader' , [
	'refresh_url' => "manage/customers/update/$model->id"
])

{{--
|--------------------------------------------------------------------------
| Name
|--------------------------------------------------------------------------
|
--}}

<td>
	@include("manage.frame.widgets.grid-text" , [
		'text' => $model->full_name,
		'link' => "modal:manage/customers/-id-/view",
	])
	@include('manage.frame.widgets.grid-date' , [
		'text' => trans('people.commands.register_date').': ',
		'date' => $model->created_at,
	])
	@include('manage.frame.widgets.grid-date' , [
		'text' => trans('people.commands.publish_date').': ',
		'date' => $model->published_at,
		'condition' => $model->published_at,
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
		'text' => $model->status_text,
		'color' => $model->status_color,
		'icon' => $model->status_icon,
	])
</td>

{{--
|--------------------------------------------------------------------------
| Activity
|--------------------------------------------------------------------------
|
--}}
<td>
	...
</td>

{{--
|--------------------------------------------------------------------------
| Actions
|--------------------------------------------------------------------------
|
--}}

@include('manage.frame.widgets.grid-actionCol' , [ 'actions' => [
			['pencil' , trans('manage.permits.edit') , "modal:manage/customers/-id-/edit" , "customers.edit"],
			['ticket' , trans('tickets.new_support_ticket') , "modal:manage/tickets/0/create/-id-"],
			['money' , trans('people.commands.bank_accounts') , 'urlN:manage/customers/-id-/accounts'],
			['history' , trans('people.commands.history') , "urlN:manage/customers/-id-/history"],
			['key' , trans('people.commands.change_password') , 'modal:manage/customers/-id-/change_password' , 'customers.edit' ,  !$model->trashed() ],

			['cart-plus' , trans('orders.new') , 'modal:manage/orders/create/0/-id-' , 'orders.create'],
			['shopping-basket' , trans('manage.modules.orders') , 'urlN:manage/orders/browse/customer-id-' , 'orders.browse'],

			['ban' , trans('people.commands.block') , 'modal:manage/customers/-id-/soft_delete' , 'customers.delete' , !$model->trashed()] ,
			['undo' , trans('people.commands.unblock') , 'modal:manage/customers/-id-/undelete' , 'customers.bin' , $model->trashed()] ,
			['times' , trans('people.commands.hard_delete') , 'modal:manage/customers/-id-/hard_delete' , 'customers.bin' , $model->trashed()] ,

			['user' , trans('people.commands.login_as') , 'modal:manage/customers/-id-/login_as' , 'developer' , !$model->trashed()] ,
]])