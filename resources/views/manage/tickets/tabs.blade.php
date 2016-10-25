@include('manage.frame.use.tabs' , [
	'current' => $page[0][2] ,
	'tabs' => [
		['open' , trans('tickets.status.open') , "any"],
		['online' , trans('tickets.status.online') , "any"],
		['high' , trans('tickets.status.high') , "any"],
		['medium' , trans('tickets.status.medium') , "any", $db->counter($department->slug , 'auto' , 'pending') , Auth::user()->can("$department->slug.publish")? 'warning' : 'info'],
		['low' , trans('tickets.status.low') , "any"],
		['archive' , trans('tickets.status.archive') , "any"],
		['bin' , trans('tickets.status.bin') , "tickets-$department->slug.bin"],
		['search' , trans('forms.button.search') , "any"],
	] ,
])
