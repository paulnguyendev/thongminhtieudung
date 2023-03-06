@php
    use App\Helpers\Obn;
@endphp
@extends('user.main')
@section('title', 'Chi tiết đơn hàng')
@section('navbar_title', 'Chi tiết đơn hàng')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-flat" id="orderDetailPanel" data-id="{{ $id }}"
                data-route-update="{{ route('admin_order/save', ['id' => $id]) }}" data-address="12521525"
                data-receiver-name="125" data-receiver-phone="125125" data-receiver-email="125@gmail.com"
                data-amount="13300" data-code="{{ $item['code'] ?? '' }}">
                <div class="panel-heading">
                    <h4 class="panel-title">Chi tiết đơn hàng <a style="color: #1E88E5">#{{ $item['code'] ?? "-" }}</a></h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="10px"></th>
                                    <th>Sản phẩm</th>
                                    <th width="10px">SL</th>
                                    <th width="120px" class="text-right">Giá</th>
                                    <th width="160px" class="text-right">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($products) > 0)
                                    @foreach ($products as $product)
                                        @php
                                            $currency = ' đ';
                                            $price = $product['price'] ?? 0;
                                            $quantity = $product['quantity'] ?? 0;
                                            $subTotal = $price * $quantity;
                                            $price = number_format($price) . $currency;
                                            $subTotal = number_format($subTotal) . $currency;
                                           $thumbnail = Obn::showThumbnail($product['thumbnail']);
                                        @endphp
                                        <tr>
                                            <td class="text-center" style="padding: 5px;">
                                                <img src="{{ $thumbnail }}" class="img-lg">
                                            </td>
                                            <td class="order-product-name" data-quantity="1">
                                                <div class="media-left" style="padding-right:0px">
                                                    <div>
                                                        <a class="text-default text-semibold">
                                                            {!! $product['name'] !!}
                                                        </a>
                                                    </div>
                                                    <div class="text-muted text-size-small">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $product['quantity'] ?? 0 }}</td>
                                            <td class="text-right">{{ $price }}</td>
                                            <td class="text-right">{{ $subTotal }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right" colspan="4">Thành tiền</td>
                                    <td class="text-right">{{ number_format($item['total'] ?? 0) . ' đ' ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="4">
                                        Phí Ship
                                    </td>
                                    <td class="text-right"> {{ Obn::showPrice($shippingFee) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="4">
                                        <p style="padding: 3px 0; margin-bottom: 0;">
                                          Giảm giá
                                        </p>
                                    </td>
                                    <td class="text-right" style="vertical-align: text-top;">
                                        {{ Obn::showPrice($item['discount'] ?? 0 ) }}
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td class="text-right" colspan="4">
                                        <a href="javascript:void(0);" data-popup="popover-tax" aria-describedby="popovertax"
                                            data-tax="0" data-id="2"
                                            data-url="http://anhnnd.s1.loveitop.com/admin/order/2" data-original-title=""
                                            title="">
                                            Thêm thuế GTGT
                                        </a>
                                    </td>
                                    <td class="text-right">
                                    </td>
                                </tr> --}}
                                <tr style="background-color: beige;font-size: 18px;font-weight: bold;">
                                    <td class="text-right" colspan="4">Tổng cộng</td>
                                    <td class="text-right">{{ Obn::showPrice($orderSum) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px;" colspan="5">
                                        Khách ghi chú đơn hàng: {{ $item['note'] ?? '' }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                {{-- <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    <div class="heading-elements">
                        <a class="heading-text text-semibold" style="font-size: 25px;margin-top:0"><i
                                class="fa fa-truck fa-5" aria-hidden="true"></i></a>
                        <div class="btn-group heading-btn pull-right">
                            <button type="button" class="btn btn-success btn-delivery" data-action="modal"
                                data-toggle="modal" data-target="#delivery" data-popup="tooltip" title=""
                                data-original-title="Chuyển hàng đến nhà cung cấp vận chuyển">Giao hàng</button>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div id="delivery" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h5 class="modal-title">Giao hàng</h5>
                        </div>
                        <div class="modal-body">
                            <div class="title-select-shipping-service">
                                <div class="form-group">
                                    <label for="">Chọn dịch vụ giao hàng</label>
                                    <select id="service_shipping" class="form-control" name="type">
                                        <option value="custom">Tự giao hàng</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="shipping_service" id="custom" style="display: block;">
                                <form method="POST" action="http://anhnnd.s1.loveitop.com/admin/ship/start-delivery"
                                    accept-charset="UTF-8" class="delivery-form" enctype="multipart/form-data"><input
                                        name="_token" type="hidden" value="2Z0qF0FZBRj817VTRkUjPEnCBaTR2guKBRMbgavd">
                                    <input hidden="" name="type" value="custom">
                                    <div class="form-group">
                                        <label>Ghi chú:
                                        </label>
                                        <textarea class="form-control order-note" rows="5" name="note" cols="50"></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-sm-6 text-left">
                                                <label class="checkbox-inline">
                                                    <input hidden name="send_notification_email" value="0">
                                                    <input bs-type="checkbox" checked="checked"
                                                        name="send_notifcation_email" type="checkbox" value="1"
                                                        class="checkbox-send-mail">
                                                    Gửi email tới khách hàng
                                                </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Đóng</button>
                                                <button type="button"
                                                    class="btn btn-info btn-create-shipping-order">Gửi</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="form-group">
                        <label><strong>Trạng thái đặt hàng</strong></label>
                        <select class="form-control order_status" data-id="2" disabled>
                            <!-- <option value="0" >Chưa đặt hàng</option> -->
                            <option value="new" {{ $status == 'new' ? 'selected' : '' }}>Đơn hàng mới</option>
                            <option value="confirm" {{ $status == 'confirm' ? 'selected' : '' }}>Đã xác nhận</option>
                            <option value="shipping" {{ $status  == 'shipping' ? 'selected' : '' }}>Đang vận chuyển
                            </option>
                            <option value="complete" {{ $status == 'complete' ? 'selected' : '' }}>Hoàn tất
                            </option>
                            <option disabled="" {{ $status == 'cancel' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            <strong>Hình thức thanh toán:</strong> {{$method_title}}
                        </label>
                        <label class="checkbox-inline">
                            <input class="payment_status" data-id="2" bs-type="checkbox"
                                {{ $payment_status == 1 ? 'checked' : '' }} type="checkbox" disabled>
                            Đã thanh toán
                        </label>
                    </div>
                    <div class="form-group">
                        <label><strong>Hình thức giao hàng khách đã chọn:</strong></label>
                        <label>
                            Nhận hàng tại kho
                        </label>
                    </div>
                </div>
            </div>
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Thông tin người mua hàng<ul class="icons-list heading-elements-toggle">
                            <li><a data-action="collapse" class="rotate-180"></a></li>
                        </ul>
                    </h5>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="100">Họ tên</th>
                                    <th>{{$info_order['fullname'] ?? "-"}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Điện thoại</td>
                                    <td>{{$info_order['phone'] ?? "-"}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$info_order['email'] ?? "-"}}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>
                                        {{$info_order['address'] ?? "-"}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="buyer" class="modal fade">
                <form method="POST" action="{{route('admin_order/saveInfo',['type' => 'order','id' => $id])}}"
                    accept-charset="UTF-8" id="buyer-form" enctype="multipart/form-data">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h5 class="modal-title">Thay đổi thông tin người mua hàng</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Họ Tên
                                    </label>
                                    <input class="form-control" name="fullname" type="text" value="{{$info_order['fullname'] ?? "-"}}">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Điện thoại
                                                </label>
                                                <input class="form-control" name="phone" type="text"
                                                    value="{{$info_order['phone'] ?? "-"}}">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email
                                                </label>
                                                <input class="form-control" name="email" type="text"
                                                    value="{{$info_order['email'] ?? "-"}}">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ
                                    </label>
                                    <input class="form-control" name="address" type="text" value="{{$info_order['address'] ?? "-"}}">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-info">Gửi</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Thông tin người nhận hàng<ul class="icons-list heading-elements-toggle">
                            <li><a data-action="collapse" class="rotate-180"></a></li>
                        </ul>
                    </h5>
                   
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="100">Họ tên</th>
                                    <th>{{$info_shipping['name'] ?? "-"}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Điện thoại</td>
                                    <td>{{$info_shipping['phone'] ?? "-"}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$info_shipping['email'] ?? "-"}}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>
                                        {{$info_shipping['address'] ?? "-"}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Note</td>
                                    <td>
                                        {{$info_shipping['note'] ?? "-"}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="order_info" class="modal fade">
                <form method="POST" action="{{route('admin_order/saveInfo',['type' => 'shipping','id' => $id])}}" accept-charset="UTF-8"
                    id="order-form" enctype="multipart/form-data">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h5 class="modal-title">Thay đổi thông tin người nhận hàng</h5>
                            </div>
                            <input type="hidden" name="shipping_fee" value="0">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Họ Tên
                                    </label>
                                    <input class="form-control" name="name" type="text" value="{{$info_shipping['name'] ?? "-"}}">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Điện thoại
                                                </label>
                                                <input class="form-control" name="phone" type="text"
                                                    value="{{$info_shipping['phone'] ?? "-"}}">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email
                                                </label>
                                                <input class="form-control" name="email" type="text"
                                                    value="{{$info_shipping['email'] ?? "-"}}">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ
                                    </label>
                                    <input class="form-control" name="address" type="text" value="{{$info_shipping['address'] ?? "-"}}">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú
                                    </label>
                                    <textarea class="form-control" rows="5" name="note" cols="50">{{$info_shipping['note'] ?? ""}}</textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-info">Gửi</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div
            style="position: absolute; top: 0; bottom: 0px; left: 0; right: 0; z-index: 9999; background-color: #fff; padding: 50px 100px; display: none;">
            <div id="printDivWarranty" style="width: 100%; max-width: 900px; margin:0 auto; font-size: 90%;">
                <p>
                    <img src="https://media-demo.loveitopcdn.com/37184//l.png"
                        style="float: left; margin-right: 10px; height: 60px; max-width: 300px;margin-bottom: 30px;">
                    <strong>Minimart</strong><br>
                    Địa chỉ: 18 Trần Thiện Chánh, phường 12, quận 10&nbsp;
                    <br>
                    Email: support@webitop.com | Website: anhnnd.s1.loveitop.com<br>
                    Hotline: 1900 636 040
                </p>
                <center>
                    <h3>Phiếu Bán Hàng</h3>
                </center>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6" style="width: 100%;">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table order-info">
                                    <tbody>
                                        <tr>
                                            <th>Mã đơn hàng:</th>
                                            <td>#ORDER0001 </td>
                                        </tr>
                                        <tr>
                                            <th>Ngày mua:</th>
                                            <td>29/12/2022 07:35:53</td>
                                        </tr>
                                        <tr>
                                            <th>Trạng thái đơn hàng:</th>
                                            <td>
                                                Đơn hàng mới </td>
                                        </tr>
                                        <tr>
                                            <th>Tình trạng thanh toán:</th>
                                            <td>Đã thanh toán</td>
                                        </tr>
                                        <tr>
                                            <th>Khách hàng:</th>
                                            <td>125</td>
                                        </tr>
                                        <tr>
                                            <th>Số điện thoại:</th>
                                            <td>125125</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>125@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <th style="vertical-align: text-top;">Địa chỉ:</th>
                                            <td style="vertical-align: text-top;">
                                                12521525, Xã Phan Thanh, Huyện Bảo Lạc, Cao Bằng
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12" style="width: 100%; float: left">
                        <div class="panel panel-default" style="margin-top: -10px;">
                            Ghi chú:
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title">Chi tiết đơn hàng</h6>
                            </div>
                            <div class="panel-body">
                                <table cellspacing="0" class="table table-product">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th style="width: 100px; text-align: right;">Đơn giá</th>
                                            <th style="width: 100px; text-align: right;">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="order-product-name" data-quantity="1">
                                                <div class="media-left" style="padding-right:0px">
                                                    Rau dền đỏ sạch VinEco
                                                    <div class="text-muted text-size-small">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right">1 x 13,300 đ</td>
                                            <td class="text-right">13,300 đ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2">Thành tiền</td>
                                            <td class="text-right">13,300 đ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2">Phí ship</td>
                                            <td class="text-right">0 đ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2">
                                            </td>
                                            <td class="text-right" style="vertical-align: text-top;">
                                            </td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td class="text-right" colspan="2">Tổng cộng</td>
                                            <td class="text-right">13,300 đ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel-footer" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>
                                            <center>Người mua hàng</center>
                                        </strong>
                                        <center><i>(ký, họ tên)</i></center>
                                    </div>
                                    <div class="col-md-6 pull-right">
                                        <strong>
                                            <center>Người bán hàng</center>
                                        </strong>
                                        <center><i>(ký, họ tên)</i></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    @media print {
                        body {
                            font-family: 'Times New Roman', serif;
                        }
                        h1,
                        h6.panel-title {
                            text-transform: uppercase;
                        }
                        h6.panel-title {
                            color: #000;
                            font-weight: bold;
                            margin-bottom: 0px;
                        }
                        .col-md-6 {
                            width: 49.5%;
                            display: inline-block;
                        }
                        .panel {
                            margin-bottom: 20px;
                            border-color: #ddd;
                            color: #333;
                            background-color: #fff;
                            border: 1px solid transparent;
                            border-radius: 3px;
                        }
                        .panel-heading {
                            padding: 15px 0px 5px;
                            border-bottom: 1px solid transparent;
                            position: relative;
                            border-top-right-radius: 3px;
                            border-top-left-radius: 3px;
                        }
                        .panel-default>.panel-heading {
                            color: #333;
                            background-color: #fcfcfc;
                        }
                        .panel-title {
                            margin-top: 0;
                            margin-bottom: 0;
                            font-size: 93%;
                            position: relative;
                            font-weight: 470;
                        }
                        .panel-body {
                            padding: 0;
                        }
                        .text-right {
                            text-align: right;
                        }
                        table {
                            width: 100%
                        }
                        table tr th {
                            width: 110px;
                            text-align: left;
                            font-weight: 470;
                        }
                        table tbody tr th {
                            padding: 0;
                        }
                        table tr th,
                        table tr td {
                            border-top: 1px solid #ddd;
                            padding-bottom: 4px;
                            padding-top: 6px;
                            height: 30px;
                        }
                        table.order-info tr:first-child th,
                        table.order-info tr:first-child td {
                            border-top: none;
                        }
                        table.order-info tr th {
                            width: 160px
                        }
                        .text-size-small {
                            font-size: 90%;
                        }
                        .table-product>tbody>tr>td,
                        .table-product>tbody>tr>th,
                        .table-product>tfoot>tr>td,
                        .table-product>tfoot>tr>th,
                        .table-product>thead>tr>td,
                        .table-product>thead>tr>th {
                            padding: 5px 0px;
                            line-height: 1.5384616;
                            vertical-align: top;
                            border-top: 1px solid #ddd;
                            border-right: 1px solid #ddd;
                        }
                        table.table-product {
                            border-left: 1px solid #ddd;
                            border-bottom: 1px solid #ddd;
                        }
                        table.table-product tr td,
                        table.table-product tr th {
                            padding: 5px 10px;
                        }
                        .pull-right {
                            float: right;
                        }
                    }
                </style>
            </div>
        </div>
    </div>
@endsection
@section('script_table')
    <script type="text/javascript">
        function handleCalShippingfee(district_id, province_id, weight = null, amount = null) {
            $.ajax({
                url: base_domain + '/api/v1/shipping-fee',
                type: 'POST',
                data: {
                    method: 'default',
                    order: {
                        receiver: {
                            provinceId: province_id,
                            districtId: district_id
                        },
                        weight: weight,
                        total_weight: weight,
                        amount: amount
                    }
                },
            }).done(function(response) {
                if (response.success == false && response.message == '') {
                    return false;
                }
                if (response.error || response.success == false) {
                    $('input[name=shipping_fee]').val(0);
                    return false;
                }
                if (response.data.length == 0) {
                    errorNotice('Có lỗi xảy ra', response.message);
                    return false;
                }
                $('input[name=shipping_fee]').val(response.data[0].fee);
            }).fail(function(res) {
                if (res.code == 0) {
                    $('input[name=shipping_fee]').val(0);
                }
            });
        };
        getProvince('#user_province', '#user_district', '', "Cao Bằng", "Huyện Bảo Lạc", '');
        getProvince('#order_province', '#order_district', '', "Cao Bằng", "Huyện Bảo Lạc", '');
        (function($) {
            function PrintElem(elem) {
                Popup($(elem).html());
            }
            function Popup(data) {
                var mywindow = window.open('', 'new div', 'height=800,width=1000');
                mywindow.document.write(
                    '<html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8">'
                );
                /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
                mywindow.document.write('</head><body >');
                mywindow.document.write(data);
                mywindow.document.write('</body></html>');
                mywindow.document.close();
                mywindow.print();
                return true;
            }
            $('#printWarranty').on('click', function() {
                PrintElem('#printDivWarranty');
                return false;
            });
            $('[data-popup="popover-tax"]').popover({
                html: 'true',
                placement: 'top',
                content: function() {
                    let data = $(this).data();
                    let html = '<form id="form_tax_' + data.id +
                        '" class="wb_ajax_submit" method="POST" action="' + data.url + '">' +
                        '<input type="hidden" name="_token" value="2Z0qF0FZBRj817VTRkUjPEnCBaTR2guKBRMbgavd">' +
                        '<input type="hidden" name="_method" value="PATCH">' +
                        '<div class="form-group">' +
                        '  <label>Thuế GTGT (%)</label>' +
                        '  <input type="number" class="form-control" min="0" value="' + data.tax +
                        '" name="tax" onClick="this.select();">' +
                        '</div>' +
                        '<div class="editable-buttons editable-buttons-bottom">' +
                        '<button type="button" class="btn btn-primary btn-sm button_submit_form" data-form="form_tax_' +
                        data.id + '"><i class="glyphicon glyphicon-ok"></i></button></div>' +
                        '</form>';
                    return html;
                }
            });
            $('[data-popup="popover-shippingfee"]').popover({
                html: 'true',
                placement: 'top',
                content: function() {
                    let data = $(this).data();
                    let html = '<form id="form_shippingfee_' + data.id +
                        '" class="wb_ajax_submit" method="POST" action="' + data.url + '">' +
                        '<input type="hidden" name="_token" value="2Z0qF0FZBRj817VTRkUjPEnCBaTR2guKBRMbgavd">' +
                        '<div class="form-group">' +
                        '  <label>Phí ship</label>' +
                        '  <input type="number" class="form-control" min="0" value="' + data.shippingfee +
                        '" name="shippingfee" onClick="this.select();">' +
                        '</div>' +
                        '<div class="editable-buttons editable-buttons-bottom">' +
                        '<button type="button" class="btn btn-primary btn-sm button_submit_form" data-form="form_shippingfee_' +
                        data.id + '"><i class="glyphicon glyphicon-ok"></i></button></div>' +
                        '</form>';
                    return html;
                }
            });
            $('[data-popup="popover-discount"]').popover({
                html: 'true',
                placement: 'top',
                content: function() {
                    let data = $(this).data();
                    let html = '<form id="form_discount_' + data.id +
                        '" class="wb_ajax_submit" method="POST" action="' + data.url + '">' +
                        '<input type="hidden" name="_token" value="2Z0qF0FZBRj817VTRkUjPEnCBaTR2guKBRMbgavd">' +
                        '<div class="form-group">' +
                        '  <label>Thêm giảm giá (đ)</label>' +
                        '  <input type="number" class="form-control" min="1" value="1" name="discount" onClick="this.select();">' +
                        '</div>' +
                        '<div class="editable-buttons editable-buttons-bottom">' +
                        '<button type="button" class="btn btn-primary btn-sm button_submit_form" data-form="form_discount_' +
                        data.id + '"><i class="glyphicon glyphicon-ok"></i></button></div>' +
                        '</form>';
                    return html;
                }
            });
            $('body').on('click', function(e) {
                $('[data-popup="popover-tax"]').each(function() {
                    if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover')
                        .has(e.target).length === 0) {
                        $(this).popover('hide');
                    }
                });
                $('[data-popup="popover-discount"]').each(function() {
                    if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover')
                        .has(e.target).length === 0) {
                        $(this).popover('hide');
                    }
                });
            });
            $('#order_district').on('change', function(e) {
                var province_id = $('#order_province').find(':selected').data('id');
                var district_id = $('#order_district').find(':selected').data('id');
                handleCalShippingfee(district_id, province_id, "0", "13300");
            })
            $('.removeDiscount').on('click', function() {
                var discount = $(this).data('discount');
                $.ajax({
                    url: "http://anhnnd.s1.loveitop.com/admin/order/2?remove-discount=" + discount,
                    method: 'PATCH',
                    data: {
                        _token: '2Z0qF0FZBRj817VTRkUjPEnCBaTR2guKBRMbgavd'
                    }
                }).done(function(data) {
                    location.reload();
                });
            });
            $(document).on('submit', '.wb_ajax_submit', function(e) {
                e.preventDefault();
                $(this).find('button').click();
            });
        })(jQuery)
    </script>
    <script src="{{ asset('obn-dashboard/js/core/shipping.js') }}?ver={{ time() }}"></script>
    <script>
        jQuery(document).ready(function($) {
            if ($('#service_shipping').length) {
                var id_show = $('#service_shipping option:selected').val();
                if (typeof(id_show) != "undefined" && id_show !== null) {
                    $('select[id=service_shipping]').val(id_show).trigger('change');
                    switch (id_show) {
                        case 'giaohangtietkiem':
                            giaohangtietkiem(id_show);
                            break;
                        case 'giaohangnhanh':
                            giaohangnhanh(id_show);
                            break;
                        case 'giaohangnhanh':
                            viettelpost(id_show);
                            break;
                    }
                } else {
                    $('select[id=service_shipping]').val('custom').trigger('change');
                }
            }
        });
    </script>
@endsection
