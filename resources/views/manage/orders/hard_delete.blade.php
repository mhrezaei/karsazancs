@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/orders/save/hard_delete'),
	'modal_title' => trans('forms.button.hard_delete'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])

	@include('forms.note' , [
		'text' => trans('people.form.hard_delete_notice') ,
		'shape' => 'danger' ,
	])


	@include('forms.input' , [
		'label' => trans('orders.type.title'),
		'value' => trans("orders.type.".$model->type).' ('.$model->hashid.')' ,
		'disabled' => "1",
	])
	@include('forms.input' , [
		'name' => 'product_id',
		'value' => $model->product->title ,
		'disabled' => "1",
	])
	@include('forms.input' , [
		'name' => 'customer_id',
		'value' => $model->user->full_name ,
		'disabled' => "1",
	])

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('forms.button.hard_delete'),
			'shape' => 'danger',
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