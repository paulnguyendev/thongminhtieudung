@php
    use App\Helpers\User;
    use App\Helpers\Obn;
@endphp
<!DOCTYPE HTML>
<html lang="vi">

<head>
    <base href="https://skills.kynaenglish.vn/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msvalidate.01" content="E04DEE146525196629F6E1FB54D0A9CD" />
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=138701140812940&autoLogAppEvents=1">
    </script>
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="TUxpb3Q5Z0oYLTkWGwEEfQUjNhcefTgNCxNbOgF7MGcnexhZBw4AMA==">
    <title>Thanh toán</title>
    <meta name="keywords" content="Kyna.vn, kina, Kyna, lớp đào tạo trực tuyến, khóa học online">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="icon" href="/favo_ico.png">
    <link rel=preconnect href="https://script.hotjar.com">
    <link rel=preconnect href="https://pro.fontawesome.com">
    <link rel=preconnect href="https://scontent-xsp1-2.xx.fbcdn.net">
    <link rel=preconnect href="https://webchat.caresoft.vn:8090">
    <link rel=preconnect href="https://apis.google.com">
    <meta name="google-site-verification" content="IXZ0pX_bDQZC3gSDnb7AfY6x2Xkj3ta63mrnNqq3VGQ">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/style.css?v=15217955218005" rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/media.css?v=15217955218005" rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/owl.carousel.css?v=15217955218005"
        rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/owl.theme.css?v=15217955218005" rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/owl.transitions.css?v=15217955218005"
        rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/jquery.sidr.dark.css?v=15217955218005"
        rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/custom.css?v=15217955218005" rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/payoo/jquery.fancybox.css?v=15217955218005"
        rel="stylesheet">
    <link type="text/css" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;900&amp;display=swap"
        rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/video/videojs.min.css?v=15217955218005"
        rel="stylesheet">
    <link type="text/css" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css" rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/slick-theme.min.css?v=15217955218005"
        rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/slick.min.css?v=15217955218005" rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/main.css?v=15217955218005" rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/app.css?v=15217955218005" rel="stylesheet">
    <link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/sweetalert2.min.css?v=15217955218005"
        rel="stylesheet">

    <style>
        .label-danger {
            white-space: normal;
        }
    </style>
    <script src="/assets/7431fa9e/jquery/dist/jquery.min.js"></script>
    <script src="/assets/35de618e/yii.js"></script>

    <link rel="stylesheet" href="https://cdn-skill.kynaenglish.vn/css/checkout.css?v=1516332748">
    <link type="text/css" href="{{ asset('kyna/css/obn.css') }}?ver={{ time() }}" rel="stylesheet">
</head>

<body>
    <div class="loading-checkout">
    </div>
    <div class="checkout" id="checkout-home">
        <div class="wrap-content">
            <div class="container">
                <ul class="clearfix wrap-main">
                    <li class="col-xs-12 wrap-content-left col">
                        <div class="checkout-header clearfix">
                            <div class="left-first col-sm-4 col-xs-6 pd0">
                                <h2 class="logo">
                                    <a href="{{ route('home/index') }}"><img src="{{ asset('kyna/img/logo.png') }}"
                                            alt="Kyna.vn" class="img-responsive" /></a>
                                </h2>
                            </div>
                            <!--end .left-first-->
                            <div class="right-first col-sm-8 col-xs-6 pd0">
                                <ul>
                                    <li>
                                        <span class="bold text-transform">Hotline</span>
                                    </li>
                                    <li>
                                        <span class="color-green bold">1900 6335 07</span>
                                    </li>
                                </ul>
                            </div>
                            <!--end .left-first-->
                        </div>
                        <!--end .checkout-header-->
                        <!-- PC -->
                        <style>
                            .checkout .checkout-list-part {
                                width: 100%;
                            }

                            .checkout .checkout-list-part li {
                                width: calc(100% / 3);
                            }

                            .checkout .checkout-list-part li .checkout-span {
                                width: 100%;
                                display: inline-block;
                                text-align: center;
                            }
                        </style>
                        <ul class="checkout-list-part pc">
                            <li>
                                <!-- <span class="checkout-triangle-left"></span> -->
                                <span class="checkout-span"><a href="{{ route('fe_cart/index') }}">Xem giỏ
                                        hàng</a></span>
                                <span class="checkout-triangle-right"></span>
                            </li>
                            <li>
                                <span class="checkout-triangle-left"></span>
                                <span class="checkout-span">Chọn cách thanh toán và điền thông tin</span>
                                <span class="checkout-triangle-right"></span>
                            </li>
                            <li>
                                <span class="checkout-triangle-left"></span>
                                <span class="checkout-span">Hoàn tất đơn hàng</span>
                            </li>
                        </ul>
                        <!-- END PC -->
                        <!-- MOBILE -->
                        <ul class="checkout-list-part mb">
                            <!-- <li>
        <span class="checkout-triangle-left"></span>
        <span class="checkout-icon-cart"></span>
        <span class="checkout-triangle-right"></span>
    </li>
    <li>
        <span class="checkout-triangle-left"></span>
        <span class="checkout-icon-order"></span>
        <span class="checkout-triangle-right"></span>
    </li>
    <li>
        <span class="checkout-triangle-left"></span>
        <span class="checkout-icon-noti"></span>
        <span class="checkout-triangle-right-last"></span>
    </li> -->
                            <li>
                                <!-- <span class="checkout-triangle-left"></span> -->
                                <span class="checkout-span">Giỏ hàng</span>
                                <span class="checkout-triangle-right"></span>
                            </li>
                            <li>
                                <span class="checkout-triangle-left"></span>
                                <span class="checkout-span">Thanh toán</span>
                                <span class="checkout-triangle-right"></span>
                            </li>
                            <li>
                                <span class="checkout-triangle-left"></span>
                                <span class="checkout-span">Hoàn tất</span>
                            </li>
                        </ul>
                        <!-- END MOBILE -->
                        <div class="checkout-wrap-content">
                            <form id="checkout-form" class="clearfix" action="{{ route('fe_cart/orderTest') }}"
                                method="POST">

                                <div class="checkout-list-check field-paymentform-method">
                                    <h3 style="margin-bottom: 0px">CHỌN PHƯƠNG THỨC THANH TOÁN</h3>
                                    <div class="payment-method-error input-error" style="padding-left: 15px"></div>
                                    <div class="wrap clearfix">
                                        {{-- <div class="checkout-list" id="checkout-cod">
                                            <input id="radio-cod" type="radio" name="PaymentForm[method]"
                                                value="cod">
                                            <label for="radio-cod">
                                                <span><span></span></span>
                                                <methodName><span>Giao mã kích hoạt và thu tiền.</span></methodName>
                                            </label>
                                            <div class="checkout-wrap-list">
                                                <div class="checkout-sub-list" id="checkout-show-cod">
                                                    Bạn cần điền đủ các thông tin mua hàng bên dưới. Sau đó, Kyna.vn sẽ
                                                    giao phong bì có chứa mã kích hoạt và thu tiền tận nơi.
                                                    <br><br>
                                                    <ul style="padding-left: 20px">
                                                        <li
                                                            style="display: list-item !important; list-style-type: disc;">
                                                            <b>MIỄN PHÍ</b> đối với các đơn hàng có giá trị <b>từ
                                                                297.000 đồng trở lên</b> (áp dụng trên toàn quốc)
                                                        </li>
                                                        <li
                                                            style="display: list-item !important; list-style-type: disc;">
                                                            Đối với những đơn hàng <b>dưới 297.000</b>, Kyna sẽ áp dụng
                                                            biểu giá của dịch vụ giao nhận như sau:<br>
                                                            - Phí giao nhận tại các quận ngoại thành Tp. Hồ Chí Minh,
                                                            ngoại thành Hà Nội: 10.000VNĐ<br>
                                                            - Phí giao nhận tại khu vực nội thành các tỉnh khác:
                                                            20.000VNĐ<br>
                                                            - Phí giao nhận tại khu vực ngoại thành tỉnh khác: 30.000VNĐ
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--end .checkout-sub-list-->
                                            </div>
                                            <!--end .checkout-wrap-list-->
                                        </div> --}}
                                        <!--end .checkout-list-->
                                        <div class="checkout-list" id="checkout-paypal">
                                            <input type="hidden" name="payment[method_title]"
                                                value="Chuyển khoản ngân hàng">
                                            <input id="radio-bank-transfer" type="radio" name="payment[method_id]"
                                                value="bank-transfer" checked>
                                            <label for="radio-bank-transfer" style="margin-bottom: 0px;">
                                                <span><span></span></span>
                                                <methodname><span>Chuyển khoản Ngân hàng</span></methodname>
                                            </label>
                                            <div class="checkout-wrap-list open" style="height: 0px;">
                                                <div class="checkout-sub-list" id="checkout-show-bank-transfer">
                                                    <h6 class="bold color-green">Khóa học sẽ được kích hoạt sau khi
                                                        RPA kiểm tra tài khoản và xác nhận việc thanh toán của bạn
                                                        thành công. (Thời gian kiểm tra và xác nhận tài khoản ít nhất là
                                                        12 giờ)</h6>
                                                    <br>
                                                    <p><b>Chuyển khoản ngân hàng</b></p>
                                                    {!! Obn::getSetting('payment_info') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end .wrap-->
                                </div>
                                <!--end .checkout-list-check-->
                                <style>
                                    label[for='paymentform-red-invoice'] {
                                        display: flex !important;
                                        align-items: flex-end;
                                        padding: 20px 0;
                                    }

                                    label[for='paymentform-red-invoice']>methodname {
                                        background-image: url(/img/checkout/invoice.png);
                                        filter: grayscale(100%);
                                        background-size: 30px;
                                    }

                                    .select2-container--default .select2-selection--single {
                                        border: none !important;
                                    }

                                    @media (min-width: 768px) {
                                        .export_invoice_register {
                                            padding-top: 20px;
                                        }

                                        .export_invoice_register p {
                                            font-size: 13px;
                                        }
                                    }
                                </style>
                                <div class="info-checkout">
                                    <h3>THÔNG TIN MUA HÀNG</h3>
                                    <div class="clearfix">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group field-paymentform-phone_number required">
                                                <fieldset>
                                                    <legend><label class="control-label"
                                                            for="paymentform-phone_number">Số điện thoại</label>
                                                        <span>*</span>
                                                    </legend>
                                                    <input type="text" id="paymentform-phone_number"
                                                        class="form-control" name="info_order[phone]"
                                                        value="{{ $createdPhone }}">
                                                </fieldset>
                                                <div class="help-block input-error"></div>
                                            </div> <button class="t-checkout-btn-otp" type="button" id="get-otp"
                                                name="get-otp" disabled="disabled">Gửi
                                                OTP</button>
                                        </div>
                                        <div id="hidden-email" class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group field-paymentform-email">
                                                    <fieldset>
                                                        <legend><label class="control-label"
                                                                for="paymentform-email">Email</label> <span>*</span>
                                                        </legend>
                                                        <input type="text" id="paymentform-email"
                                                            class="form-control" name="info_order[email]"
                                                            value="{{ $createdEmail }}">
                                                    </fieldset>
                                                    <div class="help-block input-error"></div>
                                                </div>

                                                <div class="note-email"></div>
                                            </div>
                                            {{-- <div class="col-xs-12 col-sm-6 t-checkout-otp-input">
                                                <div class="form-group field-paymentform-otp_code">
                                                    <fieldset>
                                                        <legend><label class="control-label"
                                                                for="paymentform-otp_code">Mã xác thực</label>
                                                            <span>*</span>
                                                        </legend>
                                                        <input type="text" id="paymentform-otp_code"
                                                            class="form-control" name="PaymentForm[otp_code]">
                                                    </fieldset>
                                                    <div class="help-block input-error"></div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="clearfix" id="phone_login_error"></div>
                                    <div class="clearfix">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group field-paymentform-contact_name required">
                                                <fieldset>
                                                    <legend><label class="control-label"
                                                            for="paymentform-contact_name">Họ tên</label>
                                                        <span>*</span>
                                                    </legend>
                                                    <input type="text" id="paymentform-contact_name"
                                                        class="form-control" name="info_order[fullname]"
                                                        value="{{ $createdFullname }}">
                                                </fieldset>
                                                <div class="help-block input-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group field-paymentform-street_address">
                                                <fieldset>
                                                    <legend><label class="control-label"
                                                            for="paymentform-street_address">Địa chỉ</label>
                                                        <span>*</span>
                                                    </legend>
                                                    <input type="text" id="paymentform-street_address"
                                                        class="form-control" name="info_order[address]">
                                                </fieldset>
                                                <div class="help-block input-error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-xs-12">
                                            <div class="form-group field-note">
                                                <fieldset>
                                                    <legend><label class="control-label" for="note">Ghi
                                                            chú</label></legend>
                                                    <textarea id="note" class="form-control" name="note" rows="3"></textarea>
                                                </fieldset>
                                                <div class="help-block input-error"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-6 col-sm-6 checkout-list checkout-invoice">
                                        <input id="paymentform-red-invoice" type="checkbox"
                                            name="PaymentForm[red_invoice]" value="true">
                                        <label for="paymentform-red-invoice">
                                            <span><span></span></span>
                                            <methodname><span>Xuất hoá đơn</span></methodname>
                                        </label>
                                    </div>
                                    <div class="col-6 col-sm-6 export_invoice_register">
                                        <p>Kể từ ngày 15/12/2021, Công Ty TNHH Nguồn Lực Việt bắt đầu quá trình chuyển
                                            đổi sử dụng hóa đơn điện tử theo Nghị định 123/2020/NĐ-CP, Thông tư
                                            78/2021/TT-BTC, quý khách hàng nếu có nhu cầu xuất hóa đơn vui lòng cung cấp
                                            đầy đủ thông tin tại thời điểm tạo đơn hàng (bằng cách tick chọn Xuất hóa
                                            đơn). Công ty không hỗ trợ xuất hóa đơn/bổ sung/thay đổi thông tin xuất hóa
                                            đơn sau khi đơn hàng đã được tạo.</p>
                                    </div>
                                </div>
                                <div class="info-checkout red-invoice" style="display: none">
                                    <h3>THÔNG TIN XUẤT HOÁ ĐƠN</h3>
                                    <div class="clearfix">
                                        <div class="col-xs-12 col-sm-6" visible-input="red-invoce">
                                            <div class="form-group field-paymentform-red_invoice_name">
                                                <fieldset>
                                                    <legend><label class="control-label"
                                                            for="paymentform-red_invoice_name">Tên cá nhân xuất hoá
                                                            đơn</label> <span>*</span></legend>
                                                    <input type="text" id="paymentform-red_invoice_name"
                                                        class="form-control" name="PaymentForm[red_invoice_name]">
                                                </fieldset>
                                                <div class="help-block input-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6" visible-input="red-invoce">
                                            <div class="form-group field-paymentform-company_name">
                                                <fieldset>
                                                    <legend><label class="control-label"
                                                            for="paymentform-company_name">Tên Công ty</label>
                                                        <span>*</span>
                                                    </legend>
                                                    <input type="text" id="paymentform-company_name"
                                                        class="form-control" name="PaymentForm[company_name]">
                                                </fieldset>
                                                <div class="help-block input-error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-xs-12 col-sm-12" visible-input="red-invoce">
                                            <div class="form-group field-paymentform-tax_number">
                                                <fieldset>
                                                    <legend><label class="control-label"
                                                            for="paymentform-tax_number">Mã số thuế</label>
                                                        <span>*</span>
                                                    </legend>
                                                    <input type="string" id="paymentform-tax_number"
                                                        class="form-control" name="PaymentForm[tax_number]"
                                                        maxlength="14" minlength>
                                                </fieldset>
                                                <div class="help-block input-error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-xs-12 col-sm-12" visible-input="red-invoce">
                                            <div class="form-group field-paymentform-red_invoice_address">
                                                <fieldset>
                                                    <legend><label class="control-label"
                                                            for="paymentform-red_invoice_address">Địa chỉ xuất hoá
                                                            đơn</label> <span>*</span></legend>
                                                    <textarea id="paymentform-red_invoice_address" class="form-control" name="PaymentForm[red_invoice_address]"
                                                        rows="2" placeholder="ví dụ: 11 Đoàn Văn Bơ, Phường 12, Quận 4, Thành phố Hồ Chí Minh"></textarea>
                                                </fieldset>
                                                <div class="help-block input-error"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <script>
                                    $(".checkout-list-check input").change(function() {
                                        if ($("input#radio-cod").prop("checked")) {
                                            $("#checkout-form").addClass("show-otp")
                                            $("#checkout-form").removeClass("hide-otp")
                                        } else {
                                            $("#checkout-form").removeClass("show-otp")
                                            $("#checkout-form").addClass("hide-otp")
                                        }
                                    });
                                    $("#paymentform-register_by_phone").change(function() {
                                        if ($("input#paymentform-register_by_phone").prop("checked")) {
                                            $(".info-checkout").addClass("show-otp-input");
                                            $(".note-email").html('');
                                            $('[for-id=\"email\"]').html($("#paymentform-phone_number").val());
                                        } else {
                                            $(".info-checkout").removeClass("show-otp-input");
                                            $('[for-id=\"email\"]').html($("#paymentform-email").val());
                                        }
                                    });
                                </script>
                                <div class="detail-method-pay">
                                    <div class="clearfix" data-render="checkout-show-mobile-card">
                                        <br>
                                        <h3>NẠP THẺ CÀO</h3>
                                        <div class="wrap-card-mobile">
                                            <div class="box">
                                                <div class="tit">Bạn đã nạp thành công: 0 thẻ </div>
                                                <div class="row">
                                                    <div class="left col-xs-7 col-md-8">Số tiền cần thanh toán:</div>
                                                    <div class="right col-xs-5 col-md-4">199.000 ₫</div>
                                                    <div class="left col-xs-7 col-md-8">Số tiền đã nạp:</div>
                                                    <div class="right col-xs-5 col-md-4">0 ₫</div>
                                                    <div class="left col-xs-7 col-md-8">Số tiền cần nạp thêm:</div>
                                                    <div class="right col-xs-5 col-md-4">199.000 ₫</div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="input-group checkout-radio-card field-paymentform-servicecode">
                                            <ul>
                                                <li>
                                                    <input id="radio-mobile-card-type-viettel" type="radio"
                                                        name="PaymentForm[serviceCode]" value="VTT">
                                                    <label
                                                        for="radio-mobile-card-type-viettel"><span><span></span></span>
                                                        <name>Viettel</name>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input id="radio-mobile-card-type-mobi" type="radio"
                                                        name="PaymentForm[serviceCode]" value="VMS">
                                                    <label for="radio-mobile-card-type-mobi"><span><span></span></span>
                                                        <name>Mobiphone</name>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input id="radio-mobile-card-type-vina" type="radio"
                                                        name="PaymentForm[serviceCode]" value="VNP">
                                                    <label for="radio-mobile-card-type-vina"><span><span></span></span>
                                                        <name>Vinaphone</name>
                                                    </label>
                                                </li>
                                            </ul>
                                            <div class="help-block input-error" style="padding-left: 15px;"></div>
                                        </div>

                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $('.see-history').on('click', function(e) {
                                        e.preventDefault();
                                        $('.history-card').toggleClass('open');
                                        if ($('.history-card').hasClass('open')) {
                                            $('.history-card').height($('.history-card ul').height());
                                        } else {
                                            $('.history-card').height(0);
                                        }
                                    })
                                </script>
                                <!-- Login section -->
                                @if (!request()->session()->has('userInfo'))
                                    <div class="login-for-guest">
                                        <div class="box-login-for-guest">
                                            <div class="title">Nếu bạn đã từng mua khóa học và có tài khoản ở RPA, bạn
                                                có thể đăng nhập để không phải nhập lại thông tin cá nhân</div>
                                            <a class="btn btn-login-account-kyna"
                                                href="{{ route('auth/login', ['redirect_url' => route('fe_cart/checkout')]) }}">Đăng
                                                nhập ngay</a>
                                        </div>
                                    </div>
                                @endif

                                <div class="wrap-checkout-button-pc">
                                    <div class="container">
                                        <div class="clearfix">
                                            <div class="item">
                                                <span>Phương thức thanh toán</span><br>
                                                <span>
                                                    <b for-id="method">
                                                    </b>
                                                </span>
                                            </div>
                                            <div class="item">
                                                <span>Tổng số tiền thanh toán</span><br>
                                                <span><b> {{ $cartTotal }}</b></span>
                                            </div>
                                            <div class="item">
                                                <span>Tài khoản</span><br>
                                                <span><b for-id="email"></b></span>
                                            </div>
                                            <div class="button">
                                                <div class="tool-tip">Chọn phương thức thanh toán và điền các thông tin
                                                    để "Hoàn tất đơn hàng"</div>
                                                <button class="checkout-button"><b>HOÀN TẤT ĐƠN HÀNG</b></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="total" value="{{ $totalOrder }}">
                                <input type="hidden" name="is_affiliate" value="{{ $is_affiliate }}">
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                <input type="hidden" name="created_by" value="{{ $created_by }}">
                                <input type="hidden" name="payment[status]" value="0">
                            </form>
                            <style type="text/css">
                                #checkout-mastercard label {
                                    background: url(../img/checkout/logo-visa-master.png) no-repeat top calc(50% + 7px) right 20px;
                                }

                                #checkout-paygate label {
                                    background: url(../img/checkout/logo-visa-master.png) no-repeat top calc(50% + 7px) right 20px;
                                }

                                @media(max-width: 1199px) and (min-width:768px) {

                                    #checkout-home.checkout input[type=checkbox]:not(old)+label>span,
                                    .checkout input[type=radio]:not(old)+label>span {
                                        position: relative;
                                        top: -5px;
                                    }
                                }

                                @media(max-width:1199px) {

                                    #checkout-mastercard label,
                                    #checkout-paygate label {
                                        background: none;
                                    }
                                }

                                #checkout-home.checkout input[type=checkbox]:not(old)+label>span,
                                .checkout input[type=radio]:not(old)+label>span {
                                    vertical-align: initial;
                                }

                                #checkout-home.checkout div.checkout-list label methodname span {
                                    position: absolute;
                                    top: 50%;
                                    transform: translateY(-50%);
                                }

                                #checkout-home.checkout div.checkout-list label methodname {
                                    position: relative;
                                }
                            </style>
                            <script>
                                function Copyvoucher() {
                                    var copyText = document.getElementById("showvoucher");
                                    copyText.select();
                                    document.execCommand("copy");
                                }
                            </script>
                            <style>
                                #modalvoucher .modal-body {
                                    background-image: url("https://cdn-skill.kynaenglish.vn/img/voucher-free/bg-popup-voucher-free.png");
                                    background-position: top;
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    text-align: center;
                                    padding: 20px 40px;
                                    color: #ffffff;
                                }

                                #modalvoucher .modal-body .title {
                                    margin-bottom: 15px;
                                }

                                #modalvoucher .modal-body .title-sp {
                                    display: none;
                                }

                                #modalvoucher .modal-body .copy-voucher p {
                                    padding-bottom: 10px;
                                    font-weight: 700;
                                    font-size: 15px;
                                    margin-bottom: 0;
                                }

                                #modalvoucher .modal-body .copy-voucher input {
                                    width: 182px;
                                    height: 35px;
                                    padding: 5px 10px;
                                    font-weight: 700;
                                    color: #000000;
                                    font-size: 15px;
                                    border: none;
                                    outline: none;
                                    border-radius: 5px 0 0 5px;
                                }

                                #modalvoucher .modal-body .copy-voucher a {
                                    background-color: #ffe800;
                                    color: #000000;
                                    font-size: 12px;
                                    font-weight: 700;
                                    padding: 12px 12px 9px;
                                    position: relative;
                                    left: -4px;
                                    border-radius: 0 5px 5px 0;
                                }

                                #modalvoucher .modal-body .copy-voucher a:active {
                                    background-color: #e5d000;
                                }

                                #modalvoucher .modal-body ul {
                                    text-align: left;
                                    padding: 15px 0 0 0;
                                    font-size: 14px;
                                    line-height: 1.4;
                                    margin-bottom: 20px;
                                }

                                #modalvoucher .modal-body ul li {
                                    padding-bottom: 8px;
                                    position: relative;
                                    text-align: justify;
                                    display: block;
                                    vertical-align: initial;
                                }

                                #modalvoucher .modal-body ul li:before {
                                    content: '\f0da';
                                    font-family: FontAwesome;
                                    position: absolute;
                                    left: -10px;
                                }

                                #modalvoucher .modal-body .fb-share {
                                    border: 1px solid #ffffff;
                                    padding: 10px 20px;
                                    font-size: 15px;
                                    font-weight: 700;
                                    border-radius: 30px;
                                    color: #ffffff;
                                    margin-bottom: 15px;
                                }

                                #modalvoucher .modal-body .fb-share:before {
                                    content: '\f09a';
                                    font-family: FontAwesome;
                                    margin-right: 8px;
                                }

                                #modalvoucher .modal-body .lp-voucher {
                                    margin: 20px 0 0 0;
                                }

                                #modalvoucher .modal-body .lp-voucher .lp-link {
                                    border-bottom: 1px solid #ffffff;
                                    font-weight: 700;
                                    font-size: 15px;
                                    color: #ffffff;
                                }

                                #modalvoucher button {
                                    position: absolute;
                                    right: -20px;
                                    top: -20px;
                                    padding: 0px 10px;
                                    border-radius: 50%;
                                    background: white;
                                    z-index: 1;
                                    opacity: 1;
                                }

                                #modalvoucher button span {
                                    font-size: 40px;
                                    font-weight: 400;
                                    color: grey;
                                }

                                #modalvoucher .modal-footer {
                                    padding: 18px;
                                    text-align: center;
                                    background-color: #dd4f1b;
                                    border-top: none;
                                    color: #ffffff;
                                }

                                #modalvoucher .modal-footer p {
                                    font-size: 15px;
                                    line-height: 1.4;
                                    margin-bottom: 0;
                                }

                                #modalvoucher .modal-footer p br {
                                    display: none;
                                }

                                #modalvoucher .modal-footer p span {
                                    font-weight: 700;
                                }

                                @media screen and (max-width: 425px) {
                                    #modalvoucher .modal-body .title-sp {
                                        display: block;
                                        margin: 0 auto;
                                        margin-bottom: 15px;
                                    }

                                    #modalvoucher .modal-body .title {
                                        display: none;
                                    }

                                    #modalvoucher .modal-body {
                                        padding: 20px;
                                    }

                                    #modalvoucher .modal-body .copy-voucher input {
                                        width: 154px;
                                    }

                                    #modalvoucher .modal-footer p br {
                                        display: block;
                                    }
                                }
                            </style>
                        </div>
                        <div class="wrap-content-right">
                            <div class="fixed-flag"></div>
                            <div class="wrap">
                                <h4>
                                    <img src="https://cdn-skill.kynaenglish.vn/img/icon-mini-cart.png" alt="">
                                    <b><span class="color-green">{{ $cartCount }} khóa học</span></b>
                                    <a href="{{ route('fe_cart/index') }}">Thay đổi</a>
                                </h4>
                                <ul class="list">
                                    @foreach ($cartContent as $cartItem)
                                        @php
                                            $cartItemPrice = Obn::showPrice($cartItem->price);
                                        @endphp
                                        <li class="clearfix" data-id="1954" data-price="199000"
                                            data-course-type="1">
                                            <div class="col-sm-9 col-xs-8 title pd0 text">
                                                <h6>{{ $cartItem->name ?? '-' }}</h6>
                                            </div>
                                            <!--end .col-xs-2 col-xs-4 name-->
                                            <div class="col-sm-3 col-xs-4 price pd0">
                                                <span><b>
                                                        {{ $cartItemPrice }} </b></span>
                                            </div>
                                            <!--end .col-md-10 col-xs-8 price-->
                                        </li>
                                    @endforeach
                                </ul>
                                {{-- <div class="checkout-apdung clearfix">
                                    <p>Mã khuyến mãi (nhập mã và click Áp dụng)</p>
                                    <form id="promo-code-form" class="clearfix" action="/cart/promo/apply"
                                        method="post">
                                        <input type="hidden" name="_csrf"
                                            value="TUxpb3Q5Z0oYLTkWGwEEfQUjNhcefTgNCxNbOgF7MGcnexhZBw4AMA==">
                                        <div class="form-group input-code field-promocodeform-code required">
                                            <input type="text" id="promocodeform-code" class="text form-control"
                                                name="PromoCodeForm[code]" placeholder="Nhập mã khuyến mãi">
                                            <p class="help-block help-block-error"></p>
                                        </div>
                                        <div class="button-submit">
                                            <button type="submit" class="btn-send-apdung" onclick="return true;">Áp
                                                dụng</button>
                                        </div>
                                        <!--end .button-popup-->
                                        <div class="clearfix"></div>
                                        <div class="error-label">
                                        </div>
                                    </form>
                                </div> --}}
                                <!--end checkout-apdung-->
                                <script type="text/javascript"></script>
                                <style>
                                    .voucher-free-link li {
                                        display: inline;
                                        margin-right: 13px;
                                    }

                                    .voucher-free-link a {
                                        font-size: 12px;
                                        text-decoration: underline !important;
                                    }
                                </style>
                                <div class="checkout-list-price">
                                    <ul>
                                        {{-- <li>
                                            <span>Học phí gốc</span>
                                            <span class="price total-cost" data-price="199000"><b>199.000 ₫</b></span>
                                        </li> --}}
                                        @if ($discount > 0)
                                            <li>
                                                <span>Tổng giảm giá</span>
                                                <span class="price"><b> {{ $discount }}</b></span>
                                            </li>
                                        @endif

                                        <li>
                                            <span class="color-orange"><b>THÀNH TIỀN</b></span>
                                            <span class="price total-price color-orange"><b>
                                                    {{ $cartTotal }}</b></span>

                                        </li>
                                    </ul>
                                    <div class="note-cod"><b>Lưu ý:</b> <i>Chưa bao gồm phí vận chuyển</i></div>
                                </div>
                                <!--end .checkout-list-price-->
                            </div>
                            <!--end .wrap-->
                            <div class="re-money">
                                <div class="banner-widget promotion" id="promotion" data-banner-type="8">
                                    <a href="{{route('home/index')}}" title="thien-va-quan-tri-cam-xuc" target="_blank">
                                        <img class="image-topbar banner-pc img-fluid"
                                            src="{{ asset('kyna/img/banner-sidebar.jpg') }}" size="0x0"
                                            alt="thien-va-quan-tri-cam-xuc" title="thien-va-quan-tri-cam-xuc"
                                            resizeMode="cover" returnMode="img">
                                        <img class="image-topbar banner-mb img-fluid"
                                            src="{{ asset('kyna/img/banner-sidebar.jpg') }}" size="0x0"
                                            alt="thien-va-quan-tri-cam-xuc" title="thien-va-quan-tri-cam-xuc"
                                            resizeMode="cover" returnMode="img">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--end .col-md-5 col-xs-12 wrap-content-right pd0-mb-->
                    </li>
                    <li class="col-lg-7 col-xs-12 wrap-checkout-button-mb col">
                        <div class="wrap-checkout-button">
                            <a class="checkout-button back-to-cart" href="{{ route('fe_cart/index') }}"><i
                                    class="fa fa-long-arrow-left" aria-hidden="true"></i> Quay lại</a>
                            <button class="checkout-button-mb">Hoàn tất</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!--end .wrap-content-->
    </div>
    <!-- POPUP REGISTER -->
    <div class="modal fade k-popup-account" id="k-popup-account-register" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
    </div>
    <!-- END POPUP REGISTER -->
    <div class="modal fade k-popup-account" id="k-popup-account-login" tabindex="-1" role="dialog">
    </div>
    <div class="modal fade k-popup-account" id="k-popup-account-reset" tabindex="-1" role="dialog">
    </div>
    <div class="modal fade k-popup-account" id="k-popup-account-otp-reset" tabindex="-1" role="dialog">
    </div>
    <div class="modal fade k-popup-account" id="k-popup-account-otp-reset" tabindex="-1" role="dialog">
    </div>
    <script src="/assets/35de618e/yii.validation.js"></script>
    <script src="/assets/35de618e/yii.activeForm.js"></script>
    <script src="https://cdn-skill.kynaenglish.vn/src/js/tether.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/src/js/bootstrap.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/src/js/owl.carousel.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/src/js/iscroll.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/src/js/main.js?v=1568114107"></script>
    <script src="https://cdn-skill.kynaenglish.vn/src/js/details.js?v=1562727394"></script>
    <script src="https://cdn-skill.kynaenglish.vn/src/js/ajax-caller.js?v=31073108"></script>
    <script src="https://cdn-skill.kynaenglish.vn/src/js/js_cookie.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/src/js/courses.js?v=1562727394"></script>
    <script src="https://cdn-skill.kynaenglish.vn/src/js/offpage.js?version=1562727393"></script>
    <script src="https://cdn-skill.kynaenglish.vn/js/script-main.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/js/payoo/jquery.fancybox.pack.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/js/video/videojs.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/js/video/videojs-http-streaming.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/js/video/videojs-playlist.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/js/slick/slick.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/js/jquery.lazy.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/js/jquery.lazy.plugins.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/js/sweetalert2.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/dist/js/app.min.js?v=15217955218005"></script>
    <script src="https://cdn-skill.kynaenglish.vn/dist/js/header.min.js?v=15217955218005"></script>
    <script src="/assets/7431fa9e/remarkable-bootstrap-notify/bootstrap-notify.js"></script>
    <script src="{{ asset('kyna/js/script-checkout.js') }}?ver={{ time() }}"></script>
    <script type="text/javascript">
        $('body').on('blur', '.field-paymentform-email', function() {
            var paymentMethod = $("input[name=\'PaymentForm[method]\']:radio:checked").val();
            var email = $(this).find('input').val();
            $('.note-email').html('');
            var emailElement = $(this).parents('.form-group');
            $.ajax({
                url: '/cart/checkout/validate-email',
                method: 'post',
                data: {
                    email: email,
                    paymentMethod: paymentMethod
                },
                success: function(res) {
                    if (res.result) {
                        $('[for-id="email"]').html(email);
                        $('.field-paymentform-email').removeClass('has-error').addClass('has-success');
                        $('.field-paymentform-email .help-block').html('');
                        $('.note-email').removeClass('input-error');
                        $('.note-email').show().html(res.message);
                        //$('.field-paymentform-contact_name').parent().parent().show();
                    } else {
                        $('.field-paymentform-email .input-error').addClass('input-error-2')
                            .removeClass('input-error').attr('style', 'color: red;font-style: italic;');
                        $('.field-paymentform-email').removeClass('has-success').addClass('has-error');
                        $('.field-paymentform-email .input-error-2').html(res.message);

                    }
                }
            });
        });
        // $('body').on('blur', '#paymentform-phone_number', function(e) {
        //     $('#phone_login_error').html('');
        //     $('.note-email').html('');
        //     $('#get-otp').attr("disabled", true);
        //     var phone = $(this).val();
        //     var register_by_phone = $("#paymentform-register_by_phone").val();
        //     $.ajax({
        //         url: '/cart/checkout/add-user-care',
        //         method: 'post',
        //         data: {
        //             phone: phone,
        //             register_by_phone: register_by_phone
        //         },
        //         success: function(res) {
        //             if (res.result) {
        //                 $('.note-email').removeClass('input-error');
        //                 $('.note-email').show().html(res.message);
        //                 $('.field-paymentform-phone_number').removeClass('has-error').addClass(
        //                     'has-success');
        //                 $('.field-paymentform-phone_number .help-block').html('');
        //                 $('#get-otp').prop("disabled", false);
        //             } else {
        //                 if (res.result_add_user_care == false) {
        //                     $('.field-paymentform-phone_number').removeClass('has-success').addClass(
        //                         'has-error');
        //                     $('.field-paymentform-phone_number .input-error').html(res.message);
        //                 }
        //             }
        //         }
        //     });
        // });
        $('body').on('click', '#get-otp', function(e) {
            var phone = $("#paymentform-phone_number").val();
            var register_by_phone = $("#paymentform-register_by_phone").val();
            if (register_by_phone != 1) {
                return;
            }
            $('#get-otp').attr("disabled", true);
            $.ajax({
                url: '/cart/checkout/get-otp-code',
                method: 'post',
                data: {
                    phone: phone
                },
                success: function(res) {
                    if (res.result) {
                        setTimeout(function() {
                            $('#get-otp').prop("disabled", false);
                        }, 30000);
                        $('.field-paymentform-otp_code .help-block').html('');
                    } else {
                        if (res.message) {
                            $('.field-paymentform-otp_code .input-error').html(res.message);
                        }
                        setTimeout(function() {
                            $('#get-otp').prop("disabled", false);
                        }, 30000);
                    }
                }
            });
        });
        $(document).ready(function() {
            $('#paymentform-red-invoice').click(function() {
                if ($('.red-invoice').is(":visible")) {
                    $('.red-invoice').hide();
                    $('#paymentform-red-invoice').prop("checked", false);
                } else {
                    $('.red-invoice').show();
                    $('#paymentform-red-invoice').prop("checked", true);
                    $('html,body').animate({
                        scrollTop: $('.red-invoice').offset().top
                    }, 300);
                }
            });
        });;
        (function($, window, document, undefined) {
            $(document).ready(function() {
                $('body').on('beforeSubmit', 'form#promo-code-form', function(e) {
                    e.preventDefault();
                    var form = $(this);
                    // return false if form still have some validation errors
                    if (form.find('.has-error').length) {
                        return false;
                    }
                    // submit form
                    $.ajax({
                        url: form.attr('action'),
                        type: 'post',
                        data: form.serialize(),
                        success: function(response) {
                            var obj = JSON.parse(response);
                            $('.error-label').empty();
                            var code = $('#promocodeform-code').val();
                            console.log(response);
                            if (parseInt(obj.error_code) == 0) {
                                window.location.reload();
                            } else {
                                window.location.reload();
                                // $('.error-label').append("<p class='error-mess'>* " + obj.object.code + "</p>");
                            }
                            return false;
                        }
                    });
                    return false;
                });
                //hint-kyna-code
                var code = localStorage.getItem('kyna-code-');
                var title = localStorage.getItem('kyna-title-code-');
                if (code !== '' && code !== undefined && code !== null)
                    $('.hint-kyna-code').show().html(
                        '<img src="https://cdn-skill.kynaenglish.vn/img/checkout/icon-code-voucher-coupon.png" alt=""> Nhập mã <b class="green">' +
                        code + '</b>. ' + title);
                else
                    $('.hint-kyna-code').hide();
            });
        })(window.jQuery || window.Zepto, window, document);
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#checkout-form').yiiActiveForm([{
                "id": "paymentform-email",
                "name": "email",
                "container": ".field-paymentform-email",
                "input": "#paymentform-email",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    if ((function(attribute, value) {
                            var register_by_phone = $(
                                'input[name=\'PaymentForm[register_by_phone]\']').val();
                            var method = $('input[name=\'PaymentForm[method]\']:radio:checked')
                                .val();
                            return register_by_phone != 1 || method != 'cod' || method !=
                                'bank-transfer';
                        })(attribute, value)) {
                        yii.validation.required(value, messages, {
                            "message": "Email không được để trống."
                        });
                    }
                    yii.validation.email(value, messages, {
                        "pattern": /^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,
                        "fullPattern": /^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,
                        "allowName": false,
                        "message": "Email không phải là địa chỉ email hợp lệ.",
                        "enableIDN": false,
                        "skipOnEmpty": 1
                    });
                    yii.validation.string(value, messages, {
                        "message": "Email phải là chuỗi.",
                        "max": 255,
                        "tooLong": "Email phải chứa nhiều nhất 255 ký tự.",
                        "skipOnEmpty": 1
                    });
                }
            }, {
                "id": "paymentform-otp_code",
                "name": "otp_code",
                "container": ".field-paymentform-otp_code",
                "input": "#paymentform-otp_code",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    yii.validation.required(value, messages, {
                        "message": "Vui lòng nhập mã OTP"
                    });
                }
            }, {
                "id": "paymentform-contact_name",
                "name": "contact_name",
                "container": ".field-paymentform-contact_name",
                "input": "#paymentform-contact_name",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    yii.validation.required(value, messages, {
                        "message": "Họ tên không được để trống."
                    });
                    yii.validation.string(value, messages, {
                        "message": "Họ tên phải là chuỗi.",
                        "max": 30,
                        "tooLong": "Họ tên phải chứa nhiều nhất 30 ký tự.",
                        "skipOnEmpty": 1
                    });
                }
            }, {
                "id": "paymentform-street_address",
                "name": "street_address",
                "container": ".field-paymentform-street_address",
                "input": "#paymentform-street_address",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                        "message": "Địa chỉ phải là chuỗi.",
                        "max": 255,
                        "tooLong": "Địa chỉ phải chứa nhiều nhất 255 ký tự.",
                        "skipOnEmpty": 1
                    });
                    if ((function(attribute, value) {
                            var method = $('input[name=\'PaymentForm[method]\']:radio:checked')
                                .val();
                            return method === 'cod';
                        })(attribute, value)) {
                        yii.validation.required(value, messages, {
                            "message": "Địa chỉ không được để trống."
                        });
                    }
                }
            }, {
                "id": "paymentform-note",
                "name": "note",
                "container": ".field-note",
                "input": "#note",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                        "message": "Ghi chú phải là chuỗi.",
                        "skipOnEmpty": 1
                    });
                }
            }, {
                "id": "paymentform-red_invoice_name",
                "name": "red_invoice_name",
                "container": ".field-paymentform-red_invoice_name",
                "input": "#paymentform-red_invoice_name",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    if ((function(attribute, value) {
                            return $('#paymentform-red-invoice').prop('checked');
                        })(attribute, value)) {
                        yii.validation.required(value, messages, {
                            "message": "Tên cá nhân xuất hoá đơn không được để trống."
                        });
                    }
                }
            }, {
                "id": "paymentform-company_name",
                "name": "company_name",
                "container": ".field-paymentform-company_name",
                "input": "#paymentform-company_name",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    if ((function(attribute, value) {
                            return $('#paymentform-red-invoice').prop('checked');
                        })(attribute, value)) {
                        yii.validation.required(value, messages, {
                            "message": "Tên Công ty không được để trống."
                        });
                    }
                }
            }, {
                "id": "paymentform-tax_number",
                "name": "tax_number",
                "container": ".field-paymentform-tax_number",
                "input": "#paymentform-tax_number",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    if ((function(attribute, value) {
                            return $('#paymentform-red-invoice').prop('checked');
                        })(attribute, value)) {
                        yii.validation.required(value, messages, {
                            "message": "Mã số thuế không được để trống."
                        });
                    }
                    if ((function(attribute, value) {
                            return $('#paymentform-red-invoice').prop('checked');
                        })(attribute, value)) {
                        yii.validation.string(value, messages, {
                            "message": "Mã số thuế phải là chuỗi.",
                            "min": 10,
                            "tooShort": "Mã số thuế phải chứa ít nhất 10 ký tự.",
                            "max": 14,
                            "tooLong": "Mã số thuế phải chứa nhiều nhất 14 ký tự.",
                            "skipOnEmpty": 1
                        });
                    }
                    if ((function(attribute, value) {
                            return $('#paymentform-red-invoice').prop('checked');
                        })(attribute, value)) {
                        yii.validation.regularExpression(value, messages, {
                            "pattern": /^[0-9\-]{10,14}$/,
                            "not": false,
                            "message": "Mã số thuế không đúng định dạng.",
                            "skipOnEmpty": 1
                        });
                    }
                }
            }, {
                "id": "paymentform-red_invoice_address",
                "name": "red_invoice_address",
                "container": ".field-paymentform-red_invoice_address",
                "input": "#paymentform-red_invoice_address",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    if ((function(attribute, value) {
                            return $('#paymentform-red-invoice').prop('checked');
                        })(attribute, value)) {
                        yii.validation.required(value, messages, {
                            "message": "Địa chỉ xuất hoá đơn không được để trống."
                        });
                    }
                }
            }, {
                "id": "paymentform-pincode",
                "name": "pinCode",
                "container": ".field-paymentform-pincode",
                "input": "#paymentform-pincode",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    if ((function(attribute, value) {
                            var method = $('input[name=\'PaymentForm[method]\']:radio:checked')
                                .val();
                            return (method === 'epay' || method === 'ipay');
                        })(attribute, value)) {
                        yii.validation.required(value, messages, {
                            "message": "Mã thẻ cào không được để trống."
                        });
                    }
                }
            }, {
                "id": "paymentform-serial",
                "name": "serial",
                "container": ".field-paymentform-serial",
                "input": "#paymentform-serial",
                "error": ".help-block.input-error",
                "encodeError": false,
                "validate": function(attribute, value, messages, deferred, $form) {
                    if ((function(attribute, value) {
                            var method = $('input[name=\'PaymentForm[method]\']:radio:checked')
                                .val();
                            return (method === 'epay' || method === 'ipay');
                        })(attribute, value)) {
                        yii.validation.required(value, messages, {
                            "message": "Số seri thẻ không được để trống."
                        });
                    }
                }
            }], []);
            jQuery('#promo-code-form').yiiActiveForm([], []);
        });
    </script>
</body>

</html>
