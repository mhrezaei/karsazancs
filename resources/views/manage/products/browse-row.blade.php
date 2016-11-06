@include('manage.frame.widgets.grid-rowHeader' , [
	'refresh_url' => "manage/products/update/$model->id"
])
<td>
	<a href="javascript:void(0)" onclick="masterModal('{{ url("manage/products/$model->id/edit") }}')">
		{{ $model->title }}
	</a>
	<div class="text-grey f8 mv5">
		{{ trans('products.created_by' , [
			'name' => $model->creator->full_name ,
			'date' => $model->created_at_formatted ,
		])}}
	</div>
	<div class="text-danger f8 mv5 {{ $model->trashed()? '' : 'noDisplay' }}">
		{{ trans('products.deleted_by' , [
			'name' => $model->deleter->full_name ,
			'date' => $model->deleted_at_formatted ,
		])}}
	</div>
</td>

<td>
	@pd( number_format($model->card_price) )&nbsp;{{ trans('currencies.IRR') }}
</td>

<td>
	@if($model->charge > 0)
		@pd(number_format($model->charge))&nbsp;{{ $model->currency_title }}
	@else
		{{ trans('products.custom_charge') }}
	@endif

	@if($model->min_charge > 0)
		<div class='text-grey f8 mv5'>
			{{ trans('forms.general.min_value' , ['value' => $model->min_charge_persian.' '.$model->currency_title]) }}
		</div>
	@endif
	@if($model->max_charge > 0)
		<div class='text-grey f8 mv5'>
			{{ trans('forms.general.max_value' , ['value' => $model->max_charge_persian.' '.$model->currency_title]) }}
		</div>
	@endif

</td>

<td>
	@if($model->inventory == 0)
		{{ trans('products.unlimited') }}
	@else
		{{ trans('products.inventory' , ['count' => $model->inventory_persian]) }}
		@if($model->inventory_low_action > 0)
			<div class='text-grey f8 mv5'>
				{{ trans('products.min_inventory')}}: @pd(number_format($model->inventory_low_action))
			</div>
		@endif
		@if($model->inventory_low_alarm > 0)
			<div class='text-grey f8 mv5'>
				{{ trans('products.alarm_setting')}}: @pd(number_format($model->inventory_low_alarm))
			</div>
		@endif
	@endif

</td>

<td>
	<div class="text-{{$model->status_color}}">
		<i class="fa fa-{{$model->status_icon}}"></i>
		{{ trans("products.status.".$model->status) }}
	</div>
</td>

@include('manage.frame.widgets.grid-actionCol' , [ 'actions' => [
			['pencil' , trans('manage.permits.edit') , "modal:manage/products/-id-/edit" , "products.edit"],
			['shopping-basket' , trans('manage.modules.orders') , 'urlN:manage/currencies/-id-/update' , 'orders'],

			['ban' , trans('forms.button.soft_delete') , 'modal:manage/products/-id-/soft_delete' , 'products.delete' , !$model->trashed()] ,
			['undo' , trans('forms.button.undelete') , 'modal:manage/products/-id-/undelete' , 'products.bin' , $model->trashed()] ,
			['times' , trans('forms.button.hard_delete') , 'modal:manage/products/-id-/hard_delete' , 'products.bin' , $model->trashed()] ,
]])