@php
    use App\Helpers\Obn;
    use App\Helpers\User;
    use App\Helpers\Link\ProductLink;
    use App\Helpers\Template\Product;
@endphp
@extends('frontend.main')
@section('content')
    @include("{$templatePart}headerBanner")
    {{-- @include("{$templatePart}skillCourse") --}}
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>SẢN PHẨM MỚI NHẤT</h2>
            </div>
            <div class="product-list">
                @foreach ($products as $product)
                    @php
                        $productTitle = $product['title'] ?? "";
                        $productThumb = Obn::showThumbnail($product['thumbnail']);
                        $regularPrice = $product['regular_price'] ?? 0;
                        $salePrice = $product['sale_price'] ?? 0;
                        $productPrice = $regularPrice ? $regularPrice : $salePrice;
                        $productPrice = Obn::showPrice($productPrice);
                    @endphp
                    <div class="product-item">
                        <a href="#">
                            <img src="{{ $productThumb }}" alt="" class="product-thumb">
                        </a>
                        <div class="product-text">
                            <h3 class="product-title">
                                <a class="product-link" href="#">
                                   {{$productTitle}}
                                </a>
                            </h3>
                            <p class="product-price">{{$productPrice}}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    {{-- @include("{$templatePart}hotKeywords") --}}
    {{-- @include("{$templatePart}lectureList") --}}
    {{-- @include("{$templatePart}partner") --}}
@endsection
@section('custom_srcipt')
    <script>
        $('.dashboard-slide').slick({
            dots: false,
            infinite: true,
            speed: 500,
            prevArrow: '<button class="slick-prev slide-btn"> < </button>',
            nextArrow: '<button class="slick-next slide-btn"> > </button>',
        });
    </script>
@endsection
@section('custom_style')
    <style>
        #exclusiveCourse {
            padding-bottom: 0 !important;
        }
    </style>
@endsection
