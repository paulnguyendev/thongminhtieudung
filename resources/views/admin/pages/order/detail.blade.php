@php
    use App\Helpers\Obn;
@endphp
@extends('admin.admin')
@section('title', 'Chi tiết đơn hàng')
@section('navbar_title', 'Chi tiết đơn hàng')
@section('navbar-right')
    <li>
        <div style="padding:5px 0px 5px 5px">
            <a class="btn btn-default" href="{{ route('admin_order/index') }}">Trở về</a>
        </div>
    </li>
    <li>
    <li>
        <div style="padding:5px 0px 5px 5px">
            <a class="btn btn-default" id="printWarranty">In hóa đơn</a>
        </div>
    </li>
    @if ($item['status'] != 'cancel' && $item['status'] != 'complete')
        <li>
            <a style="padding:5px 0px 5px 5px">
                <button class="btn bg-danger heading-btn" id="cancel_order" type="button">
                    <i class="fa fa-ban" aria-hidden="true"></i> Hủy đơn hàng </button>
            </a>
        </li>
        <li>
            <a style="padding:5px 0px 5px 5px">
                <button class="btn bg-primary btn-ladda btn-ladda-spinner" id="active_order" type="button"
                    data-url="{{ route('admin_order/checkUser', ['id' => $id]) }}"
                    data-updateOrder-url="{{ route('admin_order/updateOrder') }}" data-id="{{ $id }}">
                    <i class="icon-checkmark" aria-hidden="true"></i> Kích hoạt đơn hàng </button>
            </a>
        </li>
    @endif
    {{-- @if ($item['is_course_active'] != 1)
        <li>
            <div style="padding:5px 0px 5px 5px">
                <a class="btn btn-primary" href="{{ route('admin_order/activeCourse', ['code' => $item['code']]) }}"> <i
                        class="icon-checkmark" aria-hidden="true"></i> Kích hoạt khóa học</a>
            </div>
        </li>
    @else
        <li>
            <div style="padding:5px 0px 5px 5px">
                <a class="btn btn-primary" href="{{ route('admin_order/deactiveCourse', ['code' => $item['code']]) }}"> <i
                        class="fa fa-ban" aria-hidden="true"></i> Ngừng kích hoạt khóa học</a>
            </div>
        </li>
    @endif --}}
    <li>
        <a style="padding:5px 0px 5px 5px" class="remove_item" href="{{ route('admin_order/delete', ['id' => $id]) }}"
            data-redirect="{{ route('admin_order/index') }}">
            <button class="btn bg-danger heading-btn" type="button">
                <i class="fa fa-trash" aria-hidden="true"></i>
                Xóa đơn hàng
            </button>
        </a>
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status_success'))
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                            class="sr-only">Close</span>
                    </button>
                    {{ session('status_success') }}
                </div>
            @endif
            <div class="panel panel-flat" id="orderDetailPanel" data-id="{{ $id }}"
                data-route-update="{{ route('admin_order/save', ['id' => $id]) }}" data-address="12521525"
                data-receiver-name="125" data-receiver-phone="125125" data-receiver-email="125@gmail.com"
                data-amount="13300" data-code="{{ $item['code'] ?? '' }}">
                <div class="panel-heading">
                    <h4 class="panel-title">Chi tiết đơn hàng <a style="color: #1E88E5">#{{ $item['code'] }}</a></h4>
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
                                    <td class="text-right">{{ number_format($item['total']) . ' đ' ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="4">
                                        <a href="javascript:void(0);" data-popup="popover-shippingfee"
                                            aria-describedby="popovertax" data-shippingfee="0"
                                            data-id="{{ $id }}"
                                            data-url="{{ route('admin_order/save', ['id' => $id]) }}"
                                            data-original-title="" title="">
                                            Thêm phí ship
                                        </a>
                                    </td>
                                    <td class="text-right"> {{ Obn::showPrice($shipping['fee'] ?? 0) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="4">
                                        <p style="padding: 3px 0; margin-bottom: 0;">
                                            <a href="javascript:void(0);" data-popup="popover-discount"
                                                aria-describedby="popoverdiscount" data-id="{{ $id }}"
                                                data-url="{{ route('admin_order/save', ['id' => $id]) }}"
                                                data-original-title="" title="">Thêm giảm giá</a>
                                        </p>
                                    </td>
                                    <td class="text-right" style="vertical-align: text-top;">
                                        {{ Obn::showPrice($item['discount'] ?? 0) }}
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
            @if ($item['status'] != 'cancel' && $item['status'] != 'complete')
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Thông tin cây thành viên
                        </h5>
                    </div>
                    <div class="panel-body">
                        @if (count($parents) > 0)
                            @foreach ($parents as $parent)
                                <div class="parent-item">
                                    <h3>Họ tên: {{ $parent['name'] ?? '-' }}</h3>
                                    <p>Tên level: {{ $parent['level'] ?? '-' }}</p>
                                    <p>Cấp độ: {{ $parent['depth'] ?? '' }}</p>
                                    <p>Phần trăm hoa hồng: {{ $parent['percent'] ?? '0' }} %</p>
                                </div>
                            @endforeach
                            <div class="parent-item">
                                <h3>Họ tên: {{ $user['name'] ?? '-' }}</h3>
                                <p> {{ $is_affiliate == 1 ? 'Đủ điều kiện affiliate' : '' }} </p>

                            </div>
                        @else
                            <p>Không tìm thấy cây hệ thống</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            {{-- <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="form-group">
                        <label><strong>Trạng thái đặt hàng</strong></label>
                        <select class="form-control order_status" data-id="2">
                            <!-- <option value="0" >Chưa đặt hàng</option> -->
                            <option value="new" {{ $item['status'] == 'new' ? 'selected' : '' }}
                                {{ $item['status'] == 'complete' ? 'disabled' : '' }}>Đơn hàng mới</option>
                            <option value="confirm" {{ $item['status'] == 'confirm' ? 'selected' : '' }}
                                {{ $item['status'] == 'complete' ? 'disabled' : '' }}>Đã xác nhận
                            </option>
                            <option value="shipping" {{ $item['status'] == 'shipping' ? 'selected' : '' }}
                                {{ $item['status'] == 'complete' ? 'disabled' : '' }}>Đang vận chuyển
                            </option>
                            <option value="complete" {{ $item['status'] == 'complete' ? 'selected' : '' }}>Hoàn tất
                            </option>
                            <option disabled="" {{ $item['status'] == 'cancel' ? 'selected' : '' }}
                                {{ $item['status'] == 'complete' ? 'disabled' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            <strong>Hình thức thanh toán:</strong> Chuyển khoản qua ngân hàng
                        </label>
                        <label class="checkbox-inline">
                            <input class="payment_status" data-id="2" bs-type="checkbox"
                                {{ $payment['status'] == 1 ? 'checked' : '' }} type="checkbox"
                                {{ $item['status'] == 'complete' ? 'disabled' : '' }}>
                            Đã thanh toán
                        </label>
                    </div>
                </div>
            </div> --}}
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Thông tin người mua hàng<ul class="icons-list heading-elements-toggle">
                            <li><a data-action="collapse" class="rotate-180"></a></li>
                        </ul>
                    </h5>
                    <div class="heading-elements">
                        <a data-action="modal" data-toggle="modal" data-target="#buyer" data-popup="tooltip"
                            title="" data-original-title="Chỉnh sửa thông tin khách hàng"><i class="fa fa-pencil"
                                aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="100">Họ tên</th>
                                    <th>{{ $info_order['fullname'] ?? '-' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Điện thoại</td>
                                    <td>{{ $info_order['phone'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $info_order['email'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>
                                        {{ $info_order['address'] ?? '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="buyer" class="modal fade">
                <form method="POST" action="{{ route('admin_order/saveInfo', ['type' => 'order', 'id' => $id]) }}"
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
                                    <input class="form-control" name="name" type="text"
                                        value="{{ $info_order['fullname'] ?? '-' }}">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Điện thoại
                                                </label>
                                                <input class="form-control" name="phone" type="text"
                                                    value="{{ $info_order['phone'] ?? '-' }}">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email
                                                </label>
                                                <input class="form-control" name="email" type="text"
                                                    value="{{ $info_order['email'] ?? '-' }}">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ
                                    </label>
                                    <input class="form-control" name="address" type="text"
                                        value="{{ $info_order['address'] ?? '-' }}">
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
            {{-- <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Thông tin người nhận hàng<ul class="icons-list heading-elements-toggle">
                            <li><a data-action="collapse" class="rotate-180"></a></li>
                        </ul>
                    </h5>
                    <div class="heading-elements">
                        <a data-action="modal" data-toggle="modal" data-target="#order_info" data-popup="tooltip"
                            title="" data-original-title="Chỉnh sửa thông tin nhận hàng"><i class="fa fa-pencil"
                                aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="100">Họ tên</th>
                                    <th>{{ $info_shipping['name'] ?? '-' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Điện thoại</td>
                                    <td>{{ $info_shipping['phone'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $info_shipping['email'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>
                                        {{ $info_shipping['address'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Note</td>
                                    <td>
                                        {{ $info_shipping['note'] ?? '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
            <div id="order_info" class="modal fade">
                <form method="POST" action="{{ route('admin_order/saveInfo', ['type' => 'shipping', 'id' => $id]) }}"
                    accept-charset="UTF-8" id="order-form" enctype="multipart/form-data">
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
                                    <input class="form-control" name="name" type="text"
                                        value="{{ $info_shipping['name'] ?? '-' }}">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Điện thoại
                                                </label>
                                                <input class="form-control" name="phone" type="text"
                                                    value="{{ $info_shipping['phone'] ?? '-' }}">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email
                                                </label>
                                                <input class="form-control" name="email" type="text"
                                                    value="{{ $info_shipping['email'] ?? '-' }}">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ
                                    </label>
                                    <input class="form-control" name="address" type="text"
                                        value="{{ $info_shipping['address'] ?? '-' }}">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú
                                    </label>
                                    <textarea class="form-control" rows="5" name="note" cols="50">{{ $info_shipping['note'] ?? '' }}</textarea>
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
                    <img src="{{ asset('obn-dashboard/img/logo.png') }}"
                        style="float: left; margin-right: 10px; height: 60px; max-width: 300px;margin-bottom: 30px;">
                    <strong>Minimart</strong><br>
                    Địa chỉ: Số 78, Đường Song Hành, Quốc Lộ 1A, KĐTM Hồng Loan 5C, Phường Hưng Thạnh, Quận Cái Răng, Thành
                    phố Cần Thơ
                    <br>
                    Email: mandalamart.vn@gmail.com | Website: mandalamart.vn<br>
                    Hotline: 0939183232
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
                                            <td>#{{ $item['code'] ?? '-' }} </td>
                                        </tr>
                                        <tr>
                                            <th>Ngày mua:</th>
                                            <td>{{ $item['created_at'] ?? '-' }}</td>
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
                                            <td>{{ $info_order['fullname'] ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Số điện thoại:</th>
                                            <td>{{ $info_order['phone'] ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>{{ $info_order['email'] ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th style="vertical-align: text-top;">Địa chỉ:</th>
                                            <td style="vertical-align: text-top;">
                                                {{ $info_order['address'] ?? '-' }}
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
                                                <td class="order-product-name" data-quantity="1">
                                                    <div class="media-left" style="padding-right:0px">
                                                        {{ $product['name'] ?? '-' }}
                                                        <div class="text-muted text-size-small">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $quantity }} x {{ $price }}</td>
                                                <td class="text-right">{{ $subTotal }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-right" colspan="2">Thành tiền</td>
                                            <td class="text-right">{{ number_format($item['total']) . ' đ' ?? 0 }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2">Phí ship</td>
                                            <td class="text-right">{{ Obn::showPrice($shipping['fee'] ?? 0) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2">
                                            </td>
                                            <td class="text-right" style="vertical-align: text-top;">
                                            </td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td class="text-right" colspan="2">Tổng cộng</td>
                                            <td class="text-right">{{ Obn::showPrice($orderSum) }}</td>
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
            let checkUser;
            $("#active_order").click(function() {
                let url = $(this).data('url');
                let updateOrderUrl = $(this).data('updateorder-url');
                let order_id = $(this).data('id');
                var l = Ladda.create(document.querySelector('#active_order'));
                $.ajax({
                    type: "get",
                    url: url,
                    data: {
                        action: "checkUser"
                    },
                    dataType: "json",
                    beforeSend: function() {
                        l.start();
                    },
                    success: function(response) {
                        l.stop();
                        console.log(response);
                        let is_exist = response.is_exist ? response.is_exist : 0;
                        let is_affiliate = response.is_affiliate ? response.is_affiliate : 0;
                        let order_id = response.order_id ? response.order_id : "";
                        let user_id = response.user_id ? response.user_id : "";
                        let popupCreateUser = response.popupCreateUser ? response.popupCreateUser :
                            "";
                        if (is_exist == 0) {
                            warningSwal({
                                "title": "Thông báo",
                                "message": "Email này chưa tồn tại trên hệ thống. Vui lòng xác nhận tạo mới tài khoản cho email này",
                            }, (confirm) => {
                                $(".page-content").append(popupCreateUser);
                                if (confirm) {
                                    swal.close();
                                    $('#createUser').modal('show');
                                    createUser(order_id);
                                } else {
                                    $(".page-content").remove(popupCreateUser);
                                }
                            });
                        } else {
                            warningSwal({
                                "title": "Thông báo",
                                "message": "Xác nhận kích hoạt đơn hàng",
                            }, () => {
                                updateOrder(updateOrderUrl, {
                                    order_id: order_id,
                                    user_id: user_id,
                                    is_affiliate: is_affiliate,
                                });
                            });
                        }
                    },
                    complete: function() {
                        l.stop();
                    }
                });
            });
            const createUser = (order_id) => {
                let formSubmit = $("#createUser form");
                formSubmit.submit(function(e) {
                    e.preventDefault();
                    var l = Ladda.create(document.querySelector('#btnCreateUser'));
                    l.start();
                    let urlCreateUser = $(this).attr('action');
                    formSubmit.ajaxSubmit({
                        beforeSerialize: function() {
                            return true;
                        },
                        beforeSubmit: function(formData,
                            formObject, formOptions
                        ) {},
                        success: function(data) {
                            console.log(data);
                            l.stop();
                            $('#createUser').modal('hide');
                            let route_updateOrder = data.route_updateOrder ? data
                                .route_updateOrder : "";
                            let user_id = data.user_id ? data
                                .user_id : "";
                            if (data.success !== 'unfriended') {
                                if (data.success == false) {
                                    warningNotice(data.message);
                                    return;
                                }
                            }
                            let popupUpdateOrder = data.popupUpdateOrder ? data
                                .popupUpdateOrder : "";
                            if (!data.redirect) {
                                swal({
                                    "title": "Thông báo",
                                    "text": "Tạo thành viên thành công. <br> Tiếp tục thao tác kích hoạt đơn hàng",
                                    type: "success",
                                    html: true,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    showCancelButton: true,
                                    confirmButtonColor: "#DD6B55",
                                    showLoaderOnConfirm: true,
                                    cancelButtonText: "Hủy",
                                    confirmButtonText: "OK",
                                }, (clickUpdate) => {
                                    if (clickUpdate) {
                                        updateOrder(route_updateOrder, {
                                            order_id: order_id,
                                            user_id: user_id,
                                        });
                                    }
                                });
                            } else {
                                $(".page-content").remove(popupUpdateOrder);
                                $(window).unbind('beforeunload');
                                var menu_redirect = "";
                                location.href = menu_redirect ? menu_redirect : data.redirect;
                            }
                        },
                        error: function(data) {
                            console.log(data);
                            l.stop();
                            WBForm.showError(
                                formSubmit, data
                            );
                        }
                    });
                })
            };
            const updateOrder = (url, params) => {
                let order_id = params.order_id ? params.order_id : "";
                let user_id = params.user_id ? params.user_id : "";
                let is_affiliate = params.is_affiliate ? params.is_affiliate : "";
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        order_id: order_id,
                        user_id: user_id,
                        is_affiliate: is_affiliate,
                    },
                    dataType: "json",
                    success: function(response) {
                        swal({
                            "title": "Thông báo",
                            "text": "Kích hoạt đơn hàng thành công",
                            type: "success",
                            html: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }, () => {
                            location.reload();
                        });
                    },
                    error: function(err) {
                        $(".page-content").remove(popupOrder);
                        swal("Thông báo", "Đã có lỗi xảy ra", "error");
                    }
                });
            }
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
