@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/upstream/save/branch'),
	'modal_title' => $model->id? trans('manage.settings.edit_branch') : trans('manage.settings.new_branch'),
	'no_validation' => true ,
])
<div class='modal-body'>

	@include('forms.hidden' , [
		'name' => 'id' ,
		'value' => $model->id,
	])

	@include('forms.input' , [
	    'name' =>	'plural_title',
	    'value' =>	$model->plural_title,
	    'class' => 'form-required form-default' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	])
	@include('forms.input' , [
	    'name' =>	'singular_title',
	    'value' =>	$model->singular_title,
	    'class' => 'form-required' ,
	    'hint' =>	trans('validation.hint.persian-only'),
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

	@include('forms.input' , [
	    'name' =>	'template',
	    'class' =>	'ltr form-required',
		'value' =>	$model->template,
	    'hint' =>	trans('manage.settings.one_of_these').' '.implode(' , ',$model::$available_templates),
	])

	@include('forms.input' , [
		'name' =>	'header_title',
		'value' =>	$model->header_title,
		'hint' =>	trans('validation.hint.persian-only'),
	])


	@include('forms.input' , [
	    'name' =>	'features',
	    'label' => trans('manage.settings.branches_features'),
	    'class' =>	'ltr',
		'value' =>	$model->features ,
	    'hint' =>	trans('manage.settings.some_of_these').' '.implode(' , ',$model::$available_features),
	])


	@include('forms.input' , [
		'name' =>	'allowed_meta',
		'class' =>	'ltr',
		'value' =>	$model->allowed_meta ,
		'hint' =>	trans('manage.settings.branches_meta_hint').' '.implode(' , ',$model::$available_meta_types),
	])

	@if($model->id and $posts = $model->allPosts()->count())
		@include('forms.note' , [
			'shape' => 'warning' ,
			'text' => trans('manage.settings.branches_delete_alert_posts' , ['count' => $posts]) ,
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