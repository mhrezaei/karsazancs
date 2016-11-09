@if(!isset($no_icon) or !$no_icon)
	<i class="fa fa-clock-o mhl5 {{$class}}"></i>
@endif
<span id="{{ $id = "spnDate".rand(10000,99999) }}" onclick="$('#{{$id}} label').toggle()">
	<label class="clickable {{$class or ''}}">
		@pd(jDate::forge($date)->ago())
	</label>
	<label class="noDisplay clickable {{$class or ''}}">
		@pd(jDate::forge($date)->format('j F Y [H:m]'))
	</label>
</span>
