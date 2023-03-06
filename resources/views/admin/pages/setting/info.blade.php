@php
    use App\Helpers\Obn;
@endphp
@extends('admin.pages.setting.index')
@section('setting_content')
<form method="POST" action="{{$routeSave}}" accept-charset="UTF-8" id="setting-form"
enctype="multipart/form-data"><input name="_token" type="hidden" value="bK2pH6LeXcDRLaPp0vcOfJQWheE5SofuJwIOlPJt">
<fieldset class="content-group">
    <legend class="text-bold">Thông tin Website</legend>
  
    <div class="form-group">
        <label>Tên Website
        </label>
        <input class="form-control" name="website_name" type="text" value="{{Obn::getSetting('website_name')}}">
        <span class="help-block"></span>
    </div>
    <div class="form-group row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">Logo (210x70)</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse" class=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="single-media text-center">
                        <input id="logo" name="logo" type="hidden" value="{{Obn::getSetting('logo')}}">
                        <div class="media-item">
                            <img class="img-thumbnail"
                                data-no-image="https://via.placeholder.com/210x70&amp;text=No+Image"
                                src="{{Obn::getSetting('logo')}}" width="210px" height="70px" id="holder_logo"
                                style="max-height: 100%">
                        </div>
                        <div class="clearfix"></div>
                        <a style="margin-top: 5px;margin-bottom: 3px" data-input="logo" data-type="single"
                            data-preview="holder_logo" id="lfm_logo" class="btn ;btn-sm btn-default"
                            bs-type="filemanager">
                            Chọn hình
                        </a>
                        <div class="clearfix"></div>
                        <a href="javascript:void(0)" class="text-danger remove-single-file"><u>Xóa hình</u></a>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">Favicon (32x32)</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse" class=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="single-media text-center">
                        <input id="icon" name="icon" type="hidden" value="{{Obn::getSetting('icon')}}" >
                        <div class="media-item">
                            <img class="img-thumbnail"
                                data-no-image="https://via.placeholder.com/32x32&amp;text=No+Image"
                                src="{{Obn::getSetting('icon')}}" width="32px" height="32px" id="holder_icon"
                                style="max-height: 100%">
                        </div>
                        <div class="clearfix"></div>
                        <a style="margin-top: 5px;margin-bottom: 3px" data-input="icon" data-type="single"
                            data-preview="holder_icon" id="lfm_icon" class="btn ;btn-sm btn-default"
                            bs-type="filemanager">
                            Chọn hình
                        </a>
                        <div class="clearfix"></div>
                        <a href="javascript:void(0)" class="text-danger remove-single-file"><u>Xóa hình</u></a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</fieldset>
<fieldset class="content-group">
    <legend class="text-bold">Seo mặc định</legend>
    @php
        $seo_default = Obn::getSetting('seo_default');
        $seo_default = json_decode($seo_default,true);
     
    @endphp
    <div class="form-group">
        <label>Tiêu đề
        </label>
        <input class="form-control" name="seo_default[meta_title]" type="text" value="{{$seo_default['meta_title'] ?? ""}}">
        <span class="help-block"></span>
    </div>

    <div class="form-group">
        <label>Mô tả ngắn về website (Meta Description)
        </label>
        <textarea class="form-control" rows="5" name="seo_default[meta_description]" cols="50">{{$seo_default['meta_description'] ?? ""}}</textarea>
        <span class="help-block"></span>
    </div>

    <div class="form-group">
        <label>Meta Keywords
        </label>
        <input class="form-control" name="seo_default[meta_keyword]" type="text"
            value="{{$seo_default['meta_keyword'] ?? ""}}">
        <span class="help-block"></span>
    </div>

    <div class="form-group">
        <input hidden name="seo_default[robots]" value="0">
        <input bs-type="switch" data-on-text="Đang bật" data-off-text="Đang tắt" {{$seo_default['robots'] == '1' ? "checked" : "" }} 
            name="seo_default[robots]" type="checkbox" value="{{$seo_default['robots']}}">
        Index, Follow
    </div>
</fieldset>
@php
$social = Obn::getSetting('social');
$social = json_decode($social,true);

@endphp
<fieldset id="settings-social" class="content-group">
    <legend class="text-bold">Liên kết mạng xã hội</legend>
    <div class="form-group">
        <label>Facebook
        </label>
        <input class="form-control" name="social[facebook]" type="text"
            value="{{$social['facebook'] ?? ""}}">
        <span class="help-block"></span>
    </div>
    
    <div class="form-group">
        <label>Youtube
        </label>
        <input class="form-control" name="social[youtube]" type="text" value="{{$social['youtube'] ?? ""}}">
        <span class="help-block"></span>
    </div>
    
 
   
   

    {{-- <p>Mạng xã hội khác</p>
    <div class="form-group row">
        <div class="col-sm-5">
            <input class="form-control" name="other_social_icon[]" value="" type="text"
                placeholder="Link icon hình">
        </div>
        <div class="col-sm-6">
            <input class="form-control" name="other_social_link[]" value="" type="text"
                placeholder="Link liên kết">
        </div>
        <div class="col-sm-1">
            <a id="new-icon-social" href="javascript:void(0)" title="Thêm dòng mới"
                style="font-size: 18px"><i class="fa fa-plus-circle" style="margin-top: 5px"></i></a>
        </div>
    </div> --}}

    <div id="area-new-social"></div>
</fieldset>

{{-- <fieldset id="setting-payment-method" class="content-group">
    <legend class="text-bold">Icon phương thức thanh toán</legend>
    <div class="form-group row">
        <div class="col-sm-4">
            <label class="checkbox-inline" style="margin-top: 10px">
                <input type="checkbox" bs-type="checkbox" checked name="payment_method[]" value="paypal">
                <img src="https://static.loveitopcdn.com/backend/images/payment/paypal.png"
                    style="max-width: 45px; height: 25px; margin-top: -5px">
                PayPal
            </label>
        </div>
        <div class="col-sm-6">
            <input class="form-control" name="payment_icon[paypal]" value="" type="text"
                placeholder="Link icon hình khác">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4">
            <label class="checkbox-inline" style="margin-top: 10px">
                <input type="checkbox" bs-type="checkbox" checked name="payment_method[]"
                    value="master_card">
                <img src="https://static.loveitopcdn.com/backend/images/payment/master-card.png"
                    style="max-width: 45px; height: 25px; margin-top: -5px">
                MasterCard
            </label>
        </div>
        <div class="col-sm-6">
            <input class="form-control" name="payment_icon[master_card]" value="" type="text"
                placeholder="Link icon hình khác">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4">
            <label class="checkbox-inline" style="margin-top: 10px">
                <input type="checkbox" bs-type="checkbox" checked name="payment_method[]" value="visa">
                <img src="https://static.loveitopcdn.com/backend/images/payment/visa.png"
                    style="max-width: 45px; height: 25px; margin-top: -5px">
                Visa
            </label>
        </div>
        <div class="col-sm-6">
            <input class="form-control" name="payment_icon[visa]" value="" type="text"
                placeholder="Link icon hình khác">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4">
            <label class="checkbox-inline" style="margin-top: 10px">
                <input type="checkbox" bs-type="checkbox" checked name="payment_method[]" value="jcb">
                <img src="https://static.loveitopcdn.com/backend/images/payment/jcb.png"
                    style="max-width: 45px; height: 25px; margin-top: -5px">
                JCB
            </label>
        </div>
        <div class="col-sm-6">
            <input class="form-control" name="payment_icon[jcb]" value="" type="text"
                placeholder="Link icon hình khác">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4">
            <label class="checkbox-inline" style="margin-top: 10px">
                <input type="checkbox" bs-type="checkbox" checked name="payment_method[]" value="cash">
                <img src="https://static.loveitopcdn.com/backend/images/payment/cash.png"
                    style="max-width: 45px; height: 25px; margin-top: -5px">
                Tiền mặt
            </label>
        </div>
        <div class="col-sm-6">
            <input class="form-control" name="payment_icon[cash]" value="" type="text"
                placeholder="Link icon hình khác">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4">
            <label class="checkbox-inline" style="margin-top: 10px">
                <input type="checkbox" bs-type="checkbox" checked name="payment_method[]"
                    value="internet-banking">
                <img src="https://static.loveitopcdn.com/backend/images/payment/internet-banking.png"
                    style="max-width: 45px; height: 25px; margin-top: -5px">
                Internet Banking
            </label>
        </div>
        <div class="col-sm-6">
            <input class="form-control" name="payment_icon[internet-banking]" value="" type="text"
                placeholder="Link icon hình khác">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4">
            <label class="checkbox-inline" style="margin-top: 10px">
                <input type="checkbox" bs-type="checkbox" checked name="payment_method[]"
                    value="installment">
                <img src="https://static.loveitopcdn.com/backend/images/payment/installment.png"
                    style="max-width: 45px; height: 25px; margin-top: -5px">
                Trả góp
            </label>
        </div>
        <div class="col-sm-6">
            <input class="form-control" name="payment_icon[installment]" value="" type="text"
                placeholder="Link icon hình khác">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4">
            <label class="checkbox-inline">
                <input type="checkbox" bs-type="checkbox" name="other_payment_method" value="1">
                Thanh toán khác
            </label>
        </div>
        <div class="col-sm-6">
            <input class="form-control" name="other_payment_icon[]" value="" type="text"
                placeholder="Link icon hình">
        </div>
        <div class="col-sm-1">
            <a id="new-icon" href="javascript:void(0)" title="Thêm dòng mới" style="font-size: 18px"><i
                    class="fa fa-plus-circle" style="margin-top: 5px"></i></a>
        </div>
    </div>
    <div id="area-new-icon"></div>
</fieldset> --}}
{{-- <fieldset class="content-group">
    <legend class="text-bold">Định dạng ngày giờ</legend>
    <div class="form-group">
        <select class="form-control" name="datetime_format">
            <option value="m/Y">m/Y (12/2017)</option>
            <option value="d/m/Y" selected>d/m/Y (31/12/2017)</option>
            <option value="d/m/Y H:i">d/m/Y H:i (31/12/2017 23:30)</option>
            <option value="Y/m">Y/m (2017/12)</option>
            <option value="Y/m/d">Y/m/d (2017/12/31)</option>
            <option value="Y/m/d H:i">Y/m/d H:i (2017/12/31 23:30)</option>
        </select>
    </div>
</fieldset> --}}

</form>
@endsection
@section('script_table')
    <script>
        $(document).on('click', '#new-icon', function() {
            var html = '<div class="row form-group row-icon">' +
                '<div class="col-sm-4"></div> ' +
                '<div class="col-sm-6">' +
                '<input class="form-control" name="other_payment_icon[]" value="" type="text" placeholder="Link icon hình khác">' +
                '</div> ' +
                '<div class="col-sm-1"><a class="remove-row" href="javascript:void(0)" title="Xóa dòng" style="font-size: 18px"><i class="fa fa-trash-o text-danger" style="margin-top: 5px"></i></a></div> ' +
                '</div>';
            $('#area-new-icon').append(html);
        });
        $(document).on('click', '.remove-row', function() {
            $(this).closest("div.row-icon").remove();
        })
        $(document).on('click', '#new-icon-social', function() {
            var html = '<div class="row form-group row-icon">' +
                '<div class="col-sm-5"><input class="form-control" name="other_social_icon[]" value="" type="text" placeholder="Link icon hình"></div> ' +
                '<div class="col-sm-6">' +
                '<input class="form-control" name="other_social_link[]" value="" type="text" placeholder="Link liên kết">' +
                '</div> ' +
                '<div class="col-sm-1"><a class="remove-row" href="javascript:void(0)" title="Xóa dòng" style="font-size: 18px"><i class="fa fa-trash-o text-danger" style="margin-top: 5px"></i></a></div> ' +
                '</div>';
            $('#area-new-social').append(html);
        });
    </script>
    <script type="text/javascript">
        $('#lfm_icon').mlibready({returnto:'#icon',maxselect:1,runfunction:'fillImage',maxFilesize:5});
        </script>
    
        <script type="text/javascript">
        $('#lfm_logo').mlibready({returnto:'#logo',maxselect:1,runfunction:'fillImage',maxFilesize:5});
        </script>
@endsection
