<?php
	if(!isset($id))
		$id = 'formSearch-'.rand(1000,9999);

	if(!isset($label))
		$label = trans('forms.button.search') ;
?>

<span id="{{$id}}-span" class="search">
	{!! Form::open([
		'id' => $id ,
		'url' => $target ,
		'method' => isset($method)? $method : 'get' ,
//		'files' => isset($files)? $files : 'false' ,
		'class' => 'form-inline' ,
		'style' => 'display:inline;',
//		'onsubmit' => "return search('$id')"
	]) !!}

	<input name="{{ $field_name or 'keyword' }}" value="{{$value or ''}}" class="form-control" placeholder="{{$label}}...">
	<input name="searched" type="hidden" value="1">
	{{--<button type="submit" class="btn btn-{{$type or 'default'}}">--}}
		{{--<i class="fa fa-search"></i>--}}
	{{--</button>--}}

	{!! Form::close() !!}
</span>
