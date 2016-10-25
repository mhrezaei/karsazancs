@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['browse/active_individuals' , trans('people.status.active_individuals')],
		['browse/active_legals' , trans('people.status.active_legals')],
		['browse/pendings' , trans('people.status.pendings')],
		['browse/profile_completion' , trans('people.status.profile_completion')],

		['browse/willingly_signed_up' , trans('people.status.willingly_signed_up')],
		['browse/stealthy_signed_up' , trans('people.status.stealthy_signed_up')],
		['browse/newsletter_member' , trans('people.status.newsletter_member')],
		['browse/bin' , trans('people.status.bin')],
		['search' , trans('forms.button.search')],
	] ,
])