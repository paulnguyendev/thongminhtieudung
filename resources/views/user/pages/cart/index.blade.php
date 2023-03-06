@extends('user.main')
@section('navbar_title', 'Giỏ hàng')
@section('content')
    <style>
        #product_item input.quantity {
            width: 90px;
            text-align: center;
        }

        button.stepy-finish {
            display: none;
        }

        .stepy-navigator button.stepy-finish {
            display: initial;
        }

        .confirm_order label {
            font-weight: bold;
            display: inline-block;
            min-width: 140px;
            text-align: right;
            margin-right: 5px;
        }

        td.coupon div.coupon {
            display: inline-block;
            margin: 7px 10px 0 0;
            background-color: #00a800;
            color: #fff;
            padding: 3px 10px;
            cursor: pointer;
            border-radius: 15px;
            font-size: 14px;
        }

        td.coupon div.coupon i {
            margin-top: -6px;
            margin-left: 1px;
            position: absolute;
            color: #000;
        }

        #coupon_msg {
            margin: 7px 0 0;
            font-weight: normal;
            color: #fff;
            background-color: red;
            padding: 3px 9px;
            font-size: 14px;
            display: none;
        }

        .ship_methods,
        .payment_methods {
            list-style: none
        }

        .payment_description {
            padding-left: 17px;
            padding-bottom: 10px;
            margin-top: -6px;
        }

        .datatable-header-select-left {
            position: relative;
            display: block;
            float: left;
            margin: 0;
        }

        .thumbnail-column {
            width: 50px;
        }

        #product_select_filter,
        #product_select_paginate {
            margin: 0;
        }
    </style>
    @if (Cart::count() == 0)
        <style>
            a.button-next.btn.btn-primary {
                display: none;
            }
        </style>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    @if (Cart::count() > 0)
                        <form class="stepy-validation" id="formCreateOrder">
                            <fieldset class="stepy-step">
                                <legend class="text-semibold">Chọn sản phẩm</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn border-slate text-slate-800 btn-flat dropdown-toggle"
                                                data-toggle="dropdown">Chọn sản phẩm
                                                <span class="caret"></span></button>
                                            <div class="dropdown-menu dropdown-menu-left"
                                                style="width: 600px;padding: 5px;">
                                                <table class="table datatable-row-basic select-item-datatable"
                                                    data-source="{{ route('cart/product') }}" id="product_select">
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table id="product_item" class="table">
                                            <thead>
                                                <tr>
                                                    <th width="100px">Hình</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th width="100px">Đơn giá</th>
                                                    <th width="120px">Số lượng</th>
                                                    <th width="150px">Thành tiền</th>
                                                    <th width="50px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset title="2" style="display: none">
                                <legend class="text-semibold">Thông tin đặt hàng</legend>
                                <div class="row" title="">
                                    <div class="col-md-6">
                                        <fieldset class="default-form">
                                            <legend class="text-semibold">Thông tin người mua</legend>
                                            <div class="form-group">
                                                <label>Họ tên (*)</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Họ tên (*)" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" id="email"
                                                    placeholder="Email" />
                                            </div>
                                            <div class="form-group">
                                                <label>Số điện thoại (*)</label>
                                                <input type="text" class="form-control" name="phone" id="phone"
                                                    placeholder="Số điện thoại (*)" required />
                                            </div>
                                            {{-- <div class="form-group">
                                            <label>Tỉnh / Thành Phố</label>
                                            <select class="form-control" name="province" id="province">
                                                <option value="">Tỉnh / Thành Phố</option>
                                            </select>
                                        </div> --}}
                                            {{-- <div class="form-group">
                                            <label>Quận / Huyện</label>
                                            <select class="form-control" name="district" id="district">
                                                <option value="">Quận / Huyện</option>
                                            </select>
                                        </div> --}}
                                            {{-- <div class="form-group">
                                            <label>Phường / Xã</label>
                                            <select class="form-control" name="ward" id="ward">
                                                <option value="">Phường / Xã</option>
                                            </select>
                                        </div> --}}
                                            <div class="form-group">
                                                <label>Địa chỉ</label>
                                                <textarea style="max-width: 100%" class="form-control" name="address" id="address" placeholder="Địa chỉ"></textarea>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <label>Ghi chú:</label>
                                            <textarea style="max-width: 100%" class="form-control" name="note" id="note" placeholder="Ghi chú"></textarea>
                                        </div>
                                        <fieldset class="func-collapse ship-address" id="shipping-same">
                                            <input id="same-as-billing" type="checkbox" bs-type="checkbox"
                                                name="has_saddress" value="1" />
                                            <label for="same-as-billing">Giao hàng tới địa chỉ khác</label>
                                        </fieldset>
                                        <fieldset class="default-form addr-form" id="fieldset-shipping"
                                            style="display: none;">
                                            <legend class="text-semibold">Thông tin người nhận</legend>
                                            <div class="form-group">
                                                <label>Họ tên (*)</label>
                                                <input type="text" class="form-control" name="sname" id="sname"
                                                    placeholder="Họ tên" disabled required />
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="semail" id="semail"
                                                    placeholder="Email" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Số điện thoại (*)</label>
                                                <input type="number" class="form-control" name="sphone" id="sphone"
                                                    placeholder="Số điện thoại" disabled required />
                                            </div>
                                            <div class="form-group">
                                                <label>Tỉnh / Thành Phố</label>
                                                <div class="wrap-select f-size-medium relative">
                                                    <select name="sprovince" id="sprovince" class="form-control" disabled>
                                                        <option value="">Tỉnh / Thành Phố</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Quận / Huyện</label>
                                                <div class="wrap-select f-size-medium relative">
                                                    <select name="sdistrict" id="sdistrict" class="form-control"
                                                        disabled>
                                                        <option value="">Quận / Huyện</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Phường / Xã</label>
                                                <div class="wrap-select f-size-medium relative">
                                                    <select name="sward" id="sward" class="form-control" disabled>
                                                        <option value="">Phường / Xã</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Địa chỉ</label>
                                                <textarea style="max-width: 100%" name="saddress" id="saddress" class="form-control" placeholder="Địa chỉ"
                                                    disabled></textarea>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="default-form addr-form" id="method-shipping">
                                            <legend class="text-semibold">Phương thức giao hàng</legend>
                                            <div class="form-group">
                                                <ul class="ship_methods">
                                                    <li class="ship_method_bacs">
                                                        <input id="ship_1" type="radio" name="method_id"
                                                            value="Nhận hàng tại kho" data-title="Nhận hàng tại kho"
                                                            checked>
                                                        <label for="ship_1" class="wb-text15">Nhận hàng tại kho
                                                        </label>
                                                        

                                                    </li>
                                                    <li class="ship_method_bacs">
                                                        <input id="ship_2" type="radio" name="method_id"
                                                            value="Giao hàng" data-title="Giao hàng">
                                                        <label for="ship_2" class="wb-text15">Giao hàng
                                                        </label>

                                                    </li>
                                                </ul>
                                            </div>
                                        </fieldset>
                                        <fieldset class="default-form addr-form" id="method-payment">
                                            <legend class="text-semibold">Phương thức thanh toán</legend>
                                            <div class="form-group">
                                                <ul class="payment_methods">
                                                    <li class="payment_method_bacs">
                                                        <input id="payment0" type="radio" name="payment"
                                                            value="1" data-title="Thu tiền tận nơi - COD" checked>
                                                        <label for="payment0" class="wb-text15">Thu tiền tận nơi - COD
                                                        </label>
                                                        <span class="pull-right">
                                                            <i class="fa fa-money" aria-hidden="true"></i>
                                                        </span>
                                                        <div id="payment_1" class="payment_description">
                                                            <em class="wb-text13">Chúng tôi giao hàng và thu tiền tận nơi
                                                                của
                                                                bạn.</em>
                                                        </div>
                                                    </li>
                                                    <li class="payment_method_bacs">
                                                        <input id="payment1" type="radio" name="payment"
                                                            value="2" data-title="Chuyển khoản qua ngân hàng">
                                                        <label for="payment1" class="wb-text15">Chuyển khoản qua ngân hàng
                                                        </label>
                                                        <span class="pull-right">
                                                            <i class="fa fa-money" aria-hidden="true"></i>
                                                        </span>
                                                        <div id="payment_2" class="payment_description" hidden>
                                                            <em class="wb-text13">Bạn chuyển khoản qua các ngân hàng dưới
                                                                đây,
                                                                nội dung chuyển khoản: tên - số điện thoại - mã đơn hàng.
                                                                Ngân hàng Vietcombank - số tài khoản 01010101010 - chi nhánh
                                                                Hồ
                                                                Chí Minh.</em>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset title="3" class="confirm_order" style="display: none;">
                                <legend class="text-semibold">Xác nhận</legend>
                                <div class="row" title="">
                                    <div class="col-md-6">
                                        <fieldset class="default-form">
                                            <legend class="text-semibold">Thông tin người mua</legend>
                                            <div class="form-group">
                                                <label>Họ tên: </label> <span class="name"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Email: </label> <span class="email"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Số điện thoại: </label> <span class="phone"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Tỉnh / Thành Phố: </label> <span class="province"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Quận / Huyện: </label> <span class="district"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Phường/ Xã: </label> <span class="ward"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Địa chỉ: </label> <span class="address"></span>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <label>Ghi chú: </label> <span class="note"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="default-form addr-form">
                                            <legend class="text-semibold">Thông tin người nhận</legend>
                                            <div class="form-group">
                                                <label>Họ tên: </label> <span class="sname"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Email: </label> <span class="semail"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Số điện thoại: </label> <span class="sphone"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Tỉnh / Thành Phố: </label> <span class="sprovince"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Quận / Huyện: </label> <span class="sdistrict"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Phường / Xã: </label> <span class="sward"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Địa chỉ: </label> <span class="saddress"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Phương thức giao hàng: </label> <span class="sshipping"></span>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset class="cartItems">
                                            <legend class="text-semibold">Chi tiết đơn hàng</legend>
                                            <table id="cartItems" class="table">
                                                <thead>
                                                    <tr>
                                                        <th width="100px" class="text-center">Hình</th>
                                                        <th>Tên sản phẩm</th>
                                                        <th width="100px" class="text-right">Đơn giá</th>
                                                        <th width="120px">Số lượng</th>
                                                        <th width="150px" class="text-right">Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot style="font-weight: bold;">
                                                    <tr>
                                                        <td colspan="3" class="text-right">Tổng tiền</td>
                                                        <td colspan="2" class="text-right subtotal"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-right">Phí vận chuyển</td>
                                                        <td colspan="2" class="text-right shipping"></td>
                                                    </tr>
                                                    {{-- <tr>
                                                    <td colspan="3" class="text-right">Mã giảm giá</td>
                                                    <td colspan="2" class="coupon">
                                                        <div class="input-group">
                                                            <input type="text" name="coupon" id="txtCoupon"
                                                                class="form-control" placeholder="Nhập mã giảm giá">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-primary" id="btnApplyCoupon"
                                                                    type="button">Áp dụng</button>
                                                            </span>
                                                        </div>
                                                        <p id="coupon_msg"></p>
                                                    </td>
                                                </tr> --}}
                                                    <tr>
                                                        <td colspan="3" class="text-right">Giảm giá</td>
                                                        <td colspan="2" class="text-right discount">0đ</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-right">Tổng thanh toán</td>
                                                        <td colspan="2" class="text-right total"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td colspan="2" class="text-right">
                                                            <p class="payment_method" style="font-weight: normal;"></p>
                                                            <p>
                                                                <label style="font-weight: normal;" for="paid">Đã
                                                                    thanh
                                                                    toán</label>
                                                                <input id="paid" type="checkbox" bs-type="checkbox"
                                                                    name="paid" value="1" />
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </fieldset>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish">Hoàn tất <i
                                    class="icon-check position-right"></i></button>
                        </form>
                    @else
                        <p>Giỏ hàng trống</p>
                    @endif
                </div>
            </div>
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
