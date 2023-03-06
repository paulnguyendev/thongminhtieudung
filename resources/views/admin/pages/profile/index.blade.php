@extends('admin.admin')
@section('navbar_title', 'Quản lý nhà cung cấp')
@section('navbar-right')
    <li>
        <a href="{{ route("{$controllerName}/form") }}" style="padding:5px 5px">
            <button class="btn bg-info heading-btn" type="button">Tạo {{$title}}</button>
        </a>
    </li>
@endsection
@section('content')
    <div class="panel panel-flat">
        <table class="table table-xlg datatable-ajax" data-source="{{ route("{$controllerName}/dataList") }}"
            data-destroymulti="{{route("{$controllerName}/destroy-multi")}}">
            <thead>
                <tr>
                    <th class="text-center" width="50"><input type="checkbox" bs-type="checkbox" value="all"
                            id="inputCheckAll"></th>
                    <th class="text-center" width="100">Hình ảnh</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                   
                    <th data-orderable="false" width="100px"></th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('script_table')
    <script type="text/javascript">
        var page_type = 'supplier';
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
                    return WBDatatables.showThumbnail(data.thumbnail);
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return WBDatatables.showTitle(data.description.title, data.route_edit, data.is_published, data
                        .published_at, ('<span class="tree-icon">¦––</span> ').repeat(data.depth));
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
                    return (!data.email) ? '' : data.email;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return (!data.address) ? '' : data.address;
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    return WBDatatables.showRemoveIcon(data.route_remove,
                        'Menu liên kết với trang này sẽ bị xóa theo, bạn có chắc muốn xóa không?');
                },
                orderable: false,
                searchable: false
            },
        ];
        WBDatatables.init('.datatable-ajax', columnDatas, {
            "ordering": false,
            "paging": false
        });
        WBDatatables.showAction();
    </script>
@endsection
