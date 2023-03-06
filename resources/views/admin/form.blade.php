@extends('admin.admin')
@section('navbar_title', 'Quản lý danh mục sản phẩm / Tạo mới')
@section('navbar-right')
    <li>
        <a href="{{ route('productCategory/index') }}" style="padding:5px 0px 5px 5px">
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
@section('content')
    <form method="POST" action="https://dainghiagroup.com/admin/product" accept-charset="UTF-8" id="post-form"
        class="data-dirty" enctype="multipart/form-data"><input name="_token" type="hidden"
            value="0qqxfiMGdlXD652HGg1pHO06ngLznO3tEibMRTev">
        <div class="col-xs-12 col-sm-12 col-md-9 admin-product">
            <div class="order-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Từ khóa trang (*)</label>
                            <input data-seo="seo_keyword" required="required" class="form-control" name="meta_keyword"
                                type="text">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Tên sản phẩm (*)
                            </label>
                            <input class="form-control" data-seo="title" name="title" type="text">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group text-editor">
                            <label class="">Mô tả</label>
                            <small class="help-block no-margin"></small>
                            <textarea class="ckeditor-basic" id="wbcke_1366359631" data-seo="description" name="description" cols="50"
                                rows="10"></textarea>
                            <span class="help-block"></span>
                        </div>


                        <div class="form-group text-editor">
                            <label class="">Nội dung</label>
                            <small class="help-block no-margin"></small>
                            <textarea class="form-control ckeditor-full ckeditor" id="wbcke_200072389" data-seo="content" name="content"
                                cols="50" rows="10"></textarea>
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
                                        <input id="thumbnail" name="thumbnail" type="hidden">
                                        <div class="media-item">
                                            <img class="img-thumbnail"
                                                data-no-image="https://via.placeholder.com/150x120&amp;text=No+Image"
                                                src="https://via.placeholder.com/150x120&amp;text=No+Image" width="150px"
                                                height="120px" id="holder_thumbnail" style="max-height: 100%">
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
                                        <input id="gallery" type="hidden" name="gallery" value="">
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
                                        value="" />
                                    <input class="hidden" name="price" type="number">
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-2 col-xs-4">
                                    <label>Giảm giá (%) </label>
                                    <input type="text" class="form-control format-number" data-value="percent"
                                        value="0" />
                                    <input class="hidden" name="percent" type="number" value="0">
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-5 col-xs-8">
                                    <div class="row form-group mb-10">
                                        <div class="col-xs-12">
                                            <label>Giá khuyến mãi (giá bán còn lại) (đ) </label>
                                            <input type="text" class="form-control format-number"
                                                data-value="price_sale" value="" />
                                            <input class="hidden" name="price_sale" type="number" value="">
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
                            <div class="col-xs-6 col-md-3">
                                <div class="form-group mb-0">
                                    <label for="Mã sản phẩm">M&atilde; Sản Phẩm</label>
                                    <input class="form-control" name="code" type="text" value="">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="form-group">
                                    <label for="Tình trạng kho">T&igrave;nh Trạng Kho</label>
                                    <select class="form-control" name="in_stock">
                                        <option value="1" selected="selected">Còn Hàng</option>
                                        <option value="0">Hết hàng</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="content-group">
                            <legend class="text-bold">Vận chuyển</legend>
                            <div class="form-group">
                                <div class="col-md-3 col-xs-12">
                                    <label for="Khối lượng (kg)">Khối Lượng (kg)</label>
                                    <input class="form-control" step="0.1" min="0"
                                        pattern="[0-9]+([\.,][0-9]+)?" name="weight" type="number" value="">
                                </div>
                                <div class="col-md-3 col-xs-4">
                                    <label for="Dài (m)">D&agrave;i (m)</label>
                                    <input class="form-control" step="0.1" placeholder="Dài" min="0"
                                        pattern="[0-9]+([\.,][0-9]+)?" name="length" type="number" value="">
                                </div>
                                <div class="col-md-3 col-xs-4">
                                    <label for="Rộng (m)">Rộng (m)</label>
                                    <input class="form-control" step="0.1" placeholder="Rộng" min="0"
                                        pattern="[0-9]+([\.,][0-9]+)?" name="width" type="number" value="0">
                                </div>
                                <div class="col-md-3 col-xs-4">
                                    <label for="Cao (m)">Cao (m)</label>
                                    <input class="form-control" step="0.1" placeholder="Cao" min="0"
                                        pattern="[0-9]+([\.,][0-9]+)?" name="height" type="number" value="">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">
                                Thuộc tính sản phẩm
                            </legend>
                            <div id="normalAttributeBox" class="">
                                <div class="form-group">
                                    <label for="Số phòng">Số Ph&ograve;ng</label>
                                    <select multiple="multiple" name="attribute_ids[]" bs-type="multiSelect">
                                        <option value="">Chọn Số phòng</option>
                                        <option value="2">2 </option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Hướng">Hướng</label>
                                    <select multiple="multiple" name="attribute_ids[]" bs-type="multiSelect">
                                        <option value="">Chọn Hướng</option>
                                        <option value="11">Đông</option>
                                        <option value="10">Tây</option>
                                        <option value="8">Nam</option>
                                        <option value="12">Bắc</option>
                                        <option value="7">Tây bắc</option>
                                        <option value="9">Đông Nam</option>
                                    </select>
                                </div>

                            </div>

                        </fieldset>
                    </div>
                </div>

            </div>
            <div class="order-2">
                <style>
                    .row .seo_result {
                        padding-left: 10px
                    }
                </style>
                <div class="panel panel-default" id="seoBox" data-type="detail">
                    <div class="panel-heading">
                        <h6 class="panel-title">Tối ưu SEO
                            <small class="display-block">Thiết lập các thẻ mô tả giúp khách hàng dễ dàng tìm thấy sản phẩm
                                trên công cụ
                                tìm kiếm như Google.
                            </small>
                        </h6>
                        <div class="heading-elements">
                            <div class="btn-group heading-btn">
                                <button type="button" class="btn bg-slate-300 btn-xs btn-ladda btn-ladda-spinne"
                                    id="generate_seo">Tạo
                                    SEO
                                </button>
                            </div>
                            <ul class="icons-list">
                                <li><a data-action="collapse" class=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="tiêu đề trang (<title>)">Ti&ecirc;u đề Trang (&lt;title&gt;)</label>
                            <label class="pull-right"><span id="count_meta_title"></span>/70 ký
                                tự</label>
                            <input class="form-control" data-seo="seo_title" name="meta_title" type="text">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="mô tả trang ( <meta description> )">M&ocirc; Tả Trang ( &lt;meta Description&gt;
                                )</label>
                            <label class="pull-right"><span id="count_meta_description"></span>/160
                                ký tự</label>
                            <textarea class="form-control" rows="5" data-seo="seo_description" name="meta_description" cols="50"></textarea>
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group-slug">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="text-capitalize">Đường dẫn (*)</label>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" bs-type="slug" bs-slug-from="title"
                                            data-seo="url" name="slug" value="">
                                        <span class="input-group-addon">
                                            <label class="checkbox-inline">
                                                <input name="has_other_link" id="has_other_link" type="checkbox"
                                                    value="1">
                                                Sử dụng đường dẫn khác
                                            </label>
                                        </span>
                                    </div>
                                    <span class="help-block"></span>
                                    <div class="collapse" id="other_link">
                                        <div class="input-group">
                                            <input type="text" class="form-control " name="other_link"
                                                value="">
                                            <span class="input-group-addon">
                                                <label class="checkbox-inline">
                                                    <input name="is_newtab_other_link" type="hidden" value="0">
                                                    <input name="is_newtab_other_link" type="checkbox" value="1">
                                                    Mở tab mới
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <fieldset class="content-group">
                            <legend class="text-bold">Khi lên top, page này sẽ hiển thị như sau:</legend>
                            <div class="form-group">
                                <h3 class="seo_title_google"
                                    style="color:#1a0dab;font-size: 18px;font-family: arial,sans-serif;padding:0;margin: 0;">
                                </h3>
                                <div style="color:#006621;font-size: 14px;font-family: arial,sans-serif;">
                                    <span class="prefix_url"></span><span class="slug_google"></span><span
                                        class="slug_google_extension"></span>
                                </div>
                                <div class="seo_description_google"
                                    style="color: #545454;font-size: small;font-family: arial,sans-serif;"></div>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <input bs-type="switch" data-on-text="Đang bật" data-off-text="Đang tắt" checked="checked"
                                name="robots" type="checkbox" value="1">
                            Index, Follow
                            <button type="button" class="btn btn-success pull-right" id="btnCheckSeo">Kiểm tra
                                SEO</button>
                        </div>
                        <div class="form-group" id="finalResult"></div>
                        <input name="seo_id" type="hidden">
                    </div>
                </div>
                <span class=""></span>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title">Cấu hình nâng cao</h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse" class="rotate-180"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Nút mua hàng</legend>
                            <div class="form-group">
                                <label>Chữ
                                </label>
                                <input class="form-control" placeholder="Nhập chữ hoặc để trống"
                                    name="config[btn_add_to_cart][text]" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label>Link
                                </label>
                                <input class="form-control" placeholder="http://..." name="config[btn_add_to_cart][link]"
                                    type="text">
                                <span class="help-block"></span>
                            </div>
                            <input type="hidden" name="config[btn_add_to_cart][ignore_shopping_cart]" value="0">
                            <div class="form-group">
                                <label for="" class="display-block"></label>
                                <label class="checkbox-inline">
                                    <input bs-type="checkbox" name="config[btn_add_to_cart][ignore_shopping_cart]"
                                        type="checkbox" value="1">
                                    Vào thẳng form đặt hàng
                                </label>
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
                            <input bs-type="checkbox" checked="checked" name="is_published" type="checkbox"
                                value="1">
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
                        <label for="Thể loại">Thể Loại</label>
                        <select class="form-control" name="cat_id">
                            <option value="297">

                                Dự án
                            </option>
                            <option value="298">
                                <span class="tree-icon">¦– –</span>
                                Nhà đất bán
                            </option>
                            <option value="302">
                                <span class="tree-icon">¦– –</span> <span class="tree-icon">¦– –</span>
                                Bán căn hộ chung cư
                            </option>
                            <option value="303">
                                <span class="tree-icon">¦– –</span> <span class="tree-icon">¦– –</span>
                                Bán nhà riêng
                            </option>
                            <option value="304">
                                <span class="tree-icon">¦– –</span> <span class="tree-icon">¦– –</span>
                                Bán nhà biệt thự, liền kề
                            </option>
                            <option value="305">
                                <span class="tree-icon">¦– –</span> <span class="tree-icon">¦– –</span>
                                Bán nhà mặt phố
                            </option>
                            <option value="299">
                                <span class="tree-icon">¦– –</span>
                                Nhà đất cho thuê
                            </option>
                            <option value="306">
                                <span class="tree-icon">¦– –</span> <span class="tree-icon">¦– –</span>
                                Cho thuê căn hộ chung cư
                            </option>
                            <option value="307">
                                <span class="tree-icon">¦– –</span> <span class="tree-icon">¦– –</span>
                                Cho thuê nhà riêng
                            </option>
                            <option value="308">
                                <span class="tree-icon">¦– –</span> <span class="tree-icon">¦– –</span>
                                Cho thuê nhà mặt phố
                            </option>
                            <option value="300">
                                <span class="tree-icon">¦– –</span>
                                Căn hộ, chung cư
                            </option>
                            <option value="301">
                                <span class="tree-icon">¦– –</span>
                                Cao ốc văn phòng
                            </option>
                            <option value="324">

                                Mua bán nhà đất lào cai
                            </option>
                            <option value="325">

                                Dự án
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Thể loại khác">Thể Loại Kh&aacute;c</label>
                        <select multiple="multiple" bs-type="multiSelect" class="selectized" name="other_cat_ids[]"
                            placeholder="Chọn Thể loại khác">
                            <option value="297">

                                Dự án
                            </option>
                            <option value="298">
                                <span class="tree-icon">¦––</span>
                                Nhà đất bán
                            </option>
                            <option value="302">
                                <span class="tree-icon">¦––</span> <span class="tree-icon">¦––</span>
                                Bán căn hộ chung cư
                            </option>
                            <option value="303">
                                <span class="tree-icon">¦––</span> <span class="tree-icon">¦––</span>
                                Bán nhà riêng
                            </option>
                            <option value="304">
                                <span class="tree-icon">¦––</span> <span class="tree-icon">¦––</span>
                                Bán nhà biệt thự, liền kề
                            </option>
                            <option value="305">
                                <span class="tree-icon">¦––</span> <span class="tree-icon">¦––</span>
                                Bán nhà mặt phố
                            </option>
                            <option value="299">
                                <span class="tree-icon">¦––</span>
                                Nhà đất cho thuê
                            </option>
                            <option value="306">
                                <span class="tree-icon">¦––</span> <span class="tree-icon">¦––</span>
                                Cho thuê căn hộ chung cư
                            </option>
                            <option value="307">
                                <span class="tree-icon">¦––</span> <span class="tree-icon">¦––</span>
                                Cho thuê nhà riêng
                            </option>
                            <option value="308">
                                <span class="tree-icon">¦––</span> <span class="tree-icon">¦––</span>
                                Cho thuê nhà mặt phố
                            </option>
                            <option value="300">
                                <span class="tree-icon">¦––</span>
                                Căn hộ, chung cư
                            </option>
                            <option value="301">
                                <span class="tree-icon">¦––</span>
                                Cao ốc văn phòng
                            </option>
                            <option value="324">

                                Mua bán nhà đất lào cai
                            </option>
                            <option value="325">

                                Dự án
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nh&agrave; Sản Xuất</label>
                        <select class="form-control" name="manufacturer_id">
                            <option value="0">Chưa có</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="nhóm sản phẩm">Nh&oacute;m Sản Phẩm</label>
                        <select multiple="multiple" bs-type="multiSelect" name="group_feature_ids[]">
                            <option selected="selected" value="">Chọn nhóm sản phẩm</option>
                            <option value="5">BÁN CHẠY</option>
                            <option value="7">Thành Phố Huế</option>
                            <option value="8">NHÀ ĐẤT NỔI BẬT</option>
                        </select>
                    </div>

                </div>
            </div>

            <input name="menu_id" type="hidden">
            <input name="taxonomy" type="hidden" value="product">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">Vị trí</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse" class=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <p>
                        <select class="form-control" name="province" id="province" data-type="string"
                            data-value="name" data-name="" data-message="Mời nhập tỉnh/thành phố, Cảm ơn !">
                            <option value="">Tỉnh / Thành Phố</option>
                        </select>
                    </p>
                    <p>
                        <select class="form-control" name="district" id="district" data-type="string"
                            data-value="name" data-name="" data-message="Mời nhập quận/huyện, Cảm ơn !"
                            data-action="https://dainghiagroup.com/api/province/distrist">
                            <option value="">Quận / Huyện</option>
                        </select>
                    </p>
                    <p>
                        <select class="form-control" name="ward" id="wb_ward" data-type="string" data-value="name"
                            data-name="" data-message="Mời nhập phường/xã, Cảm ơn !"
                            data-action="https://dainghiagroup.com/api/district/ward">
                            <option value="">Phường / Xã</option>
                        </select>
                    </p>
                    <p>
                        <select class="form-control" name="address" id="wb_address" data-type="string"
                            data-value="name" data-name="" data-message="Mời nhập địa chỉ, Cảm ơn !">
                            <option value="">Địa chỉ</option>
                        </select>
                    </p>
                    <p>
                        <select class="form-control" name="direction" id="direction" data-type="string"
                            data-value="name" data-name="" data-message="Mời nhập hướng, Cảm ơn !">
                            <option value="">Phương hướng</option>
                            <option value="east">Hướng Đông</option>
                            <option value="east_north">Hướng Đông Bắc</option>
                            <option value="east_south">Hướng Đông Nam</option>
                            <option value="west">Hướng Tây</option>
                            <option value="west_east">Hướng Tây Nam</option>
                            <option value="south">Hướng Nam</option>
                            <option value="north">Hướng Bắc</option>
                            <option value="west_north">Hướng Tây Bắc</option>
                        </select>
                    </p>

                </div>
            </div>



        </div>
    </form>
@endsection
