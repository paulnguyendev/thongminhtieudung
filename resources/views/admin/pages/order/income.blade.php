@extends('user.main')
@section('title','Doanh thu')
@section('navbar_title', 'Doanh thu')
@section('content')
<div class="panel panel-flat">
    <table class="table table-xlg datatable-ajax" data-source="{{ route('user_order/dataIncome') }}"
        data-destroymulti="{{route('user_order/destroy-multi')}}">
        <thead>
            <tr>
                <th class="text-center" width="50"><input type="checkbox" bs-type="checkbox" value="all"
                        id="inputCheckAll"></th>
                <th>Mã đơn hàng</th>
                <th>Trạng thái</th>
               
                <th>Tổng đơn hàng</th>
                <th>Hoa hồng</th>
                <th>Điểm tích lũy</th>
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
                    return WBDatatables.showTitle(data.code, data.route_edit );
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.show_status) ? '' : data.show_status;
                },
                orderable: false,
                searchable: false
            },
            
            {
                data: null,
                render: function(data) {
                    return (!data.total_point) ? '-' : data.show_order_total;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.show_total_commission) ? '-' : data.show_total_commission;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.total_point) ? '-' : data.total_point;
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