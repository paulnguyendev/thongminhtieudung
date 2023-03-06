@extends('admin.pages.setting.index')
@section('setting_content')
    <fieldset class="content-group">
        <legend class="text-bold">Cấu hình chung</legend>
        <form method="POST" action="{{$routeSave}}" accept-charset="UTF-8" id="setting-form"
            enctype="multipart/form-data"><input name="_token" type="hidden" value="bK2pH6LeXcDRLaPp0vcOfJQWheE5SofuJwIOlPJt">
            <div class="form-group">
                <label>Email
                </label>
                <input class="form-control" placeholder="Mặc định dainghiagroup.land@gmail.com" name="email"
                    type="text" value=" info@dainghiagroup.com">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label>Số điện thoại (Có thể nhập nhiều, mỗi số điện thoại cách nhau bởi dấu phẩy , )
                </label>
                <input class="form-control" name="phone" type="text" value="093 888 66 88">
                <span class="help-block"></span>
            </div>
            <div class="form-group text-editor">
                <label class="">Địa chỉ</label>
                <small class="help-block no-margin"></small>
                <textarea class="form-control ckeditor-full ckeditor" id="wbcke_259146634" name="address" cols="50" rows="10">Số 36 Đặng Trần Côn, Phường Cốc Lếu, Thành Phố Lào Cai, Tỉnh Lào Cai, Việt Nam</textarea>
                <span class="help-block"></span>
            </div>
            <input type="hidden" name="send_customer_contact_to_admin_email" value="0">
            <div class="form-group">
                <label for="" class="display-block"></label>
                <label class="checkbox-inline">
                    <input bs-type="checkbox" checked="checked" name="send_customer_contact_to_admin_email" type="checkbox"
                        value="1">
                    Gởi mail cho admin khi khách hàng liên hệ
                </label>
            </div>
            <input type="hidden" name="contact_captcha" value="0">
            <div class="form-group">
                <label for="" class="display-block"></label>
                <label class="checkbox-inline">
                    <input bs-type="checkbox" name="contact_captcha" type="checkbox" value="1">
                    Xác thực mã Captcha khi gởi thông tin
                </label>
            </div>
            <input type="hidden" name="contact_required_email" value="0">
            <div class="form-group">
                <label for="" class="display-block"></label>
                <label class="checkbox-inline">
                    <input bs-type="checkbox" name="contact_required_email" type="checkbox" value="1">
                    Form liên hệ bắt buộc nhập địa chỉ email
                </label>
            </div>
            <input type="hidden" name="contact_required_phone" value="0">
            <div class="form-group">
                <label for="" class="display-block"></label>
                <label class="checkbox-inline">
                    <input bs-type="checkbox" checked="checked" name="contact_required_phone" type="checkbox"
                        value="1">
                    Form liên hệ bắt buộc nhập số điện thoại
                </label>
            </div>
            <div class="form-group">
                <label>Đường dẫn trang cảm ơn sau khi khách hàng gởi liên hệ (mặc định hiển thị thông
                    báo)
                </label>
                <input class="form-control" name="contact_thankyou_link" type="text" value="">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label>Bản đồ
                </label>
                <textarea class="form-control" rows="5" name="maps" cols="50">&lt;iframe src=&quot;https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3686.244368572698!2d103.9651236!3d22.4950129!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x36cd139cb873ae31%3A0x33def7866a7c16f1!2zMzYgxJDhurduZyBUcuG6p24gQ8O0biwgQ-G7kWMgTOG6v3UsIFRYLkzDoG8gQ2FpLCBMw6BvIENhaQ!5e0!3m2!1svi!2s!4v1663940152285!5m2!1svi!2s&quot; width=&quot;600&quot; height=&quot;450&quot; style=&quot;border:0;&quot; allowfullscreen=&quot;&quot; loading=&quot;lazy&quot; referrerpolicy=&quot;no-referrer-when-downgrade&quot;&gt;&lt;/iframe&gt;</textarea>
                <span class="help-block"></span>
            </div>
            <div class="form-group text-center map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3686.244368572698!2d103.9651236!3d22.4950129!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x36cd139cb873ae31%3A0x33def7866a7c16f1!2zMzYgxJDhurduZyBUcuG6p24gQ8O0biwgQ-G7kWMgTOG6v3UsIFRYLkzDoG8gQ2FpLCBMw6BvIENhaQ!5e0!3m2!1svi!2s!4v1663940152285!5m2!1svi!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </form>
    </fieldset>
@endsection
