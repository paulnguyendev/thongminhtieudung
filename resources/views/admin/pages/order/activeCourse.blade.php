@php
    use App\Helpers\Obn;
@endphp
@extends('admin.admin')
@section('title', 'Kích hoạt khóa học')
@section('navbar_title', 'Kích hoạt khóa học')
@section('navbar-right')
    <li>
        <div style="padding:5px 0px 5px 5px">
            <a class="btn btn-default" href="{{ route('admin_order/detail', ['id' => $item['id']]) }}">Trở về</a>
        </div>
    </li>
    @if ($item['is_course_active'] != 1)
        <li>
            <div style="padding:5px 0px 5px 5px">
                <button type="button" class="heading-btn btn btn-info btn-ladda btn-ladda-spinner"
                    onclick="nav_submit_form(this)" data-style="zoom-in" data-form="post-form"><span class="ladda-label">Kích
                        hoạt ngay</span></button>
            </div>
        </li>
    @endif

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route("{$controllerName}/saveActiveCourse") }}" accept-charset="UTF-8"
                id="post-form" class="data-dirty" enctype="multipart/form-data">
                @if (count($products) > 0)
                    @foreach ($products as $key => $product)
                        <input type="hidden" name="active[{{ $key }}][type]" value="{{ $product['type'] }}">
                        <input type="hidden" name="active[{{ $key }}][id]" value="{{ $product['id'] }}">
                        <input type="hidden" name="order_id" value="{{ $item['id'] }}">
                        <input type="hidden" name="code" value="{{ $code }}">
                        <input type="hidden" name="emailExits" value="{{ $emailExits }}">
                        <input type="hidden" name="fullname" value="{{ $info_order['fullname'] }}">
                        <input type="hidden" name="email" value="{{ $info_order['email'] }}">
                        <input type="hidden" name="phone" value="{{ $info_order['phone'] }}">
                        <input type="hidden" name="is_affiliate" value="{{ $is_affiliate }}">
                        <input type="hidden" name="user_id" value="{{ $checkEmail['id'] ?? '' }}">
                        <input type="hidden" name="parent_id" value="{{ $item['user_id'] ?? '' }}">
                        <input type="hidden" name="current_is_affiliate" value="{{ $checkEmail['is_affiliate'] ?? '' }}">
                        @csrf
                    @endforeach
                @endif

            </form>
            @if (session('status_success'))
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                            class="sr-only">Close</span>
                    </button>
                    {{ session('status_success') }}
                </div>
            @endif
            <div class="panel panel-flat" id="orderDetailPanel" data-id="{{ $id ?? '' }}"
                data-route-update="{{ route('admin_order/save', ['id' => $id ?? '']) }}" data-address="12521525"
                data-receiver-name="125" data-receiver-phone="125125" data-receiver-email="125@gmail.com"
                data-amount="13300" data-code="{{ $item['code'] ?? '' }}">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Chi tiết đơn hàng <a style="color: #1E88E5">#{{ $code }}</a>

                    </h4>
                    <div class="panel-desc">
                        <p style="margin-bottom:0">Tài khoản : {{ $info_order['email'] ?? '' }}</p>
                        <p style="margin-bottom:0">Số điện thoại : {{ $info_order['phone'] ?? '' }}</p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="10px"></th>
                                    <th>Thông tin đơn hàng</th>
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
                                            $type = $product['type'] ?? 'course';
                                            $typeName = $type == 'course' ? 'Khóa học' : 'Combo';
                                        @endphp
                                        <tr>
                                            <td class="text-center" style="padding: 5px;">
                                                <img src="{{ $thumbnail }}" class="img-lg">
                                            </td>
                                            <td class="order-product-name" data-quantity="1">
                                                <div class="media-left" style="padding-right:0px">
                                                    <div>
                                                        <a class="text-default text-semibold">
                                                            {!! $product['name'] !!} [ {{ $typeName }} ]
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
            @if ($emailExits == 0)
                <div class="panel panel-flat" id="orderDetailPanel" data-id="{{ $id ?? '' }}"
                    data-route-update="{{ route('admin_order/save', ['id' => $id ?? '']) }}" data-address="12521525"
                    data-receiver-name="125" data-receiver-phone="125125" data-receiver-email="125@gmail.com"
                    data-amount="13300" data-code="{{ $item['code'] ?? '' }}">
                    <div class="panel-heading">
                        <h4 class="panel-title">Thông tin tài khoản đăng nhập</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Mật khẩu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="order-product-name" data-quantity="1">
                                            <div class="media-left" style="padding-right:0px">
                                                <div>
                                                    <a class="text-default text-semibold">
                                                        {{ $info_order['email'] ?? '-' }}
                                                    </a>
                                                </div>
                                                <div class="text-muted text-size-small">
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $randomPassword }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
@section('script_table')



@endsection
