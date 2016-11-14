@foreach($model->talks()->get() as $talk)
	<div class="triangle-right {{$talk->user->isAdmin()? 'right' : 'left'}}">
		<div class="text">{{ $talk->text }}</div>
		<div class="by">{{ $talk->by }}</div>
	</div>
@endforeach