@php
    use App\Helpers\Obn;
    use App\Helpers\User;
@endphp
@extends('admin.admin')
@section('navbar_title', 'Thông tin tài khoản')
@section('navbar-right')
    <li>
        <a href="{{ route("{$controllerName}/form", ['id' => $id]) }}" style="padding:5px 0px 5px 5px">
            <button class="btn btn-info heading-btn" type="button">Chỉnh sửa</button>
        </a>
    </li>
    <li>
        <a href="{{ route("{$controllerName}/index") }}" style="padding:5px 0px 5px 5px">
            <button class="btn btn-default heading-btn" type="button">Hủy</button>
        </a>
    </li>
@endsection
@section('content')
    <form role="form">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default" id="affiliateBox">
                    <div class="panel-heading">
                        <h6 class="panel-title">Thông tin affiliate</h6>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="">Cấp độ:</label>
                            <b>{{ $levelName ?? '-' }}</b>
                        </div>
                        <div class="form-group">
                            <label for="">Số dư hiện tại:</label>
                            <b>{{ $total_balance }}</b>
                        </div>
                        <div class="form-group">
                            <label>Link Affiliate:</label>
                            <a target="_blank" href="{{ $aff_link }}">{{ $aff_link }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default" id="userBox">
                    <div class="panel-heading">
                        <h6 class="panel-title">Thông tin khách hàng</h6>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Họ tên:</label>
                                <input type="text" disabled="" value="{{ $user->name ?? '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại:</label>
                                <input type="text" disabled="" value="{{ $user->phone ?? '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="text" disabled="" value="{{ $user->email ?? '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Ngày đăng ký:</label>
                                <input type="text" disabled="" value="{{ $user->created_at ?? '' }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default" id="affiliateBank">
                    <div class="panel-heading">
                        <h6 class="panel-title">Thông tin ngân hàng</h6>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="">Ngân hàng:</label>
                        </div>
                        <div class="form-group">
                            <label for="">Chi nhánh:</label>
                        </div>
                        <div class="form-group">
                            <label for="">Chủ tài khoản:</label>
                        </div>
                        <div class="form-group">
                            <label for="">Số tài khoản:</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#orderBonusTab" data-toggle="tab">Danh sách đơn hàng</a></li>
                                <li><a href="#withdrawlTab" data-toggle="tab">Lịch sử hoa hồng</a></li>
                                <li><a href="#parentTab" data-toggle="tab">Danh sách tuyến trên</a></li>
                                <li><a href="#childTab" data-toggle="tab">Danh sách tuyến dưới</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="orderBonusTab">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Ngày đặt hàng</th>
                                                <th>Sản phẩm</th>
                                                <th>Giá trị đơn hàng</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($orders) > 0)
                                                @foreach ($orders as $order)
                                                    @php
                                                        $products = $order['products'];
                                                        $created = $order['created_at'];
                                                        $products = json_decode($products, true);
                                                        $total = $order['total'] ?? 0;
                                                        $total = Obn::showPrice($total);
                                                        $status = $order['status'];
                                                        $status = Obn::showStatus($status);
                                                        $code = $order['code'];
                                                        $id = $order['id'];
                                                    @endphp
                                                    <tr>
                                                        <th><a target="_blank"
                                                                href="{{ route('admin_order/detail', ['id' => $id]) }}">{{ $order['code'] }}</a>
                                                        </th>
                                                        <th> {{ $created }} </th>
                                                        <th>
                                                            @foreach ($products as $product)
                                                                <p>{{ $product['name'] ?? '' }} -
                                                                    {{ $product['qty'] ?? 0 }}</p>
                                                            @endforeach
                                                        </th>
                                                        <th> {{ $total }} </th>
                                                        <th> {!! $status !!} </th>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="withdrawlTab">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Mã giao dịch</th>
                                                <th>Ngày giờ</th>
                                                <th>Số tiền</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        <tbody>
                                            @if (count($transactions) > 0)
                                                @foreach ($transactions as $transaction)
                                                    @php
                                                        $code = $transaction['code'];
                                                        $created = $transaction['created'];
                                                        $total = $transaction['total'] ?? 0;
                                                        $total = Obn::showPrice($total);
                                                        $status = $transaction['status'];
                                                        $status = Obn::showStatus($status);
                                                    @endphp
                                                    <tr>
                                                        <th>{{ $code }}</th>
                                                        <th>{{ $created }}</th>
                                                        <th>{{ $total }}</th>
                                                        <th> {!! $status !!} </th>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane" id="parentTab">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Họ tên</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Cấp độ</th>
                                                <th>Tên cấp độ</th>
                                            </tr>
                                        <tbody>
                                            @if (count($parents) > 0)
                                                @foreach ($parents as $key => $parent)
                                                    @php
                                                        $index = $key + 1;
                                                        $name = $parent['name'];
                                                        $email = $parent['email'];
                                                        $phone = $parent['phone'];
                                                        $depth = $parent['depth'];
                                                        $level = $parent['level'] ?? '';
                                                        $levelName = User::getCurrentLevel($level);
                                                    @endphp
                                                    <tr>
                                                        <th>{{ $index }}</th>
                                                        <th>{{ $name }}</th>
                                                        <th>{{ $email }}</th>
                                                        <th>{{ $phone }}</th>
                                                        <th>{{ $depth }}</th>
                                                        <th>{{ $levelName }}</th>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th colspan="5">Không có tuyến trên</th>
                                                </tr>
                                            @endif
                                        </tbody>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane" id="childTab">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Họ tên</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Tên cấp độ</th>
                                            </tr>
                                        <tbody>
                                            @if (count($childs) > 0)
                                                @foreach ($childs as $key => $child)
                                                    @php
                                                        $index = $key + 1;
                                                        $name = $child['name'];
                                                        $email = $child['email'];
                                                        $phone = $child['phone'];
                                                        $level = $child['level'] ?? '';
                                                        $levelName = User::getCurrentLevel($level);
                                                    @endphp
                                                    <tr>
                                                        <th>{{ $index }}</th>
                                                        <th>{{ $name }}</th>
                                                        <th>{{ $email }}</th>
                                                        <th>{{ $phone }}</th>
                                                        <th>{{ $levelName }}</th>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th colspan="5">Không có tuyến dưới</th>
                                                </tr>
                                            @endif
                                        </tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
