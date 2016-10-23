@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/upstream/save/department'),
	'modal_title' => $model->id? trans('manage.settings.edit_department') : trans('manage.settings.new_department'),
	'no_validation' => true ,
])
<div class='modal-body'>

	@include('forms.hidden' , [
		'name' => 'id' ,
		'value' => $model->id,
	])

	@include('forms.input' , [
	    'name' =>	'title',
	    'value' =>	$model->title,
	    'class' => 'form-required form-default' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	])

	@include('forms.input' , [
	    'name' =>	'slug',
	    'class' =>	'form-required ltr',
		'value' =>	$model->slug ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	])

	@include('forms.input' , [
	    'name' =>	'icon',
	    'class' =>	'form-required ltr',
		'value' =>	$model->icon ,
	    'hint' =>	trans('manage.settings.branch_icon_hint'),
	])

	@include('forms.group-start')
		@include('forms.check' , [
			'label' => trans('manage.settings.online_feature') ,
			'name' => 'can_online' ,
			'value' => $model->can_online ,
		])
	@include('forms.group-end')

	@if($model->id and $posts = $model->tickets()->count())
		@include('forms.note' , [
			'shape' => 'warning' ,
			'text' => trans('manage.settings.department_delete_alert_tickets' , ['count' => $posts]) ,
			'class' => '-delHandle noDisplay'
		])
	@endif
	@include('forms.note' , [
		'shape' => 'danger' ,
		'text' => trans('manage.settings.branches_delete_alert') ,
		'class' => '-delHandle noDisplay'
	])

	@include('forms.group-start')

		@include('forms.button' , [
			'id' => 'btnSave' ,
			'label' => trans('forms.button.save'),
			'shape' => 'success',
			'type' => 'submit' ,
			'value' => 'save' ,
			'class' => '-delHandle'
		])

		@if($model->id)
			@include('forms.button' , [
				'id' => 'btnDeleteWarning' ,
				'label' => trans('forms.button.delete'),
				'shape' => 'warning',
				'link' => '$(".-delHandle").toggle()' ,
				'class' => '-delHandle' ,
			])
			@include('forms.button' , [
				'id' => 'btnDelete' ,
				'label' => trans('forms.button.sure_delete'),
				'shape' => 'danger',
				'value' => 'delete' ,
				'type' => 'submit' ,
				'class' => 'noDisplay -delHandle' ,
			])

		@endif


		@include('forms.button' , [
			'label' => trans('forms.button.cancel'),
			'shape' => 'link',
			'link' => '$(".modal").modal("hide")',
		])

	@include('forms.group-end')

	@include('forms.feed')

	@include('forms.closer')

</div>
@include('templates.modal.end')