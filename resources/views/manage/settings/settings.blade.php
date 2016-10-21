@extends('manage.frame.use.0')

@section('section')
	@include('manage.settings.tabs')

	@if($model_data->count())


		@include('forms.opener' , [
			'id' => 'frmEditor',
			'url' => 'manage/settings/save',
			'title' => $page[1][1] ,
			'class' => 'js' ,
		])

			@foreach($model_data as $model)
				@include('manage.frame.widgets.input-'.$model->data_type , [
					'name' => $model->slug ,
					'value' => $model->value() ,
					'label' => $model->title ,
				])
			@endforeach

			@include('forms.sep')

			@include('forms.group-start')

				@include('forms.button' , [
					'label' => trans('forms.button.save'),
					'shape' => 'success',
					'type' => 'submit' ,
				])

				@include('forms.button' , [
					'label' => trans('forms.button.undo_changes'),
					'shape' => 'link',
					'type' => 'button' ,
					'class' => 'text-grey' ,
					'link' => 'location.reload();' ,
				])

			@include('forms.group-end')

			@include('forms.feed' , [])

		@include('forms.closer')

	@else
		@include('manage.frame.widgets.browse-null')
	@endif

@endsection