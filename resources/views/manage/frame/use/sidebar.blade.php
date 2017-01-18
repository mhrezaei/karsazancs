@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'dashboard' ,
	'caption' => trans('manage.index') ,
	'link' => 'index' ,
])

@foreach(Taha::sidebarPostsMenu() as $item)
	@include('manage.frame.widgets.sidebar-link' , $item)
@endforeach

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
