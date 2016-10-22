@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['browse/actives' , trans('currencies.status.actives')." (".$db->counter('actives',true).") "],
		['browse/bin' , trans('currencies.status.bin')." (".$db->counter('bin',true).") "],
		['search' , trans('forms.button.search')],
	] ,
])