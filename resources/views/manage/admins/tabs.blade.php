@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['browse/ordinaries' , trans('people.admins.ordinaries')." (".$db->counter('admins','ordinaries',true).") "],
		['browse/supers' , trans('people.admins.supers')." (".$db->counter('admins','supers',true).") " ],
		['browse/bin' , trans('people.admins.bin')." (".$db->counter('admins','bin',true).") "],
		['search' , trans('forms.button.search')],
	] ,
])
