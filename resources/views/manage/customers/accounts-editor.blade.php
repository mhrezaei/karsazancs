@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/customers/save/account'),
	'modal_title' => $model->id? trans('manage.permits.edit').' '.trans('people.commands.bank_account')  : trans('posts.manage.create' , ['thing' => trans('people.commands.bank_account')]),
	'no_validation' => 1 ,
])
<div class='modal-body'>

	{{--
	|--------------------------------------------------------------------------
	| Form Begin
	|--------------------------------------------------------------------------
	| ID and `customer_type`
	--}}


	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
		['user_id' , $model->user_id]
	]])

	@include('forms.input' , [
		'name' => '',
		'label' => trans('validation.attributes.name_first'),
		'value' => $model->id? $model->user->full_name : $model->user_name ,
		'extra' => 'disabled' ,
	])

	@include('forms.select' , [
		'name' => 'bank_name' ,
		'options' => $model->settingCombo('banks') ,
		'caption_field' => '0' ,
		'value_field' => '0' ,
		'value' => $model ,
		'blank_value' => '' ,
		'class' => 'form-default' ,
		'search' => true ,
	])

	@include('forms.input' , [
		'name' => 'sheba',
		'value' => $model ,
		'class' => 'form-required ltr' ,
	])
	@include('forms.input' , [
		'name' => 'account_no',
		'value' => $model ,
		'class' => 'ltr form-required' ,
	])
	@include('forms.input' , [
		'name' => 'beneficiary',
		'value' => $model ,
		'class' => 'form-required' ,
	])

	@include('forms.input' , [
		'name' => 'branch_name',
		'value' => $model ,
	])

	@include('forms.input' , [
	    'name' => 'branch_code',
	    'value' => $model
	])

	@include('forms.note' , [
		'shape' => 'danger' ,
		'text' => trans('people.form.hard_delete_notice') ,
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
				'label' => trans('forms.button.sure_hard_delete'),
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

</div>
@include('templates.modal.end')