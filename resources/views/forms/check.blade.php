<div id="{{$id or ''}}" class="checkbox {{$div_class or ''}}">
    <label title="{{ $title or '' }}">
		<input type="hidden" name="{{$name}}" value="0">
		{!! Form::checkbox($name , '1' , $value , [
		    'class' => isset($class)? $class : '' ,
		]) !!}
        {{ $label or trans("validation.attributes.$name") }}
    </label>
</div>
