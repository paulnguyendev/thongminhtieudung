@php
    use App\Helpers\Link\ProductLink;
    use App\Helpers\Template\Product;
    use App\Helpers\Obn;
    $link = ProductLink::getLinkProductDetail($item['id']);
    $thumbnail = Obn::showThumbnail($item['thumbnail']);
@endphp
<div class="product-item">
    <div class="product-thumbnail">
        <a href="{{ $link }}"><img class="img-responsive" src="{{ $thumbnail }}" alt=""></a>
    </div>
    <div class="product-text">
        <h4 class="product-title">
            <a href="{{ $link }}">{{ $item['title'] ?? '' }}</a>
        </h4>
        <p class="product-price">
            @php
                $price = $item['regular_price'] ?? 0;
                $price = Product::getPriceProduct($price);
            @endphp
            {{ $price }}
        </p>
        <div class="product-price-discount">
            {!! Product::getDiscount($item['regular_price'] ?? 0)!!}
            <div class="product-price-discount-item">
                <span>Point: </span>
                <div>
                    <span>{{ $item['point'] ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
