@php
    use App\Helpers\Obn;
@endphp
<ul class="dropdown-menu wrap clearfix">
    <div class="hidden" id="items-id-in-current-cart" style="display: none" data-all-cart-items="1107,1837"></div>
    <li class="clearfix wrap-form-cart k-add-to-cart-register" id="k-header-form-cart">
        <ul class="list">
            @if (Cart::instance('frontend')->count() > 0)
                @foreach (Cart::instance('frontend')->content() as $cartItem)
                    @php
                        
                        $cartItemPrice = Obn::showPrice($cartItem->price);
                        $cartItemType = $cartItem->options->type;
                        $cartItemSlug = $cartItem->options->slug;
                        $cartItemUrl = $cartItemType == 'course' ? route('fe_course/detail', ['slug' => $cartItemSlug]) : route('fe_combo/detail', ['slug' => $cartItemSlug]);
                    @endphp
                    <li>
                        <div class="col-xs-12 text">
                            <a href="{{$cartItemUrl}}">
                                {{ $cartItem->name ?? '-' }}
                                <span class="price">{{ $cartItemPrice }}</span>
                            </a>
                        </div>
                        <!--end .col-xs-8 text-->
                    </li>
                @endforeach


        </ul>
        <div class="wrap-total">
            <a href="{{ route('fe_cart/index') }}" class="btn-view">» <span>Xem giỏ hàng</span></a>
            <h6>Tổng cộng: &nbsp;<strong> {{ Cart::instance('frontend')->total(0) . ' đ' }} </strong></h6>
        </div>
        <!--end .wrap-total-->
        <div class="button-wrap">
            <a href="{{route('fe_cart/checkout')}}" class="btn-payment">Thanh toán</a>
        </div>
    @else
        <p class="empty-cart">Giỏ hàng trống!</p>
        @endif
        <!-- <ul class="button">
                <li></li>
                <li></li>
            </ul> -->
    </li>
</ul>
