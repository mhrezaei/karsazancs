@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/upstream/save/downstream_value'),
	'modal_title' => $model->title ,
])
	<div class='modal-body'>

		@include('forms.hiddens' , ['fields' => [
			['id' , $model->id],
			['data_type' , $model->data_type]
		]])

		@include('forms.input' , [
			'name' =>	'title',
			'value' =>	$model->title." ($model->slug) ",
			'extra' => 'disabled'
		])

		@include("manage.frame.widgets.input-$model->data_type" , [
			'value' => $model->default_value ,
			'name' => 'default_value' ,
			'class' => 'form-default'
		])

		@include("manage.frame.widgets.input-$model->data_type" , [
			'value' => $model->custom_value ,
			'name' => 'custom_value'
		])

		@include('forms.group-start')

			@include('forms.button' , [
				'id' => 'btnSave' ,
				'label' => trans('forms.button.save'),
				'shape' => 'success',
				'type' => 'submit' ,
				'value' => 'save' ,
			])

			@include('forms.button' , [
				'label' => trans('forms.button.cancel'),
				'shape' => 'link',
				'link' => '$(".modal").modal("hide")'
			])


		@include('forms.group-end')

		@include('forms.feed')

		@include('forms.closer')

	</div>
@include('templates.modal.end')