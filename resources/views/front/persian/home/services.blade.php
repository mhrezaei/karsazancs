@if($services)
<!-- Services -->
<section id="services">
    <div class="part-title"> {{ trans('front.our_services') }} </div>
    <div class="row">
        @foreach($services as $service)
        <div class="col-sm-3">
            <a href="{{ $service->say('link') }}" class="service">
                <section class="panel">
                    <article>
                        <div class="tac"><img src="{{ $service->say('featured_image') }}" width="66"></div>
                        <h3> {{ $service->say('title') }} </h3> </article>
                </section>
            </a>
        </div>
        @endforeach
    </div>
</section>
@endif