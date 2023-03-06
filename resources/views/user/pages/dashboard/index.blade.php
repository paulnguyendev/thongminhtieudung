@php
    use App\Helpers\User;
    use App\Helpers\Package\AffiliatePackage;
    $userInfo = User::getInfo();
    $user_id = $userInfo['id'];
    $level = $userInfo['level'] ?? "";
    $checkAffiliate = User::checkAffiliate();
    $currentLevelTitle = User::getCurrentLevel($level);
@endphp
@extends('user.main')
@section('content')
    @php
        $updateLevel = AffiliatePackage::updateLevel($user_id);
    @endphp
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="panel panel-body panel-body-accent">
                <a class="media no-margin" href="{{ route('user_aff/commission',['status' => 'pending']) }}">
                    <div class="media-left media-middle">
                        <i class="icon-coin-dollar icon-3x text-success-400"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="no-margin text-semibold">{{ $totalIncome }}</h3>
                        <span class="text-uppercase text-size-mini text-muted">HOA HỒNG CHỜ DUYỆT</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="panel panel-body">
                <a class="media no-margin" href="{{ route('user_order/index') }}">
                    <div class="media-body">
                        <h3 class="no-margin text-semibold">{{ $totalOrder }}</h3>
                        <span class="text-uppercase text-size-mini text-muted">SỐ ĐƠN HÀNG</span>
                    </div>
                    <div class="media-right media-middle">
                        <i class="icon-cart icon-3x text-danger-400"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="panel panel-body">
                <a class="media no-margin" href="{{ route('user_course/index') }}">
                    <div class="media-left media-middle">
                        <i class="icon-price-tag2 icon-3x text-indigo-400"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="no-margin text-semibold">{{$totalCourse}}</h3>
                        <span class="text-uppercase text-size-mini text-muted">KHÓA HỌC ĐÃ ĐĂNG KÝ</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="{{ $checkAffiliate == 1 ? 'col-lg-6' : 'col-lg-12' }} ">
            <div class="panel panel-body">
                <div class="dashboard-slide">
                    <div class="dashboard-slide-item">
                        <img src="{{ asset('kyna/img/slide1.jpg') }}" alt="Dashboard slide 1" class="img-responsive">
                    </div>
                    <div class="dashboard-slide-item">
                        <img src="{{ asset('kyna/img/slide2.jpg') }}" alt="Dashboard slide 1" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
        @if ($checkAffiliate == 1)
            <div class="col-lg-6">
                <div class="panel">
                    {{-- <div class="panel-heading pb-0">
                        <h6 class="panel-title">Thông tin thành viên</h6>
                    </div> --}}
                    <div class=" panel-body panel-user-dashboard">
                        <p>
                            <strong>Họ tên:</strong>
                            <span>{{ $userInfo['name'] ?? '-' }}</span>
                        </p>
                        <p>
                            <strong>Email:</strong>
                            <span>{{ $userInfo['email'] ?? '-' }}</span>
                        </p>
                        <p>
                            <strong>Cấp độ:</strong>
                            <span>{{ $currentLevelTitle ?? '-' }}</span>
                        </p>
                        <p>
                            <strong>Mã giới thiệu:</strong>
                            <span>{{ $userInfo['code'] ?? '' }}</span>
                            <span><a data-href="{{ $userInfo['code'] ?? '' }}"
                                    class="btn btn-success btn-xs copy-affiliate-url">Copy</a></span>
                        </p>
                        {{-- <p>
                        <strong>Loại tài khoản:</strong>
                        {!! User::getGroupName($userInfo['id']) !!}
                    </p> --}}
                        <p>
                            <strong>Link đăng ký:</strong>
                            <span><a target="_blank"
                                    href="{{ route('fe_aff/register', ['code' => $userInfo['code']]) }}">{{ route('fe_aff/register', ['code' => $userInfo['code']]) }}</a></span>
                            <span><a data-href="{{ route('fe_aff/register', ['code' => $userInfo['code']]) }}"
                                    class="btn btn-success btn-xs copy-affiliate-url">Copy</a></span>
                        </p>
                        {{-- <p>
                            <strong>Link mua hàng:</strong>
                            <span><a target="_blank"
                                    href="{{ route('fe_aff/index', ['code' => $userInfo['code']]) }}">{{ route('fe_aff/index', ['code' => $userInfo['code']]) }}</a></span>
                            <span><a data-href="{{ route('fe_aff/index', ['code' => $userInfo['code']]) }}"
                                    class="btn btn-success btn-xs copy-affiliate-url">Copy</a></span>
                        </p> --}}
                        <p>
                            <strong>Số lượt nhấp chuột vào liên kết giới thiệu:</strong>
                            <span>{{ $userInfo['aff_number'] ?? 0 }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @endif
        {{-- <div class="col-lg-12">
            <div class="panel panel-flat panel-order-dashboard">
                <div class="panel-heading">
                    <h6 class="panel-title text-uppercase">Đơn hàng mới</h6>
                    <div class="heading-elements">
                        <span class="heading-text"><a href="#">Xem
                                tất cả</a></span>
                    </div>
                </div>
                <table class="table table-xlg datatable-ajax" data-source="{{ route('user_order/dataList') }}"
                    data-destroymulti="{{ route('user_order/destroy-multi') }}">
                    <thead>
                        <tr>
                            <th class="text-center" width="50"><input type="checkbox" bs-type="checkbox" value="all"
                                    id="inputCheckAll"></th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày tạo đơn</th>
                            <th>Đại lý</th>
                            <th>Khách hàng</th>
                            <th>Thanh toán</th>
                            <th>Tổng đơn</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> --}}
    </div>
@endsection
@section('custom_srcipt')
    <script>
        $('.dashboard-slide').slick({
            dots: false,
            infinite: true,
            speed: 500,
            prevArrow: '<button class="slick-prev slide-btn"> < </button>',
            nextArrow: '<button class="slick-next slide-btn"> > </button>',
        });
    </script>
    <script type="text/javascript">
        var page_type = 'category';
        var lang_code = 'vi';
        var default_language = 'vi';
        var url_extension = '/';
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
                    return WBDatatables.showTitle(data.code, data.route_edit);
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.created_at) ? '' : data.created_at;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.user.name) ? '' : data.user.name;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.info_order) ? '' : data.info_order;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.payment) ? '' : data.payment;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.total) ? '' : data.total;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.status) ? '' : data.status;
                },
                orderable: false,
                searchable: false
            },
        ];
        WBDatatables.init('.datatable-ajax', columnDatas, {
            "ordering": false,
            "paging": true
        });
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
