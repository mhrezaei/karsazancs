@if($front_slide)
    <!-- Main Title -->
    <div id="slider">
        <div class="slides">
            @foreach($front_slide as $slide)
                <div class="slide" style="background-image: url('{{ $slide->say('featured_image') }}');">
                    @if(strlen($slide->say('title')))
                        <div class="content">
                            <h1> {{ $slide->say('title') }} </h1>
                            @if(strlen($slide->text))
                                <p>{!! $slide->text !!}</p>
                            @endif

                            @if(strlen($slide->meta('link')))
                                <a href="{{ $slide->meta('link') }}" class="button block blue"> {{ $slide->meta('button') }} </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif