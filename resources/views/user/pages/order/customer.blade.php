@extends('user.main')
@section('title','Danh sách khách hàng')
@section('navbar_title', 'Danh sách khách hàng hàng')
@section('content')
<div class="panel panel-flat">
    <table class="table table-xlg datatable-ajax" data-source="{{ route('user_order/dataCustomer') }}"
        data-destroymulti="{{route('user_order/destroy-multi')}}">
        <thead>
            <tr>
                <th class="text-center" width="50"><input type="checkbox" bs-type="checkbox" value="all"
                        id="inputCheckAll"></th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                
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
                    return WBDatatables.showTitle(data.fullname, data.route_edit );
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
                    return (!data.email) ? '-' : data.email;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.address) ? '-' : data.address;
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