@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/orders/save/soft_delete'),
	'modal_title' => trans('forms.button.soft_delete'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])


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
			'label' => trans('forms.button.soft_delete'),
			'shape' => 'warning',
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