@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/orders/save/undelete'),
	'modal_title' => trans('forms.button.undelete'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])


	@include('forms.input' , [
		'label' => trans('orders.type.title'),
		'value' => $model->title ,
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
			'label' => trans('forms.button.undelete'),
			'shape' => 'primary',
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