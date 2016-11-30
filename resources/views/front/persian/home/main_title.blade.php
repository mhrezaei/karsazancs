@if($front_slide)
<!-- Main Title -->
<section id="main-title" style="background: url('{{ $front_slide->say('featured_image') }}') no-repeat scroll center center / cover ">
    <div class="content">
        <h1> {{ $front_slide->title }} </h1>
        <p>{!! $front_slide->text !!}</p>
        <a href="{{ url('/products') }}" class="button block green"> {{ trans('front.give_card') }} </a> </div>
</section>
@endif