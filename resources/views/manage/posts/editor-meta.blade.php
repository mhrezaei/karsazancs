@foreach($model->branch()->allowedMeta() as $field )
	@include('manage.frame.widgets.input-'.$field['type'] , [
		'name' => $field_name = $field['name'] ,
		'value' => $model->$field_name ,
		'class' => $field['required']? 'form-required' : ''
	])
@endforeach

