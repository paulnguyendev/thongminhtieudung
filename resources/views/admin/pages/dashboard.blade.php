@extends('admin.admin')
@section('navbar-right')
    <li><a href="{{ route('admin_profile/form') }}"><i class="icon-user"></i> <span class="hiden_1024_1350">Tài
                khoản</span></a>
    </li>
    <li><a href="{{ route('admin_auth/logout') }}"><i class="icon-switch2"></i> <span class="hiden_1024_1350">Thoát</span></a>
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <div class="panel panel-body">
                <a class="media no-margin" href="{{ route('admin/index') }}">
                    <div class="media-left media-middle">
                        <i class="icon-user icon-3x text-blue-400"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="no-margin text-semibold">{{ $totalUser }}</h3>
                        <span class="text-uppercase text-size-mini text-muted">Số lượng thành viên</span>
                    </div>

                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="panel panel-body panel-body-accent">
                <a class="media no-margin" href="{{ route('admin_teacher/index') }}">
                    <div class="media-left media-middle">
                        <i class="icon-profile icon-3x text-success-400"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="no-margin text-semibold">{{ $totalSupplier }}</h3>
                        <span class="text-uppercase text-size-mini text-muted">Giáo viên</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="panel panel-body">
                <a class="media no-margin" href="{{ route('admin_course/index') }}">
                    <div class="media-left media-middle">
                        <i class="icon-price-tag2 icon-3x text-indigo-400"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="no-margin text-semibold">{{ $totalProduct }}</h3>
                        <span class="text-uppercase text-size-mini text-muted">Khóa học</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="panel panel-body">
                <a class="media no-margin" href="{{ route('admin_order/index', ['status' => 'new']) }}">
                    <div class="media-left media-middle">
                        <i class="icon-cart icon-3x text-danger-400"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="no-margin text-semibold">{{ $totalOrderNew }}</h3>
                        <span class="text-uppercase text-size-mini text-muted">Đơn hàng mới</span>
                    </div>

                </a>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h5 class="panel-title"><i class="icon-menu3 position-left"></i> QUẢN LÝ KHÓA HỌC</h5>
                </div>
                <div class="panel-body">
                    <a style="font-size: 16px" href="{{ route('admin_course/index') }}">
                        <i class="icon-arrow-right6"></i>
                        Click vào đây để quản lý khóa học
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h5 class="panel-title"><i class="icon-cog3 position-left"></i> QUẢN LÝ BÁN HÀNG</h5>
                </div>
                <div class="panel-body">
                    <a style="font-size: 16px" href="{{ route('admin_order/index') }}">
                        <i class="icon-arrow-right6"></i> Click vào đây để quản lý bán hàng</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-flat panel-order-dashboard">
                <div class="panel-heading">
                    <h6 class="panel-title text-uppercase">Đơn hàng mới</h6>
                    <div class="heading-elements">
                        <span class="heading-text"><a href="{{route('admin_order/index')}}">Xem
                                tất cả</a></span>
                    </div>
                </div>
                <table class="table table-xlg datatable-ajax" data-source="{{ route('admin_order/dataList',['status' => 'new']) }}"
                    data-destroymulti="{{ route('user_order/destroy-multi') }}">
                    <thead>
                        <tr>
                            <th class="text-center" width="50"><input type="checkbox" bs-type="checkbox" value="all"
                                    id="inputCheckAll"></th>
                            <th width="9%">Đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Khách hàng</th>
                            <th  width="15%">Khóa học</th>
                            <th>Tổng tiền</th>
                            <th width="15%">Hình thức thanh toán</th>
                            <th width="15%">Thanh toán</th>
                            <th width="200">Trạng thái</th>
                            <th width="0" class="hidden"></th>
                            <th width="0" class="hidden"></th>
                            <th width="0" class="hidden"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script_table')
    <script type="text/javascript">
var columnDatas = [{
                data: null,
                render: function(data) {
                    return WBDatatables.showSelect(data.id);
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return '<a href="' + base_domain + '/admin/order/detail/' + data.id + '">' + data.code + '</a>';
                },
                orderable: false,
                searchable: false
            },
            {
                data: 'created_at',
                render: function(created_at) {
                    return moment(created_at).format('DD/MM/YYYY H:mm:ss');
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    if (data.buyer_fullname) {
                        return '<p>' + data.buyer_fullname + '</p><p>Điện thoại: ' + data.buyer_phone +
                            '</p><p>Địa chỉ: ' + data.buyer_address + ', ' + data.buyer_district + ', ' + data
                            .buyer_province + '</p>';
                    }
                    return '<p>' + data.fullname + '</p><p>Điện thoại: ' + data.phone + '</p><p>Địa chỉ: ' + data
                        .address + '</p>';
                },
                orderable: false,
                searchable: false

            },
            {
                data: null,
                render: function(data) {
                    if (data.details) {
                        let product = '';
                        $.each(data.details, function(index, value) {
                            product += '<p>' + value.product_name + ' - ' + value.quantity + '</p>';
                        });
                        return product;
                    }
                    return '';
                },
                orderable: false,
                searchable: false

            },
            {
                data: null,
                className: "text-right",
                render: function(data) {
                    return number_format(data.total) + ' ' + data.currency;
                },
                orderable: false,
                searchable: false
            },
            {
                data: 'payment_method',
                className: "text-center",
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    if (data.payment_status == 1) {
                        return '<span class="label bg-success-400">Đã thanh toán</span>';
                    }
                    return '<span class="label bg-grey-400">Chưa thanh toán</span>';
                },
                className: "text-center",
                orderable: false,
                searchable: false
            },
          
            {
                data: 'code',
                className: 'hidden'

            },
            {
                data: 'fullname',
                className: 'hidden'

            },
            {
                data: 'phone',
                className: 'hidden'

            },
        ];
        WBDatatables.init('.datatable-ajax', columnDatas, {
            "ordering": false,
            "paging": true
        });
    </script>
@endsection
