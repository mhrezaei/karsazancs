@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['browse/actives' , trans('currencies.status.actives')],
		['browse/bin' , trans('currencies.status.bin')],
		['search' , trans('forms.button.search')],
	] ,
])