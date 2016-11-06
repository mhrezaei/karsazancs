@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['browse/all' , trans('products.status.all')." (".$db->counter('all',true).") "],
		['browse/available' , trans('products.status.available')." (".$db->counter('available',true).") "],
		['browse/alarm' , trans('products.status.alarm')." (".$db->counter('alarm',true).") "],
		['browse/not_available' , trans('products.status.not_available')." (".$db->counter('not_available',true).") "],
		['browse/bin' , trans('products.status.bin') , 'products.bin'],
		['search' , trans('forms.button.search')],
	] ,
])