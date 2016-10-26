@include('manage.frame.widgets.grid-rowHeader' , [
	'refresh_url' => "manage/tickets/update/$model->id"
])
<td>
	@pd(jDate::forge($model->effective_date)->format('j F Y [H:m]'))
</td>
<td>
	@pd(number_format($model->price_to_buy))
</td>
<td>
	@pd(number_format($model->price_to_sell))
</td>
<td>
	@pd(jDate::forge($model->created_at)->format('j F Y [H:m]'))
</td>
<td>
	{{ $model->user->full_name }}
</td>