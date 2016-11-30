@if($features)
<!-- Features -->
<section id="features">
    @foreach($features as $feature)
    <div class="item">
        <div class="tac"><img src="{{ $feature->say('featured_image') }}" width="66"></div>
        <h2 class="title"> {{ $feature->say('title') }} </h2>
        <p>{!! $feature->say('text') !!}</p>
    </div>
    @endforeach
</section>
@endif