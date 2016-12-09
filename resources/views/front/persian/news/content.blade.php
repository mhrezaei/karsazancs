<div class="page-bg">
    <div class="part-title"> {{ trans('front.faq') }} </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-center">
                <div class="page-content">
                    @if($news)
                        @foreach($news as $new)
                            <section class="panel post">
                                <a href="{{ $new->say('link') }}" class="thumbnail"><img src="{{ $new->say('featured_image') }}"></a>
                                <div class="content"> <a href="{{ $new->say('link') }}" class="title"> {{ $new->say('title') }} </a>
                                    <p class="excerpt">{!! $new->say('abstract') !!}</p>
                                    <p class="excerpt">{{ $new->say('published_at') }}</p>
                                </div>
                            </section>
                        @endforeach
                    @else
                    <div class="alert red">
                        <p>{{ trans('front.no_data') }}</p>
                    </div>
                    @endif

                    <div class="row" style="text-align: center; margin: 0 auto;">
                        {!! $news->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>