<!-- Portfolio -->
@if(sizeof($portfolio))
<section id="services-image">
    <div class="part-title"> {{ $portfolio[0]->branch()->plural_title }} </div>
    <div class="row">
        @foreach($portfolio as $porto)
        <div class="col-sm-3">
            <a href="{{ url('/post/' . $porto->branch . '/' . $porto->id) }}" class="service">
                <section class="panel">
                    <article> <img src="{{ $porto->say('featured_image') }}">
                        <div class="title"> {{ $porto->title }} </div>
                    </article>
                </section>
            </a>
        </div>
        @endforeach
    </div>
</section>
@endif