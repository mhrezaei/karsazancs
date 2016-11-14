@include('manage.frame.widgets.grid-rowHeader' , [
	'refresh_url' => "manage/tickets/update/$model->id"
])

{{--
|--------------------------------------------------------------------------
| Title Column
|--------------------------------------------------------------------------
| Title, first text, ticket owner and raised date
--}}

<td>
	<div>
		@if($model->canEdit())
			<a href="javascript:void(0)" onclick="masterModal('{{ url("manage/tickets/edit/".$model->id) }}')" >
				{{ $model->title }}
			</a>
		@else
			{{ $model->title }}
		@endif
	</div>
	<div class="mv5 f10 text-info">
		{{ $model->text_limited }}
	</div>
	<div class="mv5 f8 text-grey">
		{{ trans('forms.general.from').' '}}
		@if(Auth::user()->can('customers'))
			<a href="javascript:void(0)" class="f8" onclick="masterModal('{{ url("manage/customers/".$model->user->id."/view") }}')">
				<span class="f8 text-grey">
					{{ $model->user->full_name }}
				</span>
			</a>
		@else
			{{ $model->full_name }}
		@endif
		.
		@pd(jDate::forge($model->created_at)->format('j F Y [H:m]'))
	</div>
</td>

{{--
|--------------------------------------------------------------------------
| Talks Coloumn
|--------------------------------------------------------------------------
| Number of replies, together with name and date of the first reply
--}}

<td fake="{{ $replies = $model->talks()->count() - 1 }}">
	<div>
		<a href="javascript:void(0)" onclick="masterModal('{{ url("manage/tickets/edit/".$model->id)."/reply" }}')" >
			@if($replies > 0)
				@pd($replies.' '.trans('tickets.reply'))
			@else
				{{ trans('tickets.no_reply') }}
			@endif
		</a>
	</div>
	<div class="mv5 f8 text-grey">
		@if($model->first_reply)
			{{ trans('tickets.first_reply_on' , [
				'name' => $model->first_reply->user->full_name ,
				'date' => $model->first_reply->created_at_formatted ,
			])}}
		@endif
	</div>
</td>

{{--
|--------------------------------------------------------------------------
| Status
|--------------------------------------------------------------------------
|
--}}

<td>
	@if($model->archived)
		<div class="text-grey">
			{{ trans('tickets.status.archive') }}
		</div>
	@else
		<div class="text-{{ $model->priority_color }}">
			{{ trans('tickets.status.'.$model->priority_code) }}
		</div>
	@endif
</td>

{{--
|--------------------------------------------------------------------------
| Feedback...
|--------------------------------------------------------------------------
|
--}}
<td>
	@if($model->archived)
		<i class="fa fa-{{$model->feedback_icon}} text-{{$model->feedback_color}} f20"></i>
	@endif
</td>


{{--
|--------------------------------------------------------------------------
| Actions
|--------------------------------------------------------------------------
|
--}}

@include('manage.frame.widgets.grid-actionCol' , [ 'actions' => [
		['pencil' , trans('manage.permits.edit') , "modal:manage/tickets/edit/-id-" , '*' , $model->canEdit()],
		['reply-all' , trans('tickets.reply') , "modal:manage/tickets/edit/-id-/reply" , '*' , $model->canReply()],

		['ban' , trans('forms.button.soft_delete') , 'modal:manage/tickets/edit/-id-/soft_delete' , '*' , $model->canDelete()] ,
		['undo' , trans('forms.button.undelete') , 'modal:manage/tickets/edit/-id-/undelete' , '*' , $model->canBin()] ,
		['times' , trans('forms.button.hard_delete') , 'modal:manage/tickets/edit/-id-/hard_delete' , '*' , $model->canBin()] ,
]])