@if($front_slide)
<!-- Main Title -->
<div id="slider">
    <div class="slides">
        <div class="slide" style="background-image: url('{{ $front_slide->say('featured_image') }}');">
            <div class="content">
                <h1> {{ $front_slide->title }} </h1>
                <p>{!! $front_slide->text !!}</p>
                <a href="{{ url('/products') }}" class="button block blue"> {{ trans('front.give_card') }} </a>
            </div>
        </div>
    </div>
</div>
@endif