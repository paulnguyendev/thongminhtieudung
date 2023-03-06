@extends('user.main')
@section('navbar_title', $navbar_title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">

                <div class="panel-body">
                    <table class="table table-xlg datatable-ajax" data-source="{{ route('user_aff/dataList') }}"
                        data-destroymulti="{{ route('user_order/destroy-multi') }}">
                        <thead>
                            <tr>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Cấp độ</th>
                                <th>Mã giới thiệu</th>
                                <th>Ngày đăng ký</th>
                               
                               
                               
                                <th>Trạng thái</th>
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
                    return (!data.name) ? '' : data.name;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.email) ? '' : data.email;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.phone) ? '' : data.phone;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.level) ? '' : data.level;
                },
                orderable: false,
                searchable: false
            },
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
                    return (!data.created_at) ? '' : data.created_at;
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
