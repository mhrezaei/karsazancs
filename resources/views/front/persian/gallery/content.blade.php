<div class="page-bg">
    <div class="part-title"> {{ $page->title }} </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-center">
                <div class="row">
                    <div class="page-content" aria-atomic="{{ $page->loadPhotos() }}">
                        {!! $page->text !!}
                    </div>

                    @foreach($page->photos as $photo)
                        <div class="col-sm-3">
                        <a class="gallery-item" href="{{ url($photo['src']) }}" data-lightbox="gallery" data-title="{{ $photo['label'] }}"> <img src="{{ url($photo['src']) }}"> </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>