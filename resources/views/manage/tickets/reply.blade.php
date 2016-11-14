@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/tickets/save/reply'),
	'modal_title' => trans('tickets.reply_to_ticket') ,
	'no_validation' => 1 ,
])

	<div class='modal-body'>
		<div id="divReplyBrowser">
			@include('manage.tickets.reply-browser')
		</div>
		@if($model->canReply())
			<div id="divReplyNew">
				@include('manage.tickets.reply-new')
			</div>
		@endif
	</div>

@include('templates.modal.end')