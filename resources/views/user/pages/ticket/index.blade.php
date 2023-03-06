@extends('user.main')
@section('navbar_title', $navbar_title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('status_success'))
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span>
                    </button>
                    {{ session('status_success') }}
                </div>
            @endif
            <div class="panel panel-flat">
                <div class="panel-body">
                    <table class="table table-xlg datatable-ajax" data-source="{{ route('user_ticket/dataList') }}"
                        data-destroymulti="{{ route('user_order/destroy-multi') }}">
                        <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Mã yêu cầu</th>
                                <th>Thời gian</th>
                                
                                
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
                    return WBDatatables.showTitle(data.name, data.route_edit);
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
