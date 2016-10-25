<td>
	<input id="gridSelector-{{$model->id}}" data-value="{{$model->id}}" class="gridSelector" type="checkbox" onchange="gridSelector('selector','{{$model->id}}')">
</td>
<td>
	<a href="javascript:void(0)" onclick="masterModal('{{ url("manage/customers/$model->id/view") }}')">
		{{ $model->full_name }}
	</a>
</td>


<td>
	<span class="text-{{ $model->status_color }}">
		{{ $model->status_text }}
	</span>
</td>

<td>
	@if($model->published_at)
		<div class="f10">{{ trans('people.commands.publish_date') }}: {{$model->say('published_at')}}</div>
	@else
		<div class="f10">{{ trans('people.commands.register_date') }}: {{$model->say('created_at')}}</div>
	@endif
</td>

<td>
	@include('manage.frame.widgets.grid-action' , [
		'id' => $model->id ,
		'actions' => [
			['pencil' , trans('manage.permits.edit') , "modal:manage/customers/-id-/edit" , "customers.edit"],
			['money' , trans('people.commands.bank_accounts') , 'urlN:manage/customers/-id-/accounts'],
			['history' , trans('people.commands.history') , "urlN:manage/customers/-id-/history"],
			['key' , trans('people.commands.change_password') , 'modal:manage/customers/-id-/change_password' , 'customers.edit' ,  !$model->trashed() ],

			['ban' , trans('people.commands.block') , 'modal:manage/customers/-id-/soft_delete' , 'customers.delete' , !$model->trashed()] ,
			['undo' , trans('people.commands.unblock') , 'modal:manage/customers/-id-/undelete' , 'customers.bin' , $model->trashed()] ,
			['times' , trans('people.commands.hard_delete') , 'modal:manage/customers/-id-/hard_delete' , 'customers.bin' , $model->trashed()] ,

			['user' , trans('people.commands.login_as') , 'modal:manage/customers/-id-/login_as' , 'developer' , !$model->trashed()] ,


		],
	])
</td>