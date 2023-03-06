@extends('user.main')
@section('navbar_title', $navbar_title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <table class="table table-xlg datatable-ajax" data-source="{{ route('user_aff/dataCommissionList',['status' => $status]) }}"
                        data-destroymulti="{{ route('user_order/destroy-multi') }}">
                        <thead>
                            <tr>
                                <th>Mã thanh toán</th>
                                <th>Số tiền</th>
                                <th>Thông tin đơn hàng</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_srcipt')
    <script type="text/javascript">
        var page_type = 'category';
        var lang_code = 'vi';
        var default_language = 'vi';
        var url_extension = '/';
        var columnDatas = [
            {
                data: null,
                render: function(data) {
                    return (!data.code) ? '' : data.code;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.totalShow) ? '' : data.totalShow;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.orderInfo) ? '' : data.orderInfo;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.statusShow) ? '' : data.statusShow;
                },
                orderable: false,
                searchable: false
            },
            
           
            {
                data: null,
                render: function(data) {
                    return (!data.created) ? '' : data.created;
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
