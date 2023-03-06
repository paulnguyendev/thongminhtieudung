@php
    use App\Helpers\Template\Product;
    use App\Helpers\Obn;
    $thumbnail = Obn::showThumbnail($item['thumbnail']);
@endphp
@extends('user.main')
@section('navbar_title', $item['title'] ?? '-')
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ $thumbnail }}" alt="" class="img-responsive entry-thumbnail">
                            <div class="entry-gallery">

                                @php
                                    $galleries = Product::getGallery($item_meta['gallery'] ?? '');
                                    
                                @endphp
                                <div class="row">
                                    @if (count($galleries) > 0)
                                        @foreach ($galleries as $gallery)
                                            <div class="col-xs-3">
                                                <div class="gallery-item">
                                                    <a href="{{ $gallery }}" data-fancybox="near-gallery"
                                                        data-caption="1">
                                                        <img src="{{ $gallery }}" alt=""
                                                            class="img-responsive">
                                                    </a>

                                                </div>

                                            </div>
                                        @endforeach
                                    @endif
                                </div>


                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="entry-top">
                                <h1 class="entry-title">{{ $item['title'] ?? '-' }}</h1>
                                <div class="desc-list">
                                    <div class="desc-item">
                                        <strong>Mã sản phẩm: </strong>
                                        <span>{{ $item['code'] ?? '-' }}</span>
                                    </div>
                                    <div class="desc-item">
                                        <strong>Thương hiệu: </strong>
                                        <span>{{ $item_supplier['name'] ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="entry-discount">
                                    <p class="entry-price">
                                        <strong>{{ Product::getPriceProduct($item['regular_price']) }}</strong>
                                    </p>
                                    <div class="discount-list">
                                        {!! Product::getDiscount($item['regular_price'], '2') !!}
                                        <div>
                                            <span>Giảm giá tối đa</span>
                                            <span>:</span>
                                            <span>{{ Product::getPriceOfPercent($item['regular_price'], $item['percent']) }}</span>
                                        </div>
                                        <div>
                                            <span>Điểm tích lũy</span>
                                            <span>:</span>
                                            <span>{{ $item['point'] ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="entry-form">
                                    <div class="entry-stock-info">
                                        <label for="">Số lượng</label>
                                        <div class="stock-input-group">
                                            <button class="quantity-btn btnMinus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <span name="quantity-number" class="quantity-number">1</span>
                                            <button class="quantity-btn btnPlus">
                                                <i class="fa fa-plus"></i>
                                            </button>

                                        </div>
                                        @if ($item['stock'])
                                            <span>{{ $item['stock'] }} sản phẩm có sẵn</span>
                                        @endif

                                    </div>

                                </div>
                                <div class="entry-buttons">
                                    @if ($item['in_stock'] == '1')
                                        <a href="{{ route('cart/add', ['id' => $item['id']]) }}" class="btn btn-primary"
                                            id="btnAddCart" data-url="{{ route('cart/add', ['id' => $item['id']]) }}">Thêm
                                            vào
                                            giỏ</a>
                                    @endif


                                    <a data-href="{{ $aff_link }}" class="btn btn-info copy-affiliate-url">Link
                                        Affiliate</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h2>CHI TIẾT SẢN PHẨM</h2>
                            <div class="entry-content">
                                {!! $item_meta['content'] ?? 'Nội dung đang cập nhật...' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="entry-supplier">
                        <h4>{{ $item_supplier['name'] ?? '-' }}</h4>
                        <div class="entry-supplier-meta">
                            <p><a href="tel:{{ $item_supplier['phone'] ?? '-' }}">{{ $item_supplier['phone'] ?? '-' }}</a>
                            </p>
                            <p>{{ $item_supplier['address'] ?? '-' }}
                            </p>

                        </div>
                        @if ($item_supplier['thumbnail'] && isset($item_supplier['thumbnail']))
                            <img src="{{ $item_supplier['thumbnail'] }}" class="supplier-thumbnail img-responsive"
                                alt="">
                        @endif

                    </div>
                </div>
            </div>
            {{-- <div class="panel panel-flat">
                <div class="panel-body">
                    <p>hello</p>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
@section('custom_srcipt')
    <script>
        $(document).on('click', '.copy-affiliate-url', function(e) {
            e.preventDefault();
            let copyText = $(this).data('href');

            let tempElement = document.createElement('input');
            tempElement.setAttribute('value', copyText);
            document.body.appendChild(tempElement);
            tempElement.select();
            document.execCommand("Copy");
            document.body.removeChild(tempElement);
            successNotice('Thông báo', 'Copy link thành công');
        });
    </script>
@endsection
