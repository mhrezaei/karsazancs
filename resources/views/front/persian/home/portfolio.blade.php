<!-- Portfolio -->
@if($portfolio)
    <?php
        $head_slug = $portfolio[0]->branch()->slug;
        $head_title = $portfolio[0]->branch()->plural_title;
    ?>
<section id="services-image">
    <div class="part-title"> {{ $head_title }} </div>
    <div class="row">
        @foreach($portfolio as $porto)
        <div class="col-sm-3">
            <a href="{{ url('/post/' . $head_slug . '/' . $porto) }}" class="service">
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