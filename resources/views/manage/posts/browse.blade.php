@extends('manage.frame.use.0')

@section('section')
	@include('manage.posts.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-6">
			<p class="title">
				{{$page[0][1]. ': ' . $page[1][1]}}
				@if(isset($category_label))
					<span class="badge mh20 ph20">
						{{ $category_label }}
					</span>
				@endif
			</p>
		</div>
		<div class="col-md-6 tools">
			@include('manage.posts.browse-category')
			@include('manage.frame.widgets.toolbar_button' , [
				'target' => url('manage/posts/'.$branch->slug.'/create') ,
				'type' => 'success' ,
				'caption' => trans('posts.manage.create' , ['thing'=>$branch->title(1)]) ,
				'icon' => 'plus-circle' ,
			])

			@include('manage.frame.widgets.toolbar_search_inline' , [
				'target' => url('manage/posts/'.$branch->slug.'/searched/') ,
				'label' => trans('forms.button.search') ,
				'value' => isset($keyword)? $keyword : '' ,
			])
		</div>
	</div>


	{{--
	|--------------------------------------------------------------------------
	| Grid
	|--------------------------------------------------------------------------
	|
	--}}

	@include('manage.frame.widgets.grid' , [
		'table_id' => 'tblPosts' ,
		'row_view' => 'manage.posts.browse-row' ,
		'selector' => true ,
		'headings' => [
			trans('validation.attributes.title') ,
			trans('posts.manage.properties'),
			($branch->hasFeature('domain') and Auth::user()->isGlobal()) ? trans('posts.manage.visibility') : 'NO',
			trans('forms.button.action'),
		],
	])
@endsection