@extends('admin.admin')
@section('title', 'Danh sách đơn hàng')
@section('navbar_title', 'Danh sách đơn hàng')
@section('navbar-right')
    <li>
        <a href="{{ route('admin/index') }}" style="padding:5px 5px">
            <button class="btn btn-default heading-btn" type="button">Trở về</button>
        </a>
    </li>
@endsection
@section('content')
    <style type="text/css">
        .media-body .no-margin label {
            font-size: 13px;
            margin-bottom: 0;
            display: block;
        }
    </style>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-blue-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <strong class="text-uppercase">Đơn hàng mới</strong>
                        <h3 class="no-margin">
                            <label>Tổng đơn hàng: <span>{!! $orderNew['number'] !!}</span></label>
                            <label>Tổng tiền: {!! $orderNew['total_money'] !!}</label>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-primary-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <strong class="text-uppercase">Đã xác nhận</strong>
                        <h3 class="no-margin">
                            <label>Tổng đơn hàng: <span>{!! $orderConfirm['number'] !!}</span></label>
                            <label>Tổng tiền: {!! $orderConfirm['total_money'] !!}</label>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-info-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <strong class="text-uppercase">Đang vận chuyển</strong>
                        <h3 class="no-margin">
                            <label>Tổng đơn hàng: <span>{!! $orderShipping['number'] !!}</span></label>
                            <label>Tổng tiền: {!! $orderShipping['total_money'] !!}</label>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-success-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <strong class="text-uppercase">Hoàn tất</strong>
                        <h3 class="no-margin">
                            <label>Tổng đơn hàng: <span>{!! $orderComplete['number'] !!}</span></label>
                            <label>Tổng tiền: {!! $orderComplete['total_money'] !!}</label>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-flat">
        <table class="table table-bordered datatable-ajax" data-source="{{ route('admin_order/dataList') }}"
            data-destroymulti="{{ route('admin_order/destroyMulti') }}">
            <thead>
                <tr>
                    <th class="text-center" width="50"><input type="checkbox" bs-type="checkbox" value="all"
                            id="inputCheckAll"></th>
                    <th width="9%">Đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Khách hàng</th>
                    <th  width="15%">Sản phẩm</th>
                    <th>Tổng tiền</th>
                    <th width="15%">Hình thức thanh toán</th>
                    <th width="15%">Thanh toán</th>
                  
                    <th width="0" class="hidden"></th>
                    <th width="0" class="hidden"></th>
                    <th width="0" class="hidden"></th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('script_table')
    <script type="text/javascript">
        const CONFIRM_ORDER_STATUS = 2;
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
                    return '<a href="' + base_domain + '/admin/order/detail/' + data.id + '">' + data.code + '</a>';
                },
                orderable: false,
                searchable: false
            },
            {
                data: 'created_at',
                render: function(created_at) {
                    return moment(created_at).format('DD/MM/YYYY H:mm:ss');
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    if (data.buyer_fullname) {
                        return '<p>' + data.buyer_fullname + '</p><p>Điện thoại: ' + data.buyer_phone +
                            '</p><p>Địa chỉ: ' + data.buyer_address + ', ' + data.buyer_district + ', ' + data
                            .buyer_province + '</p>';
                    }
                    return '<p>' + data.fullname + '</p><p>Điện thoại: ' + data.phone + '</p><p>Địa chỉ: ' + data
                        .address + '</p>';
                },
                orderable: false,
                searchable: false

            },
            {
                data: null,
                render: function(data) {
                    if (data.details) {
                        let product = '';
                        $.each(data.details, function(index, value) {
                            product += '<p>' + value.product_name + ' - ' + value.quantity + '</p>';
                        });
                        return product;
                    }
                    return '';
                },
                orderable: false,
                searchable: false

            },
            {
                data: null,
                className: "text-right",
                render: function(data) {
                    return number_format(data.total) + ' ' + data.currency;
                },
                orderable: false,
                searchable: false
            },
            {
                data: 'payment_method',
                className: "text-center",
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data) {
                    if (data.payment_status == 1) {
                        return '<span class="label bg-success-400">Đã thanh toán</span>';
                    }
                    return '<span class="label bg-grey-400">Chưa thanh toán</span>';
                },
                className: "text-center",
                orderable: false,
                searchable: false
            },
            // {
            //     data: null,
            //     render: function(data) {
            //         return '<select class="form-control order_status" style="width: 100%;" data-id="' + data.id +
            //             '">'
            //             // + '<option value="0" ' + ((data.status == '0') ? 'selected' : '') + '>Chưa đặt hàng</option>'
            //             +
            //             '<option value="new" ' + ((data.status == 'new') ? 'selected' : '') +
            //             '>Đơn hàng mới</option>' +
            //             '<option value="confirm" ' + ((data.status == 'confirm') ? 'selected' : '') +
            //             '>Đã xác nhận</option>' +
            //             '<option value="shipping" ' + ((data.status == 'shipping') ? 'selected' : '') +
            //             '>Đang vận chuyển</option>' +
            //             '<option value="complete" ' + ((data.status == 'complete') ? 'selected' : '') +
            //             '>Hoàn tất</option>' +
            //             '<option value="cancel" disabled ' + ((data.status == 'cancel') ? 'selected' : '') +
            //             '>Đã hủy</option>' +
            //             '</select>';
            //     },
            //     orderable: false,
            //     searchable: false
            // },
            {
                data: 'code',
                className: 'hidden'

            },
            {
                data: 'fullname',
                className: 'hidden'

            },
            {
                data: 'phone',
                className: 'hidden'

            },
        ];

        WBDatatables.init('.datatable-ajax', columnDatas, {
            "createdRow": function(row, data, index) {
                if (data.view_by_admin == 0) {
                    $(row).addClass('row_new');
                }
            }
        });
        WBDatatables.showAction();
        // var datepicker =
        //     '<div class="input-group has-feedback"><input name="created_at" id="created_at" autocomplete="off" placeholder="Lọc theo ngày" /><span class="fa fa-calendar-o form-control-feedback" aria-hidden="true"></span></div>';
        // WBDatatables.addFilter(datepicker, 'input[id=created_at]');
        var status =
            '<select class="form-control" name="status"><option value = ""selected = "selected" > Tất cả </option>  <option value = "new" > Đơn hàng mới </option> <option value = "confirm" > Đã xác nhận </option><option value = "shipping" > Đang vận chuyển </option><option value = "complete" > Hoàn tất </option > < option value = "cancel" >Đã hủy </option > < /select >';
        WBDatatables.addFilter(status, 'select[name=status]');




        $('table').on('change', '.order_status', function(e) {
            var id = $(this).attr('data-id');
            let status = $(this).val();
            var data_update = {
                status: status,
                type: 'update-status',
            };
            if (status == CONFIRM_ORDER_STATUS) {
                data_update.force_update = 0;
            }
            return _update(id, data_update);
        });

        $('table').on('change', '.payment_status', function(e) {
            var id = $(this).attr('data-id');
            var payment_status = $(this).is(':checked') ? 1 : 0;
            var data_update = {
                payment_status: payment_status
            };
            return _update(id, data_update);
        });

        function _update(id, data) {
            data._token = '2Z0qF0FZBRj817VTRkUjPEnCBaTR2guKBRMbgavd';
            $.ajax({
                type: "POST",
                url: base_domain + '/admin/order/save/' + id,
                data: data,
                success: function(response) {
                    if (response.success) {
                        successNotice('Thông báo', response.message);
                        $('.save-menu').removeClass('disabled');
                        swal.close();
                    } else {
                        if (response.need_confirmation) {
                            swal({
                                showLoaderOnConfirm: true,
                                closeOnConfirm: false,
                                title: response.title,
                                text: response.message,
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#FF7043",
                                cancelButtonText: "Không",
                                confirmButtonText: "Có"
                            }, function() {
                                data.force_update = 1;
                                return _update(id, data);
                            });
                        } else {
                            errorNotice('Thông báo', response.message);
                            swal.close();
                        }
                    }
                },
            });
        }

        function checkOrderQuantity(id) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    type: 'GET',
                    url: base_domain + '/admin/order/check-quantity/' + id,
                    data: {
                        _token: _token
                    },
                    dataType: 'json',
                    success: function(response) {
                        resolve(response);
                    },
                    error: function() {
                        reject(new Error(
                            'Không thể kiểm tra số lượng sản phẩm trong đơn hàng, vui lòng kiểm tra đường truyền mạng và thử lại'
                        ));
                    }
                });
            });
        }

        function exportExcel() {
            location.href = base_domain + "/admin/order/export?export_type=excel&status=" + $('select[name="status"]')
                .val() + '&key=' + $("input[type='search']").val();
        }

        $(document).find('#created_at').daterangepicker({
            maxYear: parseInt(moment().format('YYYY'), 10),
            showDropdowns: true,
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY',
                fromLabel: 'Ngày bắt đầu',
                toLabel: 'Ngày kết thúc',
                applyLabel: 'Xác nhận',
                cancelLabel: 'Hủy'
            }
        });

        $(document).find('input[name="created_at"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'))
                .change();
        });
    </script>
@endsection
