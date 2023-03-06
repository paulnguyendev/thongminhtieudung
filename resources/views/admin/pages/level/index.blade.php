@extends('admin.admin')
@section('navbar_title', 'Danh sách trình độ')
@section('navbar-right')
    <li>
        <a href="{{ route('admin_level/form') }}" style="padding:5px 5px">
            <button class="btn bg-info heading-btn" type="button">Tạo trình độ mới</button>
        </a>
    </li>
@endsection
@section('content')
    <div class="panel panel-flat">
        <table class="table table-xlg datatable-ajax" data-source="{{ route('admin_level/dataList') }}"
            data-destroymulti="{{route('admin_level/destroy-multi')}}">
            <thead>
                <tr>
                    <th class="text-center" width="50"><input type="checkbox" bs-type="checkbox" value="all"
                            id="inputCheckAll"></th>
                    <th>Tên</th>
                    <th data-orderable="false" width="100px"></th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('script_table')
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
                    return WBDatatables.showTitle(data.description.title, data.route_edit, data.is_published, data
                        .published_at);
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
