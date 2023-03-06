@extends('user.main')
@section('title', 'Danh sách đơn hàng')
@section('navbar_title', 'Danh sách đơn hàng')
@section('content')
    <div class="panel panel-flat">
        @if (session('status_warning'))
            <div class="alert alert-warning alert-styled-left alert-arrow-left alert-bordered">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span>
                </button>
                {{ session('status_warning') }}
            </div>
        @endif
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
                    <th>Giá trị đơn hàng</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('custom_srcipt')
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
            "paging": false
        });
    </script>
@endsection
