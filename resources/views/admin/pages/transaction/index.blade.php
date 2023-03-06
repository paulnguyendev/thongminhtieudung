@extends('admin.admin')
@section('navbar_title', 'Danh sách thanh toán')
@section('navbar-right')
    {{-- <li>
        <a href="{{ route('admin_teacher/form') }}" style="padding:5px 5px">
            <button class="btn bg-info heading-btn" type="button">Tạo giáo viên</button>
        </a>
    </li> --}}
@endsection
@section('content')
    <div class="panel panel-flat">
        <table class="table table-xlg datatable-ajax" data-source="{{ route('admin_transaction/dataList') }}"
            data-destroymulti="{{ route('admin_transaction/destroy-multi') }}">
            <thead>
                <tr>
                    <th class="text-center" width="50">
                        <input type="checkbox" bs-type="checkbox" value="all" id="inputCheckAll">
                    </th>
                    <th>Mã thanh toán</th>
                    <th>Số tiền</th>
                    <th>Thành viên</th>
                    <th>Thông tin đơn hàng</th>
                    <th>Thời gian</th>

                    <th>Trạng thái</th>
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
                    return WBDatatables.showTitle(data.code, data.route_edit, data.is_published,
                        data.published_at);
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
                    return (!data.userInfo) ? '' : data.userInfo;
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
            {
                data: null,
                render: function(data) {
                    var status =
                        data.status == "pending" ?
                        '<a class="mr-15 text-success-600 approve_transaction" data-id="' +
                        data.id +
                        '" data-url = "' + data.route_approve +
                        '" data-title = "Duỵêt"><i class="icon-checkmark"></i> Duyệt</a> <br>' :
                        '<a class="mr-15 text-info-600 approve_transaction" data-id="' +
                        data.id +
                        '" data-url = "' + data.route_approve +
                        '" data-title = "Hủy" ><i class="fa fa-ban"></i> Hủy </a> <br>';
                    console.log(status);
                    return (
                        status +
                        WBDatatables.showRemoveIcon(
                            data.route_remove,
                            "Bạn có chắc muốn xóa tài khoản này không?"
                        )
                    );
                },
                orderable: false,
                searchable: false
            },
        ];
        let affiliateTransactionDatatable = WBDatatables.init('.datatable-ajax', columnDatas, {
            "ordering": false,
            "paging": false
        });
        WBDatatables.showAction();
    </script>
    <script>
        $(document).on("click", ".approve_transaction", function() {

            var url = $(this).data("url");
            var title = $(this).data("title");
            swal({
                    showLoaderOnConfirm: true,
                    closeOnConfirm: false,
                    title: `Bạn có chắc ${title} thanh toán này không ?`,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FF7043",
                    cancelButtonText: "Không",
                    confirmButtonText: "Có",
                },
                function() {


                    $(document).find("a.approve_affiliate").addClass("disabled");
                    $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "json",
                        data: {
                            action: "approve_affiliate"
                        },
                        success: function(response) {
                            swal.close();
                            affiliateTransactionDatatable.ajax.reload();
                            if (response.success) {
                                successNotice("Thông báo", "Đổi trạng thái yêu cầu thành công");
                            } else {
                                errorNotice("Thông báo", "Có lỗi xảy ra");
                            }
                        },
                        error: function() {
                            swal.close();
                            errorNotice("Thông báo", "Có lỗi xảy ra");
                        },
                        complete: function() {
                            $(document).find("a.approve_affiliate").removeClass("disabled");
                        },
                    });
                }
            );
        });
    </script>
@endsection
