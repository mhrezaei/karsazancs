@if($front_about)
<!-- Banner -->
<section id="banner">
    <div class="content">
        <h1> {{ $front_about->say('title') }} </h1>
        <p>{!! $front_about->text !!}</p>
        <a href="#" class="action button green"> {{ trans('front.give_card') }} </a> </div>
</section>
@endif