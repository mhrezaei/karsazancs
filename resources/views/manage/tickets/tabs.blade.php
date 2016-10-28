@include('manage.frame.use.tabs' , [
	'current' => $page[0][2] ,
	'tabs' => [
		['open' , trans('tickets.status.open') , "any" , $db->counter($department->slug , 'open')],
		['online' , trans('tickets.status.online') , "any" , $db->counter($department->slug , 'online') , 'danger'],
		['high' , trans('tickets.status.high') , "any" , $db->counter($department->slug , 'high')],
		['medium' , trans('tickets.status.medium') , "any", $db->counter($department->slug , 'medium' ) , Auth::user()->can("$department->slug.publish")? 'warning' : 'info'],
		['low' , trans('tickets.status.low') , "any" , $db->counter($department->slug , 'low')],
		['archive' , trans('tickets.status.archive') , "any"],
		['bin' , trans('tickets.status.bin') , "tickets-$department->slug.bin"],
//		['search' , trans('forms.button.search') , "any"],
	] ,
])
