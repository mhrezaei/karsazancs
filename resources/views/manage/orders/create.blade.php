@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/orders/save/create'),
	'modal_title' => trans('orders.new') ,
	'no_validation' => 1 ,
])
<div class='modal-body'>
	@include("forms.hiddens" , [ 'fields' => [
		['user_id' , $model->user_id] ,
		['product_id' , $model->product_id]
	]])

	@if($model->user_id)
		@include('forms.input' , [
			'name' => '',
			'label' => trans('validation.attributes.customer_id'),
			'value' => $model->user->full_name ,
			'extra' => 'disabled' ,
		])
	@else
		@include('forms.input' , [
			'name' => 'code_melli',
			'class' => 'form-required form-default' ,
			'hint' => trans('tickets.code_melli_hint'),
		])
	@endif

	@if($model->product_id)
		@include('forms.input' , [
			'name' => '',
			'label' => trans('validation.attributes.product_id'),
			'value' => $model->product->title ,
			'extra' => 'disabled' ,
		])
	@else
		@include('forms.select' , [
			'name' => 'product_id' ,
			'class' => 'form-required',
			'options' => $products ,
			'caption_field' => 'title' ,
			'blank_value' => '' ,
			'search' => true ,
		])
	@endif

	@include('forms.sep')

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('orders.new'),
			'shape' => 'success',
			'type' => 'submit' ,
			'value' => 'save' ,
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