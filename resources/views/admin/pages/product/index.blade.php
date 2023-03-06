@extends('admin.admin')
@section('navbar_title', 'Quản lý sản phẩm')
@section('navbar-right')
    <li>
        <a href="{{ route('product/form') }}" style="padding:5px 5px">
            <button class="btn bg-info heading-btn" type="button">Tạo sản phẩm</button>
        </a>
    </li>
@endsection
@section('content')
    <div class="panel panel-flat">
        <table class="table table-xlg datatable-ajax" data-source="{{ route('product/dataList') }}"
            data-destroymulti="{{ route('product/destroyMulti') }}">
            <thead>
                <tr>
                    <th class="text-center" width="50"><input type="checkbox" bs-type="checkbox" value="all"
                            id="inputCheckAll"></th>
                    <th></th>
                    <th>Tiêu đề</th>
                    <th>Thể loại</th>
                    <th width="115">Giá</th>
                    <th>Tình trạng kho</th>
                    <th width="180" class="text-center">Ngày đăng</th>

                    <th width="130" class="text-center"></th>
                    <th width="10"></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection
@section('script_table')
    <script type="text/javascript">
        if ($('.datatable-ajax').length) {
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
                        return WBDatatables.showThumbnailLazy(data.thumbnail);
                    },
                    class: "text-center no-padding-right",
                    orderable: false,
                    searchable: false
                },
                {
                    data: null,
                    name: 'description.title',
                    render: function(data) {
                        return WBDatatables.showTitle(data.description.title, data.route_edit, data.is_published,
                            data.published_at);
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: null,
                    render: function(data) {
                        return (!data.category.description) ? '' : data.category.description.title;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: null,
                    class: "text-right",
                    render: function(data) {
                        var $element = `<a href="javascript:void(0);" class="price" data-popup="popover-price" data-id="${data.id}" data-url="${base_domain}/admin/product/updateField/${data.id}" data-price="${data.price}" data-price_sale="${data.sale_price }">
                        
                        `;
                        if (data.sale_price_formated) {
                            $element += `${data.sale_price_formated}`;
                            if (data.sale_price != data.price) {
                                $element += `<p class="old_price">${data.price_formated}</p>`;
                            }
                        }
                        else {
                            $element += `${data.price_formated}`;
                        }

                        $element += `</a>`;
                        return $element;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: null,
                    class: "text-center",
                    render: function(data) {
                        if (data.is_advanced_quantity) {
                            return `<a href="javascript:void(0);" data-popup="popover-quantity" class="${data.quantity > 0 ? 'text-success' : 'text-danger'}" data-id="${data.id}" data-checked="${data.allow_out_of_stock_order}" data-quantity="${data.quantity}" data-url="${base_domain}/admin/product/updateField/${data.id}">
                                ${data.quantity > 0 ? 'Còn hàng' : 'Hết hàng'}
                            </a>`;
                        } else {
                            return `<a href="javascript:void(0);" class="switchery-checkbox ${data.in_stock == 1 ? 'text-success' : 'text-danger'}" data-type="checklist" data-pk="${data.id}" data-title="Đổi trạng thái" data-value="${data.in_stock}" data-url="${base_domain}/admin/product/updateField/${data.id}">
                                ${data.in_stock == 1 ? 'Còn hàng' : 'Hết hàng'}
                            </a>`;
                        }
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: null,
                    name: "published_at",
                    render: function(data) {
                        return WBDatatables.showPublish(data.is_published, data.published_at, data.route_update,
                            data.deleted_at, data.deleted_by)
                    },
                    className: "text-center",
                    orderable: false,
                    searchable: false

                },

                {
                    data: null,
                    class: 'option-actions text-center no-padding-right',
                    render: function(product) {
                        return `<a data-href="${product.direct_add_to_cart_url}" class="copy-add-cart-url text-info-600" title="Copy link đặt hàng"><i class="icon-cart-add2"></i> </a>
                    <a href="${product.route_review}" class="text-info-600" title="Xem thử" target="_blank"> <i class="icon-eye"></i></a>`;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: null,
                    render: function(data) {
                        return WBDatatables.showRemoveIcon(data.route_remove);
                    },
                    orderable: false,
                    searchable: false
                },
            ];

            let renderChangeStatusPopup = () => {
                $.fn.editable.defaults.ajaxOptions = {
                    type: "PATCH"
                };
                $('.switchery-checkbox').editable({
                    source: {
                        '1': 'Còn hàng'
                    },
                    emptytext: 'Hết hàng',
                    showbuttons: 'bottom',
                    params: {
                        _token: _token,
                        type: 'direct-update-status'
                    },
                    name: 'in_stock',
                    tpl: '<div class="checkbox checkbox-switchery switchery-xs"></div>',
                    success: function(response, newValue) {
                        response.success && renderChangeStatusPopupAfterReload;
                        if (response.success && newValue.length) {
                            $('table ').find(`a[data-pk='${response.id}']`).removeClass('text-danger')
                                .addClass('text-success');
                        } else {
                            $('table').find(`a[data-pk='${response.id}']`).removeClass('text-success')
                                .addClass('text-danger');
                        }
                    }
                });

                // Initialize plugin  and insert in editable popup on show
                $('.switchery-checkbox').on('shown', function(e, editable) {
                    editable.input.$input.addClass('switcher-single');

                    var elem = document.querySelector('.switcher-single');
                    var init = new Switchery(elem);
                });
            };

            let renderChangePricePopup = () => {
                $('[data-popup="popover-price"]').popover({
                    html: 'true',
                    placement: 'top',
                    title: 'Chỉnh sửa giá',
                    content: function() {
                        var data = $(this).data();
                        var $form_price = '<form id="form_price_' + data.id +
                            '" class="wb_ajax_submit" method="POST" action="' + data.url + '">' +
                            '<input type="hidden" name="_method" value="PATCH">' +
                            '<div class="form-group">' +
                            '  <label>Giá bán </label>' +
                            '  <input type="number" class="form-control" value="' + data.price +
                            '" name="price">' +
                            '</div>' +
                           
                            '<div class="editable-buttons editable-buttons-bottom">' +
                            '<button type="button" class="btn btn-primary btn-sm button_submit_form" data-form="form_price_' +
                            data.id + '"><i class="glyphicon glyphicon-ok"></i></button>' +
                            // '<button type="button" class="btn btn-default btn-sm cancel"><i class="glyphicon glyphicon-remove"></i></button></div>' +
                            '</form>';
                        return $form_price;
                    }
                });

                $('body').on('click', function(e) {
                    $('[data-popup="popover-price"]').each(function() {
                        //the 'is' for buttons that trigger popups
                        //the 'has' for icons within a button that triggers a popup
                        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover')
                            .has(e.target).length === 0) {
                            $(this).popover('hide');
                        }
                    });
                });
            };
            let renderChangeQuantity = () => {
                $('[data-popup="popover-quantity"]').popover({
                    html: 'true',
                    placement: 'top',
                    title: 'Kho hàng',
                    content: function() {
                        let data = $(this).data();
                        let html = '<form id="form_quantity_' + data.id +
                            '" class="wb_ajax_submit" method="POST" action="' + data.url + '">' +
                            '<input type="hidden" name="_token" value="ANv3sHccUyxwPMnYXlScYxEM3yjAnvgzZBOSE6Ex">' +
                            '<input type="hidden" name="_method" value="PATCH">' +
                            '<div class="form-group">' +
                            '  <label>Số lượng trong kho </label>' +
                            '  <input type="number" class="form-control" value="' + data.quantity +
                            '" name="quantity">' +
                            '</div>' +
                            '<div class="form-group">' +
                            `<div class="checkbox">
                            <label>
                                <input type="hidden" value="0" name="allow_out_of_stock_order">
                                <input type="checkbox" class="styled" ${data.checked == 1 ? 'checked' : ''} name="allow_out_of_stock_order" value="1">
                                Cho phép đặt hàng khi hết hàng
                            </label>
                        </div>` +
                            '</div>' +
                            '<div class="editable-buttons editable-buttons-bottom">' +
                            '<button type="button" class="btn btn-primary btn-sm button_submit_form" data-form="form_quantity_' +
                            data.id + '"><i class="glyphicon glyphicon-ok"></i></button>' +
                            '</form>';
                        return html;
                    }
                });

                $('body').on('click', function(e) {
                    $('[data-popup="popover-quantity"]').each(function() {
                        //the 'is' for buttons that trigger popups
                        //the 'has' for icons within a button that triggers a popup
                        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover')
                            .has(e.target).length === 0) {
                            $(this).popover('hide');
                        }
                    });
                });
            };
            let renderChangeStatusPopupAfterReload = () => {
                renderChangeStatusPopup();
                renderChangePricePopup();
                renderChangeQuantity();
            };

            var option = {
                // fnInitComplete: renderChangeStatusPopupAfterReload,
                fnDrawCallback: function() {
                    // WBForm.init();
                    WBForm.uniform();
                    WBDatatables.updatePublisedDate();
                    WBDatatables.hideSortBtnAtLastAndFirstRow();
                    renderChangeStatusPopupAfterReload();
                },
            };
            let productDatatables = WBDatatables.init('.datatable-ajax', columnDatas, option);
            WBDatatables.updateActive();
            WBDatatables.showAction();
            // WBDatatables.showActionActive();
            var is_published =
                `<select class="form-control" name="is_published"><option value="-1" selected="selected">Tất cả trạng thái</option><option value="0">Ẩn</option><option value="1">Hiện</option><option value="2">Đang chờ hiện</option><option value="-2">Thùng rác</option></select>`;
            var category = $('#ctgs').html();
            var product_group = $('#product_groups').html();

            // WBDatatables.addFilter(product_group, 'select[name=group_id]');
            // WBDatatables.addFilter(category, 'select[name=cat_id]');
            // WBDatatables.addFilter(is_published, 'select[name=is_published]');
        }

        let html = '<div class="dataTables_filter"><a class="btn btn-default button-export" target="_blank" href="' +
            base_domain + '/admin/product/export" role="button">Xuất danh sách đã lọc</a></div>';
        // $("div.datatable-header .datatable-header-right").append(html);

        $('body').on('change', 'select[name=cat_id]', function() {
            var url = $('button.btn-create').parent().attr('href');
            var paramObj = {};
            var index = url.indexOf("?");
            if (index !== -1) {
                var splitted = url.substr(index + 1).split('&');
                url = url.substr(0, index);
                for (var i = 0; i < splitted.length; i++) {
                    var params = splitted[i].split('=');
                    var key = params[0];
                    var value = params[1];
                    paramObj[key] = value;
                }
            }
            paramObj[$(this).attr('name')] = $(this).val();
            if (Object.keys(paramObj).length) {
                url += '?';
                $.each(paramObj, function(key, value) {
                    url += key + '=' + value + '&';
                });
                url = url.substring(0, url.length - 1);
            }
            $('button.btn-create').parent().attr('href', url);
        });

        $('body').on('change', 'select[name=group_id]', function() {
            var url = $('button.btn-create').parent().attr('href');
            var paramObj = {};
            var index = url.indexOf("?");
            if (index !== -1) {
                var splitted = url.substr(index + 1).split('&');
                url = url.substr(0, index);
                for (var i = 0; i < splitted.length; i++) {
                    var params = splitted[i].split('=');
                    var key = params[0];
                    var value = params[1];
                    paramObj[key] = value;
                }
            }
            paramObj[$(this).attr('name')] = $(this).val();
            if (Object.keys(paramObj).length) {
                url += '?';
                $.each(paramObj, function(key, value) {
                    url += key + '=' + value + '&';
                });
                url = url.substring(0, url.length - 1);
            }
            $('button.btn-create').parent().attr('href', url);
        });

        $(document).on('click', '.copy-add-cart-url', function(e) {
            e.preventDefault();
            let copyText = $(this).data('href');
            let tempElement = document.createElement('input');
            tempElement.setAttribute('value', copyText);
            document.body.appendChild(tempElement);
            tempElement.select();
            document.execCommand("Copy");
            document.body.removeChild(tempElement);
            successNotice('Thông báo', 'Copy link đặt hàng thành công');
        });

        $('#modal_update_multiprice input[name=value]').keyup(function() {
            if (parseFloat($(this).val()) != 0) {
                $('#modal_update_multiprice .button_submit_form').removeAttr('disabled');
            } else {
                $('#modal_update_multiprice .button_submit_form').attr('disabled', 'disabled');
            }
        });
    </script>
@endsection
