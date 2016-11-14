@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		["browse/$master/open" , trans('orders.status.open')." (".$db->counter('open',$user_id,$product_id,true).") "],
		["browse/$master/unprocessed" , trans('orders.status.unprocessed')." (".$db->counter('unprocessed',$user_id,$product_id,true).") "],
		["browse/$master/processing" , trans('orders.status.processing')." (".$db->counter('processing',$user_id,$product_id,true).") "],
		["browse/$master/under_payment" , trans('orders.status.under_payment')." (".$db->counter('under_payment',$user_id,$product_id,true).") "],
		["browse/$master/dispatched" , trans('orders.status.dispatched')." (".$db->counter('dispatched',$user_id,$product_id,true).") "],
		["browse/$master/archive" , trans('orders.status.archive')],
		["browse/$master/all" , trans('orders.status.all')],
		["browse/$master/bin" , trans('orders.status.bin') , 'orders.bin'],
//		['search' , trans('forms.button.search')],
	] ,
])