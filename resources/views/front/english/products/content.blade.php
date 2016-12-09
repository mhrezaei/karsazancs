@if($products)
<div class="page-bg">
    <div class="part-title"> {{ trans('front.products') }} </div>
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                {{ $product->spreadMeta() }}
                <div class="col-sm-4">
                    <a href="{{ url('/products') }}" class="product {{ $product->color }}">
                        <h1 class="title"> {{ $product->title }} </h1>
                        <div class="text">
                            <p>{{ $product->say('abstract') }}</p>
                        </div>
                        <span class="value">{{ $product->price }}</span>
                        <span class="price"> </span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif