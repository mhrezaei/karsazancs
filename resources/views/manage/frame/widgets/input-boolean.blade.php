@include('forms.group-start' , [
    'label' => isset($domain)? $domain->title : trans('validation.attributes.global_value'),
])

@include('forms.check' , [
    'label' => ' ',
])

@include('forms.group-end')
