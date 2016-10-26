@include('manage.frame.widgets.grid-rowHeader' , [
	'refresh_url' => "manage/currencies/update/$model->id"
])
<td>
	<a href="javascript:void(0)" onclick="masterModal('{{ url("manage/currencies/$model->id/edit") }}')">
		{{ $model->full_name }}
	</a>
</td>

<td>@pd( number_format($model->price_to_buy) )</td>
<td>@pd( number_format($model->price_to_sell) )</td>

<td>
	<a href="javascript:void(0)" onclick="masterModal('{{ url("manage/currencies/$model->id/update") }}')">
		@if($model->latest_update == '-')
			<span class="null-content">
				{{ trans('forms.general.never') }}
			</span>
		@else
			@pd(jDate::forge($model->latest_update)->ago())
		@endif
</a>
</td>

@include('manage.frame.widgets.grid-actionCol' , [ 'actions' => [
			['pencil' , trans('manage.permits.edit') , "modal:manage/currencies/-id-/edit" , "currencies.edit"],
			['money' , trans('currencies.update_price') , 'modal:manage/currencies/-id-/update' , 'currencies.process'],
			['eye' , trans('currencies.query') , 'modal:manage/currencies/-id-/query' ],
			['history' , trans('currencies.price_history') , "urlN:manage/currencies/-id-/history" , 'currencies.process'],

			['ban' , trans('forms.button.soft_delete') , 'modal:manage/currencies/-id-/soft_delete' , 'currencies.delete' , !$model->trashed()] ,
			['undo' , trans('forms.button.undelete') , 'modal:manage/currencies/-id-/undelete' , 'currencies.bin' , $model->trashed()] ,
			['times' , trans('forms.button.hard_delete') , 'modal:manage/currencies/-id-/hard_delete' , 'currencies.bin' , $model->trashed()] ,
]])