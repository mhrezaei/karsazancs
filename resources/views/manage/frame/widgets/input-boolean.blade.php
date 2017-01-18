@include('forms.group-start' , [
    'label' => isset($label)? $label : trans('validation.attributes.global_value'),
])

@include('forms.check' , [
    'label' => ' ',
])

@include('forms.group-end')
