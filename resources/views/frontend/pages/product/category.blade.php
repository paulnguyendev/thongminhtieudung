@php
    use App\Helpers\Obn;
    use App\Helpers\Link\ProductLink;
    use App\Helpers\Template\Product;
@endphp
@extends('frontend.main')
@section('navbar_title', $item['name'] ?? '-')
@section('content')
    <div class="product-wrap category-page">
        <h3>{{ $item['name'] ?? '-' }} ({{$total}})</h3>
        <div class="product-home-list">
            @if ($total > 0)
                @foreach ($items as $product)
                    @php
                        $thumbnail = Obn::showThumbnail($product['thumbnail']);
                        $link = ProductLink::getLinkProductDetail2($product['id']);
                        $price = $product['regular_price'] ?? 0;
                        $price = Product::getPriceProduct($price);
                    @endphp
                    <div class="product-home-item">
                        <a href="{{ $link }}"><img src="{{ $thumbnail }}" alt=""
                                class="img-responsive product-thumb"></a>
                        <div class="product-home-text">
                            <h3 class="product-home-title">
                                <a href="{{ $link }}">{{ $product['title'] ?? '-' }}
                                </a>
                            </h3>
                            <p class="product-home-price">
                                <strong> {{ $price }}
                                </strong>
                            </p>
                        </div>
                    </div>
                @endforeach
            @else 
                    <p>Nội dung đang cập nhật</p>
            @endif
          
         
        </div>
    </div>
@endsection
