@extends('manage.frame.use.0')

@section('section')
	@include('manage.products.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[1][1] or ''}}</p></div>
		<div class="col-md-8 tools">
		</div>
	</div>


	<div class="panel panel-default m20">

		@include('forms.opener',[
			'url' => 'manage/products/search' ,
			'class' => 'js-' ,
			'method' => 'get',
		])

			<br>

			@include('forms.hiddens' , ['fields' => [
				['searched' , 1],
			]])

			@include('forms.input' , [
				'name' => 'keyword',
				'class' => 'form-required form-default'
			])

			@include('forms.group-start')

				@include('forms.button' , [
					'label' => trans('forms.button.search'),
					'shape' => 'success',
					'type' => 'submit' ,
				])

			@include('forms.group-end')

			@include('forms.feed' , [])

		@include('forms.closer')
	</div>

@endsection