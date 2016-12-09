@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		["browse/$master/pending" , trans('payments.status.pending')." (".$db->counter('pending',$user_id,$order_id,true).") "],
		["browse/$master/rejected" , trans('payments.status.rejected')],
		["browse/$master/underpaid" , trans('payments.status.underpaid')],
		["browse/$master/overpaid" , trans('payments.status.overpaid')],
		["browse/$master/confirmed" , trans('payments.status.confirmed')],
		["browse/$master/all" , trans('payments.status.all')],
//		["browse/$master/bin" , trans('payments.status.bin') , 'payments.bin'],
//		['search' , trans('forms.button.search')],
	] ,
])