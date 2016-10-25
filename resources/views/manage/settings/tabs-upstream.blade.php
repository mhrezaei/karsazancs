
@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['downstream' , trans('manage.settings.downstream')],
		['branches' , trans('manage.settings.branches')],
		['departments' , trans('manage.settings.departments')],
		['states' , trans('manage.settings.states')],
	] ,
])
