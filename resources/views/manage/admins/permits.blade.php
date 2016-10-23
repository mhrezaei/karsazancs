@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/admins/save/permits'),
	'modal_title' => trans('manage.permits.permits'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])

	@include('forms.input' , [
		'name' => '',
		'label' => trans('validation.attributes.name_first'),
		'value' => $model->full_name ,
		'extra' => 'disabled' ,
	])

	@if(Auth::user()->isSuperAdmin())
		@include('forms.select' , [
			'name' => 'level' ,
			'label' => trans('people.admins.roles') ,
			'value' => $model->admin_role ,
			'options' => [
				[ 'ordinary' , trans('people.admins.ordinary')] ,
				[ 'super' , trans('people.admins.super')]
			],
			'value_field' => '0' ,
			'caption_field' => '1' ,
			'hint' => trans('people.admins.superAdmin_hint')
		])
	@endif


	{{--
	|--------------------------------------------------------------------------
	| Roles
	|--------------------------------------------------------------------------
	|
	--}}
	@include('forms.sep')

	@foreach($opt['modules'] as $module => $permits)
		@if( !in_array($module , ['posts' , 'admins' , 'tickets']) )
			@include('manage.admins.permits-role' , [
				'module' => $module ,
				'permits' => $module ,
				'label' => trans("manage.modules.$module")
			])
		@endif
	@endforeach

	@include('forms.sep' , [
		'label' => trans('manage.modules.tickets') ,
	])

	@foreach($opt['departments'] as $department)
		@include('manage.admins.permits-role' , [
			'module' => 'tickets-'.$department->slug ,
			'permits' => 'tickets' ,
			'label' => $department->title ,
		])
	@endforeach


	@include('forms.sep' , [
		'label' => trans('manage.modules.content_management') ,
	])

	@foreach($opt['branches'] as $branch)
		@include('manage.admins.permits-role' , [
			'module' => 'posts-'.$branch->slug ,
			'permits' => 'posts' ,
			'label' => $branch->plural_title ,
		])
	@endforeach

	@include('forms.sep')


	@include('forms.group-start')
		<a href="javascript:void(0)" onclick="$('.-permits').prop('checked', true)" class="p20">{{trans('forms.general.all')}}</a>
		<a href="javascript:void(0)" onclick="$('.-permits').prop('checked', false)" class="">{{trans('forms.general.none')}}</a>
	@include('forms.group-end')

	@include('forms.sep')

	{{--
	|--------------------------------------------------------------------------
	| Buttons
	|--------------------------------------------------------------------------
	|
	--}}


	@include('forms.group-start')
		@include('forms.button' , [
			'label' => trans('forms.button.save'),
			'shape' => 'success',
			'type' => 'submit' ,
		])
		@include('forms.button' , [
			'label' => trans('forms.button.cancel'),
			'shape' => 'link',
			'link' => '$(".modal").modal("hide")',
		])

	@include('forms.group-end')

	@include('forms.feed')

</div>
@include('templates.modal.end')