{{--@include('manage.frame.widgets.sidebar-link' , [--}}
	{{--'icon' => 'dashboard' ,--}}
	{{--'caption' => trans('manage.modules.index') ,--}}
	{{--'link' => 'index' ,--}}
{{--])--}}

{{--@include('manage.frame.widgets.sidebar-link' , [--}}
	{{--'icon' => 'child' ,--}}
	{{--'caption' => trans('manage.modules.volunteers') ,--}}
	{{--'link' => 'volunteers' ,--}}
	{{--'permission' => 'volunteers' ,--}}
	{{--'sub_menus' => [--}}
		{{--['volunteers/create' , trans('people.volunteers.manage.create') , 'plus-square-o' , 'volunteers.create'] ,--}}
		{{--['volunteers/browse/active' , trans('people.volunteers.manage.active') , 'check' , 'volunteers.browse'],--}}
		{{--['volunteers/browse/pending' , trans('people.volunteers.manage.pending') , 'gavel' , 'volunteers.publish'],--}}
		{{--['volunteers/browse/care' , trans('people.volunteers.manage.care') , 'ambulance' , 'volunteers.edit'],--}}
		{{--['volunteers/browse/documentation' , trans('people.volunteers.manage.documentation') , 'adjust' , 'volunteers.edit'],--}}
		{{--['volunteers/browse/examining' , trans('people.volunteers.manage.examining') , 'file-o' , 'volunteers.publish'],--}}
		{{--['volunteers/browse/bin' , trans('people.volunteers.manage.bin') , 'times' , 'volunteers.bin'],--}}
		{{--['volunteers/search' , trans('forms.button.search') , 'search' , 'volunteers.search'],--}}
	{{--]--}}

{{--])--}}


{{--@include('manage.frame.widgets.sidebar-link' , [--}}
	{{--'icon' => 'credit-card' ,--}}
	{{--'caption' => trans('manage.modules.cards') ,--}}
	{{--'link' => 'cards' ,--}}
	{{--'permission' => 'cards' ,--}}
	{{--'sub_menus' => [--}}
		{{--['cards/create' , trans('people.cards.manage.create') , 'plus-square-o' , 'cards.create'] ,--}}
		{{--['cards/browse/all' , trans('people.cards.manage.all') , 'bars' , 'cards.browse'],--}}
		{{--['cards/browse/incomplete' , trans('people.cards.manage.incomplete') , 'star-half' , 'cards.browse'],--}}
		{{--['cards/browse/print_request' , trans('people.cards.manage.print_request') , 'flag-checkered' , 'cards.browse'],--}}
		{{--['cards/browse/print_control' , trans('people.cards.manage.print_control') , 'qrcode' , 'cards.browse'],--}}
		{{--['cards/browse/under_print' , trans('people.cards.manage.under_print') , 'print' , 'cards.print'],--}}
		{{--['cards/browse/newsletter_member' , trans('people.cards.manage.newsletter_member') , 'newspaper-o' , 'cards.send'],--}}
		{{--['cards/search' , trans('forms.button.search') , 'search' , 'cards.search'],--}}
	{{--]--}}
{{--])--}}

{{--@foreach(Taha::sidebarPostsMenu() as $item)--}}
	{{--@include('manage.frame.widgets.sidebar-link' , $item)--}}
{{--@endforeach--}}

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'cogs',
	'caption' => trans('manage.modules.settings'),
	'link' => 'settings' ,
	'permission' => 'settings' ,
])
@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'user-secret',
	'caption' => trans('manage.modules.devSettings'),
	'link' => 'devSettings' ,
	'permission' => 'developer' ,
])
