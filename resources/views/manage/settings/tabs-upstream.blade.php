
@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['downstream' , trans('manage.settings.downstream')],
		['branches' , trans('manage.settings.branches')],
		['states' , trans('manage.settings.states')],
	] ,
])
