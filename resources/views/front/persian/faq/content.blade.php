<div class="page-bg">
    <div class="part-title"> {{ trans('front.faq') }} </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-center">
                <div class="page-content">
                    @if($faq)
                        @foreach($faq as $question)
                            <div class="panel green">
                                <header>
                                    <div class="title"> {{ $question->title }} </div>
                                </header>
                                <article>
                                    <p>{!! $question->text !!}</p>
                                </article>
                            </div>
                        @endforeach
                    @else
                    <div class="alert red">
                        <p>{{ trans('front.no_data') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>