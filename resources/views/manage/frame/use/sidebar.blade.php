@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'dashboard' ,
	'caption' => trans('manage.index') ,
	'link' => 'index' ,
])

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'shopping-basket',
	'caption' => trans('manage.modules.orders'),
	'link' => 'orders' ,
	'permission' => 'orders.browse' ,
])

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'cc-mastercard',
	'caption' => trans('manage.modules.payments'),
	'link' => 'payments' ,
	'permission' => 'payments.browse' ,
])

@include('manage.frame.widgets.sidebar-link' , Taha::sidebarTicketsMenu())


@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'user' ,
	'caption' => trans('manage.modules.customers') ,
	'link' => 'customers' ,
	'permission' => 'customers' ,
	'sub_menus' => [
		['customers/browse/active_individuals' , trans('people.status.active_individuals') , 'female'] ,
		['customers/browse/active_legals' , trans('people.status.active_legals') , 'user-secret'] ,
		['customers/browse/pendings' , trans('people.status.pending') , 'legal' , 'customers.activation'],
		['customers/browse/profile_completion' , trans('people.status.profile_completion') , 'star-half-o'],

		['customers/browse/willingly_signed_up' , trans('people.status.willingly_signed_up') , 'check-square-o' ],
		['customers/browse/stealthy_signed_up' , trans('people.status.stealthy_signed_up') , 'paw'],
		['customers/browse/newsletter_member' , trans('people.status.newsletter_member') , 'paper-plane-o' , 'customers.send'],
		['customers/browse/bin' , trans('manage.permits.bin') , 'trash-o' , 'customers.bin'],
		['customers/search' , trans('forms.button.search') , 'search' , 'cards.search'],
	]
])

@foreach(Taha::sidebarPostsMenu() as $item)
	@include('manage.frame.widgets.sidebar-link' , $item)
@endforeach

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'credit-card',
	'caption' => trans('manage.modules.products'),
	'link' => 'products' ,
	'permission' => 'products' ,
])

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'money',
	'caption' => trans('manage.modules.currencies'),
	'link' => 'currencies' ,
	'permission' => 'currencies' ,
])


@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'universal-access',
	'caption' => trans('manage.admins'),
	'link' => 'admins' ,
	'permission' => 'admins' ,
])

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'cogs',
	'caption' => trans('manage.settings.downstream'),
	'link' => 'settings' ,
	'permission' => 'settings' ,
])
@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'user-secret',
	'caption' => trans('manage.settings.upstream'),
	'link' => 'upstream' ,
	'permission' => 'developer' ,
])
