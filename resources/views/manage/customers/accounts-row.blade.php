<td>
	@pd($i+1)
</td>
<td>
	<a href="javascript:void(0)" onclick="masterModal('{{ url("manage/customers/".$model->id."n/edit_account") }}')">
		{{ $model->bank_name }}
	</a>
</td>


<td>
	{{ $model->beneficiary }}
</td>

<td>
	{{ $model->sheba }}
</td>
