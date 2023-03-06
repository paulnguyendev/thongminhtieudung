@extends('admin.admin')
@section('navbar_title', "Quản lý {$title} / Tạo mới")
@section('script_table')
    <script src="https://static-demo.loveitopcdn.com/backend/js/item.select.js?v=1.2.7"></script>
    <script>
        $('select[name="cat_id"]').select2({
            placeholder: 'Chọn thể loại'
        });
        $('select[name="supplier_id"]').select2({
            placeholder: 'Chọn nhà cung cấp'
        });
    </script>
    <script type="text/javascript">
        $('input[data-value=price]').on('keydown keypress keyup paste input', function() {
            canculatorSale('price', $('input[name=price]').val());
        });
        $('input[data-value=percent]').on('focus', function() {
            $(this).select();
        });
        $('input[data-value=percent]').on('keydown keypress keyup paste input', function() {
            canculatorSale('percent', $('input[name=percent]').val());
        });
        $('input[data-value=price_sale]').on('keydown keypress keyup paste input', function() {
            canculatorSale('price_sale', $('input[name=price_sale]').val());
        });
        $('input[data-value=price_sale]').on('blur', function() {
            if (!$('input[name=price_sale]').val()) {
                $('input[data-value=price_sale]').val($('input[name=price]').val());
                $('input[data-value=percent]').val(0);
                input_format_number('input[data-value=price_sale]');
            }
        });
        $('input[data-value=percent]').on('blur', function() {
            if (!$('input[name=percent]').val()) {
                $('input[data-value=percent]').val(0);
            }
        });
        function canculatorSale(field, value) {
            if (field == 'price') {
                if ($('input[name=percent]').val()) {
                    $('input[data-value=price_sale]').val(Math.round(value - (parseInt($('input[name=percent]').val()) *
                        value / 100)).toFixed(0)).change();
                    input_format_number('input[data-value=price_sale]');
                    return;
                } else {
                    if ($('input[name=price_sale]').val()) {
                        $('input[data-value=percent]').val(Math.round(100 - (parseFloat($('input[name=price_sale]').val()) *
                            100 / parseFloat($('input[name=price]').val()))));
                        if ($('input[name=price_sale]').val() == $('input[name=price]').val()) {
                            $('input[data-value=percent]').val(100);
                        }
                        input_format_number('input[data-value=percent]');
                    }
                }
            } else if (field == 'percent') {
                var price = parseFloat($('input[name=price]').val());
                if (value) {
                    $('input[data-value=price_sale]').val(Math.round(price - ((parseInt(value) * price / 100)).toFixed(0)))
                        .change();
                } else {
                    $('input[data-value=price_sale]').val(price).change();
                }
                input_format_number('input[data-value=price_sale]');
                return;
            } else if (field == 'price_sale') {
                if (value) {
                    $('input[data-value=percent]').val(Math.round(100 - (parseFloat(value) * 100 / parseFloat($(
                        'input[name=price]').val()))).toFixed(0));
                    if (value == $('input[name=price]').val()) {
                        $('input[data-value=percent]').val(0);
                    }
                } else {
                    $('input[data-value=percent]').val('');
                }
                input_format_number('input[data-value=percent]');
                return;
            }
        }
    </script>
@endsection
@section('navbar-right')
    <li>
        <a href="{{ route("{$controllerName}/index") }}" style="padding:5px 0px 5px 5px">
            <button class="btn btn-default heading-btn" type="button">Hủy</button>
        </a>
    </li>
    <li>
        <div style="padding:5px 0px 5px 5px">
            <button type="button" class="heading-btn btn btn-info btn-ladda btn-ladda-spinner" onclick="nav_submit_form(this)"
                data-style="zoom-in" data-form="post-form"><span class="ladda-label">Lưu</span></button>
        </div>
    </li>
@endsection
@section('script_table')
@endsection
@section('content')
    <form method="POST" action="{{ route("{$controllerName}/save") }}" accept-charset="UTF-8" id="post-form"
        class="data-dirty" enctype="multipart/form-data">
        <div class="col-xs-12 col-sm-12 col-md-9 admin-product">
            <div class="order-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tên sản phẩm (*)
                            </label>
                            <input class="form-control" data-seo="seo_keyword" name="title" type="text"
                                value="{{ $item['title'] ?? '' }}">
                            <span class="help-block"></span>
                        </div>
                        <div id="seoBox">
                            <div class="form-group-slug">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label class="text-capitalize">Đường dẫn (*)</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" bs-type="slug" bs-slug-from="title"
                                            data-seo="url" name="slug" value="{{ $item['slug'] ?? '' }}">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-editor">
                            <label class="">Mô tả</label>
                            <small class="help-block no-margin"></small>
                            <textarea class="ckeditor-basic" id="wbcke_1366359631" data-seo="description" name="description" cols="50"
                                rows="10">{{$item_meta['description'] ?? ""}}</textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group text-editor">
                            <label class="">Nội dung</label>
                            <small class="help-block no-margin"></small>
                            <textarea class="form-control ckeditor-full ckeditor" id="wbcke_200072389" data-seo="content" name="content"
                                cols="50" rows="10">{{$item_meta['content'] ?? ""}}</textarea>
                            <span class="help-block"></span>
                        </div>
                        <span class="recommended-keyword-appear-time-label"></span>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-4 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Hình đại diện <small>(600x600)</small></h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse" class=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="single-media text-center">
                                        <input id="thumbnail" name="thumbnail" type="hidden" value="{{$item['thumbnail'] ?? ""}}">
                                        <div class="media-item">
                                            <img class="img-thumbnail"
                                                data-no-image="https://via.placeholder.com/150x120&amp;text=No+Image"
                                                src="{{ $item['thumbnail'] ?? 'https://via.placeholder.com/150x120&amp;text=No+Image' }}"
                                                width="150px" height="120px" id="holder_thumbnail"
                                                style="max-height: 100%">
                                        </div>
                                        <div class="clearfix"></div>
                                        <a style="margin-top: 5px;margin-bottom: 3px" data-input="thumbnail"
                                            data-type="single" data-preview="holder_thumbnail" id="lfm_thumbnail"
                                            class="btn ;btn-sm btn-default" bs-type="filemanager">
                                            Chọn hình
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Bộ sưu tập hình ảnh</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse" class=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="text-center wrap-media">
                                        <input id="gallery" type="hidden" name="gallery" value="{{$item_meta['gallery'] ?? ""}}">
                                        <div class="row media-container" id="holder_gallery"></div>
                                        <a style="margin-top: 5px" data-input="gallery" data-type="multiple"
                                            data-preview="holder_gallery" id="lfm_gallery" class="btn btn-sm btn-default"
                                            bs-type="filemanager">
                                            Chọn hình
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Giá sản phẩm</legend>
                            <div class="form-group">
                                <div class="col-md-5 col-xs-12">
                                    <label>Giá bán (đ) </label>
                                    <input type="text" class="form-control format-number" data-value="price"
                                        value="{{ $item['regular_price'] ?? '' }}" />
                                    <input class="hidden" name="price" type="number"
                                        value="{{ $item['regular_price'] ?? '' }}">
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-2 col-xs-4">
                                    <label>Giảm giá (%) </label>
                                    <input type="text" class="form-control format-number" data-value="percent"
                                        value="{{ $item['percent'] ?? '' }}" />
                                    <input class="hidden" name="percent" type="number"
                                        value="{{ $item['percent'] ?? '' }}">
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-5 col-xs-8">
                                    <div class="row form-group mb-10">
                                        <div class="col-xs-12">
                                            <label>Giá khuyến mãi (giá bán còn lại) (đ) </label>
                                            <input type="text" class="form-control format-number"
                                                data-value="price_sale" value="{{ $item['sale_price'] ?? '' }}" />
                                            <input class="hidden" name="price_sale" type="number"
                                                value="{{ $item['sale_price'] ?? '' }}">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="row form-group mb-10">
                                        <div class="col-xs-12">
                                            <label>Điểm tích lũy </label>
                                            <input type="number" class="form-control" name="point"
                                                value="{{ $item['point'] ?? '' }}" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="order-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Tồn kho</legend>
                            <div class="col-xs-6 col-md-4">
                                <div class="form-group mb-0">
                                    <label for="Mã sản phẩm">M&atilde; Sản Phẩm</label>
                                    <input class="form-control" name="code" type="text"
                                        value="{{ $item['code'] ?? '' }}">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="form-group">
                                    <label for="Tình trạng kho">T&igrave;nh Trạng Kho</label>
                                    <select class="form-control" name="in_stock">
                                        @php
                                            $in_stock = $item['in_stock'] ?? '';
                                        @endphp
                                        <option value="1" {{ $in_stock == '1' ? 'selected' : '' }}>Còn Hàng</option>
                                        <option value="0" {{ $in_stock == '0' ? 'selected' : '' }}>Hết hàng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="form-group mb-0">
                                    <label for="Số lượng">Số lượng</label>
                                    <input class="form-control" name="stock" type="number"
                                        value="{{ $item['stock'] ?? '' }}">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">Trạng thái</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse" class=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="checkbox-inline">
                            @php
                                $is_published = $item['is_published'] ?? '';
                            @endphp
                            <input bs-type="checkbox" {{ $is_published == '1' ? 'checked' : '' }} name="is_published"
                                type="checkbox" value="1">
                            Hiện
                        </label>
                        <a href="#published_datetime" data-toggle="collapse" class="pull-right"
                            style="font-size: 1.2em"><i class="fa fa-calendar-o"></i></span></a>
                    </div>
                    <div class="row collapse" id="published_datetime">
                        <div class="col-md-10">
                            <input class="form-control" bs-type="singleDatePicker" onkeydown="return false;"
                                name="published_at" type="text" value="2022-12-22 16:48:44">
                        </div>
                        <div class="col-md-2" style="margin-top: 7px;font-size: 1.2em">
                            <a href="#published_datetime" data-toggle="collapse" class="remmove_published_datetime"><i
                                    class="fa fa-remove"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">Phân loại</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse" class=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="Thể loại">Danh mục</label>
                        <select class="form-control " name="cat_id">
                            
                            @foreach ($categories as $cat_id => $cat_name)
                                <option value="{{ $cat_id }}" {{in_array($cat_id,$taxonomy_ids) ? "selected" : ""}}>
                                    {{ $cat_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Thể loại khác">Danh mục khác</label>
                        <select multiple="multiple" bs-type="multiSelect" class="selectized" name="other_cat_ids[]"
                            placeholder="Chọn Thể loại khác">
                            @foreach ($categories as $cat_id => $cat_name)
                                <option value="{{ $cat_id }}" {{in_array($cat_id,$taxonomy_second_ids) ? "selected" : ""}}>
                                    {{ $cat_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Nhà cung cấp</label>
                        <select class="form-control" name="supplier_id">
                            @php
                                $supplier_id = $item['supplier_id'] ?? '';
                            @endphp
                            <option value="">Chọn nhà cung cấp</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier['id'] }}"
                                    {{ $supplier_id == $supplier['id'] ? 'selected' : '' }}>{{ $supplier['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block"></span>
                    </div> --}}
                    <input type="hidden" name="id" value="{{$id}}">
                </div>
            </div>
        </div>
    </form>
@endsection
