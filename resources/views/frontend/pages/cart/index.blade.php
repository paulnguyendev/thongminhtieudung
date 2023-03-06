@php
    use App\Helpers\Obn;
@endphp
@extends('frontend.main')
@section('navbar_title', 'Giỏ hàng')
@section('title', 'Giỏ hàng')
@section('content')
    <div id="k-shopping" class="container k-height-header">
        <div class="k-shopping-list">
            @if ($cartCount > 0)
                <section>
                    <div class="k-header-shopping-list clearfix">
                        <div class="k-header-shopping-list-left">
                            <img src="https://cdn-skill.kynaenglish.vn/img/cart/icon-cart-checkout.png" alt="">
                            <div class="k-header-shopping-list-left-info">
                                <div class="k-header-shopping-list-left-info-tit">Thông tin giỏ hàng</div>
                                <div class="k-header-shopping-list-left-info-des">
                                    <span>{{ $cartCount }}</span> <span class="pc">khóa học,</span><span
                                        class="mob"><b>khóa học</b> đã chọn</span> <span> {{ $cartTotal }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="k-header-shopping-list-right">
                            <a href="{{ route('fe_cart/checkout') }}" class="btn-payment">TIẾP TỤC THANH TOÁN</a>
                        </div>
                    </div>
                </section>
                <section>
                    <form id="cart-form" action="/cart/default/remove" method="post">
                        <input type="hidden" name="_csrf"
                            value="eXM1MGhUYXAsEmVJB2wCRzEcakgCED43PywHZR0WNl0TREQGG2MGCg==">
                        <input type="hidden" name="pids[]">
                        <ol class="k-shopping-list-items list-unstyled">
                            @php
                            @endphp
                            @foreach ($cartContent as $cartItem)
                                @php
                               
                                    $cartItemId = $cartItem->id;
                                    $cartItemQty = $cartItem->qty;
                                    $cartItemThumbUrl = $cartItem->options->thumbnail;
                                    $cartItemPrice = Obn::showPrice($cartItem->price);
                                    $cartItemType = $cartItem->options->type;
                                    $cartItemSlug = $cartItem->options->slug;
                                    $cartItemTypeName = $cartItemType  == 'course' ? "Khóa học" : "Combo";
                                    $cartItemUrl = $cartItemType  == 'course' ? route('fe_course/detail',['slug' => $cartItemSlug]) : "";
                                @endphp
                                <li class="items">
                                    <div class="k-shopping-list-items-title" data-id="1954" data-price="199000"
                                        data-brand="Lê Trọng Nghĩa">
                                        <div class="items-img">
                                            <a href="{{$cartItemUrl}}" title="Tự động hóa kinh doanh Online">
                                                <img class="img-fluid" src="{{ Obn::showThumbnail($cartItemThumbUrl) }}"
                                                    size="160x90" width="160px" height="90px"
                                                    alt="Tự động hóa kinh doanh Online" resizemode="cover" returnmode="img"
                                                    max-width="100%"> </a>
                                        </div>
                                        <div class="items-text">
                                            <h4>
                                                <a href="{{$cartItemUrl}}"
                                                    title="{{ $cartItem->name ?? '-' }}">
                                                    <b>{{ $cartItem->name ?? '-' }}</b> - {{$cartItemTypeName}}</a>
                                            </h4>
                                            <!-- <p>Lê Trọng Nghĩa / Giam Doc</p> -->
                                            <div class="k-shopping-list-items-group-price -mob">
                                                <span class="orange">{{ $cartItemPrice }}</span>
                                            </div>
                                            <a href="javascript:" data-id="{{ $cartItemId }}"
                                                class="items-remove cart-item-remove"  data-url = "{{route('fe_cart/remove',['id' => $cartItemId])}}"><img
                                                    src="https://cdn-skill.kynaenglish.vn/img/icon-delete.png"
                                                    alt=""
                                                   >
                                                <i>Xóa {{$cartItemTypeName}}</i></a>
                                        </div>
                                        <!--end .text-->
                                    </div>
                                    <!--end .title-->
                                    <div class="k-shopping-list-items-group-price">
                                        <div class="k-shopping-list-items-sale">
                                            <span> {{ $cartItemQty }} </span>
                                        </div>
                                        <div class="k-shopping-list-items-price-new">
                                            <span>{{ $cartItemPrice }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </form>
                </section>
                <section>
                    <div class="k-shopping-checkout-total-price clearfix">
                        <div class="k-shopping-checkout-total-price-text">
                            <span>TỔNG THÀNH TIỀN</span>
                            <label for="">Học phí gốc</label>
                            <label for="">Giảm giá</label>
                            <label for="">Tổng cộng</label>
                        </div>
                        <div class="k-shopping-list-items-group-price">
                            <div class="k-shopping-checkout-total-price-sale">
                                <span>{{ $cartCount }}</span>
                            </div>
                            <div class="k-shopping-checkout-total-price-new">
                                <span>{{ $cartTotal }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="k-shopping-checkout-choose-another">
                        <a href="/danh-sach-khoa-hoc"><img src="https://cdn-skill.kynaenglish.vn/img/icon-arrow-left.png"
                                alt=""> Chọn thêm khóa học khác</a>
                    </div>
                </section>
                <section>
                    <div class="k-shopping-checkout-note clearfix">
                        <ul>
                            <li><img src="https://cdn-skill.kynaenglish.vn/img/cart/icon-cart-note-2.png" alt="">Các
                                phương thức thanh toán linh hoạt</li>
                            <li><img src="https://cdn-skill.kynaenglish.vn/img/cart/icon-cart-note-3.png" alt="">Nội
                                dung học liên tục, xuyên suốt</li>
                        </ul>
                    </div>
                </section>
            @else
                <div class="cart-empty clearfix">
                    <p class="title">Bạn chưa chọn được khóa học nào!</p>
                    <img src="https://cdn-skill.kynaenglish.vn/img/cart/icon-checkout-empty-1.png" class="img-fluid">
                </div>
            @endif

        </div>
    </div>
@endsection
@section('custom_srcipt')
    <script type="text/javascript">
        $('#product_select').on('change', '.add_item_select', function() {
            const addCart = (data) => {
                let url = $(`meta[name="cart-add"]`).attr("content");
                url = `${url}/${data.id}`;
                $.ajax({
                    type: "get",
                    url: url,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log("add cart", response);
                    }
                });
            }
            var data = {};
            data.action = $(this).is(':checked') ? 'add' : 'delete';
            data.id = $(this).attr('data-id');
            data.title = $(this).attr('data-title');
            data.thumbnail = $(this).attr('data-thumbnail');
            data.price = $(this).attr('data-price');
            data.weight = $(this).attr('data-weight');
            addCart(data);
            _update(data);
        });
        $('#product_item').on('click', '.remove_group_item', function() {
            var data = {};
            data.action = 'delete';
            data.id = $(this).attr('data-id');
            _update(data);
        });
        console.log(shoppingCart);
        if (shoppingCart.products.length > 0) {
            customrRenderTableProduct();
        }
        var quantityBreaks = [];

        function handleProductQuantityBreak() {
            $.each(shoppingCart.products, function(key, item) {
                if (quantityBreaks.hasOwnProperty(item.id)) {
                    var priceDiscount = 0;
                    var priceBase = 0;
                    if (item.hasOwnProperty('old_price')) {
                        item.price = item.old_price;
                    }
                    $.each(quantityBreaks[item.id]['discounts'], function(quantity, discount) {
                        if (item.quantity >= parseInt(quantity)) {
                            if (parseInt(quantityBreaks[item.id]['type']) == 1) {
                                priceDiscount = parseInt(discount);
                            }
                            if (parseInt(quantityBreaks[item.id]['type']) == 2) {
                                priceDiscount = parseInt(discount) * item.price / 100;
                            }
                            if (parseInt(quantityBreaks[item.id]['type']) == 3) {
                                priceBase = parseInt(discount);
                            }
                        }
                    });
                    item.old_price = item.price;
                    if (priceBase > 0) {
                        item.price = priceBase;
                    }
                    item.price -= priceDiscount;
                }
            });
            renderTableProduct();
        }

        function handleConfirmCheckout() {
            var responseData = [];
            $.ajax({
                url: base_domain + '/api/cart-before-confirm-checkout',
                type: 'POST',
                data: {
                    shoppingcart: shoppingCart.products
                },
                async: true
            }).done(function(response) {
                if (response.hasOwnProperty('product_quantity_break')) {
                    quantityBreaks = response.product_quantity_break;
                    handleProductQuantityBreak();
                } else {
                    renderTableProduct();
                }
                $(document).find('.button-next').show();
            });
        };

        function customrRenderTableProduct() {
            $('#product_item tbody').empty();
            shoppingCart.subtotal = 0;
            shoppingCart.total_weight = 0;
            console.log(shoppingCart);
            $.each(shoppingCart.products, function(index, item) {
                var related_html = '<tr id="item_' + item.id + '">';
                related_html += '<td><img src="' + item.thumbnail + '" style="max-height: 50px;" /></td>';
                related_html += '<td>' + item.product_title + '</td>';
                related_html += '<td>' + priceFormat(item.price) + '</td>';
                related_html += '<td><input type="number" min="1" data-id="' + item.id +
                    '" class="quantity" value="' + item.quantity + '" /></td>';
                related_html += '<td>' + priceFormat(parseInt(item.price) * item.quantity) + '</td>';
                related_html += '<td><a class="remove_group_item" data-id="' + item.id +
                    '"><i class="fa fa-times" aria-hidden="true"></i></a></td>';
                related_html += '</tr>';
                $('#product_item tbody').append(related_html);
                shoppingCart.subtotal += (parseInt(item.price) * item.quantity);
                if (!isNaN(parseFloat(item.weight))) {
                    shoppingCart.total_weight += (parseFloat(item.weight) * item.quantity);
                }
            });
        }
        $("#same-as-billing").on("change", function() {
            if ($(this).prop("checked")) {
                $('#fieldset-shipping').show();
                $("#fieldset-shipping input").removeAttr('disabled');
                $("#fieldset-shipping select").removeAttr('disabled');
                $("#fieldset-shipping textarea").removeAttr('disabled');
                if ($('#sprovince').children().length <= 1) {
                    buildAddress($('#sprovince'), $('#sdistrict'), $('#sward'));
                }
            } else {
                $('#fieldset-shipping').hide();
                $("#fieldset-shipping input").attr('disabled', 'disabled');
                $("#fieldset-shipping select").attr('disabled', 'disabled');
                $("#fieldset-shipping textarea").attr('disabled', 'disabled');
                $('#sname').val($('#name').val());
                $('#semail').val($('#email').val());
                $('#sphone').val($('#phone').val());
                $('#saddress').val($('#address').val());
                $('#sprovince').html($('#province').html());
                $('#sprovince').val($('#province').find('option:selected').data('id'));
                $('#sdistrict').html($('#district').html());
                $('#sdistrict').val($('#district').find('option:selected').data('id'));
                $('#sward').html($('#ward').html());
                $('#sward').val($('#ward').find('option:selected').data('id'));
            }
        });
        $('#district').change(function() {
            if (!$('input[name=has_saddress]').is(':checked')) {
                var district_id = $(this).find('option:selected').data('id');
                var province_id = $('#province').find('option:selected').data('id');
                if ($('#sprovince').children().length <= 1) {
                    buildAddress($('#sprovince'), $('#sdistrict'), $('#sward'));
                }
                $('#sprovince').html($('#province').html());
                $('#sprovince').val(province_id);
                $('#sdistrict').html($('#district').html());
                $('#sdistrict').val(district_id);
                if (district_id) {
                    calShippingfee(district_id, province_id, shoppingCart.total_weight, shoppingCart.subtotal);
                } else {
                    let html =
                        "<li class='ship_method_bacs'><label class='wb-text15'>Vui lòng chọn Tỉnh/Thành Phố và Quận/Huyện trước</label></li>";
                    $('.ship_methods').empty().append(html);
                }
            }
        });
        $('#ward').change(function() {
            if (!$('input[name=has_saddress]').is(':checked')) {
                var ward_id = $(this).find('option:selected').data('id');
                $('#sward').html($('#ward').html());
                $('#sward').val(ward_id);
                if (!ward_id) {
                    let html =
                        "<li class='ship_method_bacs'><label class='wb-text15'>Vui lòng chọn Tỉnh/Thành Phố, Phường/xã và Quận/Huyện trước</label></li>";
                    $('.ship_methods').empty().append(html);
                }
            }
        });

        function renderTableCart() {
            $('#cartItems tbody').empty();
            shoppingCart.total = shoppingCart.subtotal - shoppingCart.shipping.discount - shoppingCart.discount;
            if (shoppingCart.products.length) {
                $.each(shoppingCart.products, function(index, item) {
                    var html_tbComfirm = '';
                    html_tbComfirm += '<tr>';
                    html_tbComfirm += ' <td class="text-center"><img src="' + item.thumbnail +
                        '" style="max-height: 50px;" /></td>';
                    html_tbComfirm += ' <td>' + item.product_title + '</td>';
                    html_tbComfirm += ' <td class="text-right">' + priceFormat(item.price) + '</td>';
                    html_tbComfirm += ' <td class="text-center">' + item.quantity + '</td>';
                    html_tbComfirm += ' <td class="text-right">' + priceFormat(item.price * item.quantity) +
                        '</td>';
                    html_tbComfirm += '</tr>';
                    $('#cartItems tbody').append(html_tbComfirm);
                });
                $('#cartItems .subtotal').text(priceFormat(shoppingCart.subtotal));
                $('#cartItems .shipping').text(priceFormat(shoppingCart.shipping.fee - shoppingCart.shipping.discount));
                if (shoppingCart.shipping.message) {
                    $('#cartItems .shipping').text(priceFormat(shoppingCart.shipping.message));
                }
                $('#cartItems .discount').text(priceFormat(shoppingCart.discount));
                $('#cartItems .total').text(priceFormat(shoppingCart.total + shoppingCart.shipping.fee));
            }
        }
        $(document).on('click', '.button-next', function() {
            renderTableCart();
            shoppingCart.shipping.fee = 0;
            shoppingCart.payment.method_id = parseInt($(document).find('input[name=payment]:checked').val());
            shoppingCart.payment.method_title = $(document).find('input[name=payment]:checked').data('title');
            shoppingCart.shipping.method_id = parseInt($(document).find('input[name=ship]:checked').val());
            shoppingCart.shipping.method_title = $(document).find('input[name=ship]:checked').data('title');
            if ($(document).find('input[name=ship]:checked').length) {
                shoppingCart.shipping.fee = parseInt($(document).find('input[name=ship]:checked').data('fee'));
            }
            shoppingCart.info_order = {
                'fullname': $('#name').val(),
                'email': $('#email').val(),
                'phone': $('#phone').val(),
                'province': $('#province option:selected').val() ? $('#province option:selected').text() : '',
                'district': $('#district option:selected').val() ? $('#district option:selected').text() : '',
                'ward': $('#ward option:selected').val() ? $('#ward option:selected').text() : '',
                'address': $('#address').val()
            };
            shoppingCart.info_shipping = {
                'name': $('#sname').val(),
                'email': $('#semail').val(),
                'phone': $('#sphone').val(),
                'province': $('#sprovince option:selected').val() ? $('#sprovince option:selected').text() : '',
                'district': $('#sdistrict option:selected').val() ? $('#sdistrict option:selected').text() : '',
                'ward': $('#sward option:selected').val() ? $('#sward option:selected').text() : '',
                'address': $('#saddress').val()
            };
            shoppingCart.note = $('#note').val();
            $('.confirm_order .name').text(shoppingCart.info_order.fullname);
            $('.confirm_order .email').text(shoppingCart.info_order.email);
            $('.confirm_order .phone').text(shoppingCart.info_order.phone);
            $('.confirm_order .province').text(shoppingCart.info_order.province);
            $('.confirm_order .district').text(shoppingCart.info_order.district);
            $('.confirm_order .ward').text(shoppingCart.info_order.ward);
            $('.confirm_order .address').text(shoppingCart.info_order.address);
            $('.confirm_order .sname').text(shoppingCart.info_shipping.name);
            $('.confirm_order .semail').text(shoppingCart.info_shipping.email);
            $('.confirm_order .sphone').text(shoppingCart.info_shipping.phone);
            $('.confirm_order .sprovince').text(shoppingCart.info_shipping.province);
            $('.confirm_order .sdistrict').text(shoppingCart.info_shipping.district);
            $('.confirm_order .sward').text(shoppingCart.info_shipping.ward);
            $('.confirm_order .saddress').text(shoppingCart.info_shipping.address);
            $('.confirm_order .sshipping').text(shoppingCart.shipping.method_title);
            $('.confirm_order .note').text(shoppingCart.note);
            $('.confirm_order .payment_method').text(shoppingCart.payment.method_title);
        });
    </script>
    <script src="https://static.loveitopcdn.com/backend/js/item.select.js?v=1.2.7"></script>
    <script>
        var product_select = new ItemSelectClass();
        product_select.init('#product_select', 'product', 'multi');
    </script>
@endsection
