@if($model->branch()->hasFeature('schedule'))
	<div class="panel panel-default w100">
		<div class="panel-heading">
			{{ trans('posts.manage.show_date') }}
		</div>

		@if(!$model->published_by)
			<div class="text-center m10">
				@include('forms.select_self' , [
					'name' => 'publish_date_mode' ,
					'id' => 'cmbPublishDate' ,
					'blank_value' => 'auto',
					'blank_label' => trans('posts.manage.publish_immediately') ,
					'extra' => 'onChange=postDomainSelector()' ,
					'value' => $model->published_at? 'custom' : 'auto' ,
					'options' => [['id'=>'custom' , 'title'=>trans('posts.manage.publish_custom')]] ,
					'on_change' => "postEditorFeatures()" ,
				])
			</div>
		@else
			@include('forms.hiddens' , ['fields' => [
				['publish_date_mode' , 'custom'],
			]])
		@endif



		<div class="text-center m10 {{ $model->published_at? '' : 'noDisplay' }}">
			{{--<input type="text" name="publish_date" time="1"  id="txtPublishDate" readonly value="{{jdate($model->published_at)->format('Y/m/d/H/i/s')}}" placeholder="{{ trans('posts.manage.publish_immediately') }}"  class="form-control text-center form-datepicker form-required clickable ">--}}
			@include('forms.datepicker' , [
				'name' => 'publish_date' ,
				'id' => 'txtPublishDate' ,
				'value' => $model->published_at ,
				'in_form' => 0 ,
			])
		</div>

	</div>
@else

@endif

