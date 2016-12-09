<!-- Products -->
@if($products)
<section id="products">
    <div class="part-title"> {{ trans('front.products') }} </div>
    <div class="row">
        @foreach($products as $product)
        <div class="col-sm-4">
            <a href="product.html" class="product {{ $product->meta('color') }}">
                <h1 class="title"> {{ $product->title }} </h1>
                <div class="text">
                    <p>{{ $product->say('abstract') }}</p>
                </div>
                <span class="value">{{ $product->meta }}</span>
                <span class="price"> </span>
            </a>
        </div>
        @endforeach
    </div>
</section>
@endif