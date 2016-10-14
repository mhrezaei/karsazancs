@include('forms.group-start' , [
    'label' => isset($domain)? $domain->title : trans('validation.attributes.global_value'),
])

@include('forms.check' , [
//    'name' => isset($domain)? $domain->slug : 'global_value',
    'label' => ' ',
//    'class' => isset($domain)? '' : 'form-default',
])

@include('forms.group-end')
