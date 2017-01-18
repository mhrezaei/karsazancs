@include('manage.frame.widgets.grid-rowHeader' , [
	'refresh_url' => "manage/admins/update/$model->id"
])

<td>
	<a href="javascript:void(0)" onclick="masterModal('{{ url("manage/admins/$model->id/edit") }}')">
		{{ $model->full_name }}
	</a>
</td>


<td>
	-
</td>

<td>
	@if($model->canBePermitted())
		<a href="javascript:void(0)" onclick="masterModal('{{ url("manage/admins/$model->id/permits") }}')">
			{{ trans("people.admins.$model->admin_role") }}
		</a>
	@else
		{{ trans("people.admins.$model->admin_role") }}
	@endif
</td>

<td>
	<span class="text-{{ $model->status_color }}">
		{{ $model->status_text }}
	</span>
</td>

@include('manage.frame.widgets.grid-actionCol' , [ 'actions' => [
		['pencil' , trans('manage.permits.edit') , "modal:manage/admins/-id-/edit"],
//		['history' , trans('people.commands.history') , "urlN:manage/admins/-id-/history"],
		['key' , trans('people.commands.change_password') , 'modal:manage/admins/-id-/change_password' , 'any' ,  !$model->trashed() ],
		['shield' , trans('manage.permits.permits') , 'modal:manage/admins/-id-/permits' , 'any' , $model->canBePermitted()],

		['ban' , trans('people.commands.block') , 'modal:manage/admins/-id-/soft_delete' , 'any' , !$model->trashed()] ,
		['undo' , trans('people.commands.unblock') , 'modal:manage/admins/-id-/undelete' , 'any' , $model->trashed()] ,
		['times' , trans('people.commands.hard_delete') , 'modal:manage/admins/-id-/hard_delete' , 'any' , $model->trashed()] ,

		['user' , trans('people.commands.login_as') , 'modal:manage/admins/-id-/login_as' , 'developer' , !$model->trashed()] ,
]])