@if($products)
<div class="page-bg">
    <div class="part-title"> {{ trans('front.products') }} </div>
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                {{ $product->spreadMeta() }}
                <div class="col-sm-4">
                    <a href="{{ url('/products/show/' . $product->id) }}" class="product {{ $product->color_code }}">
                        <h1 class="title"> {{ $product->title }} </h1>
                        <div class="text">
                            <p>{!! $product->description !!}</p>
                        </div>
                        <span class="value">@pd(number_format($product->initial_charge))</span>
                        <span class="price"> @pd(number_format($product->card_price)) {{ trans('front.toman') }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif