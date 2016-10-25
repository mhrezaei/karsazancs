@if($domains->count()>1)
	@include('forms.group-start' , [
		'label' => trans('validation.attributes.domain_id') ,
		'class' => 'form-required'
	])

	<div class="row">
		@foreach($domains->get() as $domain)
			<div class="col-md-4">
				@include('forms.check' , [
					'name' => "domain_".$domain->slug,
					'label' => $domain->title,
					'value' => str_contains($model->domains , '|'.$domain->slug.'|'),
					'class' => '-domain'
				])
			</div>
		@endforeach
	</div>
	<a href="javascript:void(0)" class="btn btn-xs btn-link" onclick="$('.-domain').prop('checked', true)">{{ trans('forms.general.all') }}</a>
	<a href="javascript:void(0)" class="btn btn-xs btn-link" onclick="$('.-domain').prop('checked', false)">{{ trans('forms.general.none') }}</a>

	@include('forms.group-end')
@endif

