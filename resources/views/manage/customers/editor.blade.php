@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/customers/save/'),
	'modal_title' => $model->id? trans('people.customers.edit')  : trans('people.customers.create'),
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
	]])

	@include('forms.select' , [
		'name' => 'customer_type' ,
		'id' => 'cmbCustomerType' ,
		'class' => 'form-required',
		'options' => [
			['1' , trans('people.status.active_individual')],
			['2' , trans('people.status.active_legal')],
		] ,
		'caption_field' => '1' ,
		'value_field' => '0' ,
		'value' => $model->customer_type ,
		'on_change' => 'customerEditor()' ,
	])


	{{--
	|--------------------------------------------------------------------------
	| Legal Customers
	|--------------------------------------------------------------------------
	| all classed with -legal
	--}}

	@include('forms.sep' , [
		'label' => trans('people.customers.primary_details') ,
	])


	@include('forms.input' , [
		'name' => 'name_firm',
		'value' => $model ,
		'class' => 'form-required form-default -legal' ,
	])
	@include('forms.input' , [
		'name' => 'national_id',
		'value' => $model ,
		'class' => 'form-required -legal' ,
	])
	@include('forms.input' , [
		'name' => 'register_no',
		'value' => $model ,
		'class' => 'form-required -legal' ,
	])
	@include('forms.datepicker' , [
		'name' => 'register_date',
		'value' => $model ,
		'class' => 'form-required -legal' ,
	])
	@include('forms.select' , [
		'name' => 'register_firm' ,
		'class' => 'form-required -legal',
		'options' => $model->settingCombo('register_firms') ,
		'caption_field' => '0' ,
		'value_field' => '0' ,
		'value' => $model ,
		'blank_value' => '' ,
	])
	@include('forms.input' , [
		'name' => 'economy_code',
		'value' => $model ,
		'class' => ' -legal' ,
	])
	@include('forms.input' , [
		'name' => 'gazette_url',
		'value' => $model ,
		'class' => ' -legal' ,
	])

	{{--
	|--------------------------------------------------------------------------
	| Individual Customers
	|--------------------------------------------------------------------------
	| -legal and -individual classes are used to separate non-mutual fields
	--}}

	@include('forms.sep' , [
		'class' => '-legal' ,
		'label' => trans('people.customers.agent_details') ,
	])

	@include('forms.input' , [
		'name' => 'name_first',
		'value' => $model ,
		'class' => 'form-required' ,
	])

	@include('forms.input' , [
	    'name' => 'name_last',
	    'class' => 'form-required',
	    'value' => $model
	])
	@include('forms.input' , [
	    'name' => 'code_melli',
	    'class' => 'form-required',
	    'value' => $model
	])

	@include('forms.select-gender' , [
			'class' => '-individual form-required' ,
			'blank_value' => '' ,
			'value' => $model
	])

	@include('forms.input' , [
		'name' => 'email',
		'class' => 'form-required ltr',
		 'value' => $model ,
	])

	@include('forms.input' , [
		'name' => 'mobile',
		'class' => 'form-required ltr',
		 'value' => $model ,
	])
	@include('forms.input' , [
		'name' => 'code_id',
		'class' => 'form-required ltr -individual',
		 'value' => $model ,
	])
	@include('forms.input' , [
		'name' => 'name_father',
		'class' => 'form-required -individual',
		 'value' => $model ,
	])
	@include('forms.datepicker' , [
		'name' => 'birth_date',
		'class' => 'form-required -individual',
		 'value' => $model ,
	])

	@include('forms.select-marital' , [
		'class' => '-individual' ,
		'blank_value' => '' ,
		'value' => $model ,
	])

	@include('forms.select-education' , [
		'class' => ' -individual' ,
		'value' => $model ,
	])

	@include('forms.input' , [
		'name' => 'job',
		'value' => $model ,
		'class' => ' -individual' ,
	])

	{{--
	|--------------------------------------------------------------------------
	| Address
	|--------------------------------------------------------------------------
	| Mutual between both customer types
	--}}

	@include('forms.sep' , [
		'label' => trans('people.customers.location_address') ,
	])


	@include('forms.select' , [
		'name' => 'city_id' ,
		'value' =>  $model  ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'search_placeholder' => trans('forms.button.search') ,
		'class' => 'form-required' ,
	])

	@include('forms.textarea' , [
		'name' => 'address',
		'value' => $model ,
	])

	@include('forms.input' , [
		'name' => 'postal_code',
		'value' => $model ,
		'class' => 'form-required' ,
	])

	@include('forms.input' , [
		'name' => 'telephone',
		'value' => $model ,
		'class' => 'form-required' ,
	])


	{{--
	|--------------------------------------------------------------------------
	| Form Finishers
	|--------------------------------------------------------------------------
	| `familization`, `password` and form buttons
	--}}


	@include('forms.sep' , [
		'label' => trans('people.customers.about_site') ,
	])

	@include('forms.select' , [
		'name' => 'familization' ,
		'options' => $model->settingCombo('familization') ,
		'caption_field' => '0' ,
		'value_field' => '0' ,
		'value' => $model ,
		'blank_value' => '' ,
	])

	@if(!$model->id)
		@include('forms.input' , [
			'name' => '' ,
			'label' => trans('validation.attributes.password'),
			'extra' => 'disabled' ,
			'class' => 'f10' ,
		 	'value' => trans('people.form.default_password'),
		])
	@endif

	@include('forms.sep')


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