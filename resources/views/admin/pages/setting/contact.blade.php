@php
    use App\Helpers\Obn;
@endphp
@extends('admin.pages.setting.index')
@section('setting_content')
    <fieldset class="content-group">
        <legend class="text-bold">Cấu hình trang liên hệ</legend>
        <form method="POST" action="{{$routeSave}}" accept-charset="UTF-8" id="setting-form"
            enctype="multipart/form-data"><input name="_token" type="hidden" value="bK2pH6LeXcDRLaPp0vcOfJQWheE5SofuJwIOlPJt">
            <div class="form-group">
                <label>Email
                </label>
                <input class="form-control" placeholder="Mặc định dainghiagroup.land@gmail.com" name="email"
                    type="text" value=" {{Obn::getSetting('email')}}">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label>Số điện thoại (Có thể nhập nhiều, mỗi số điện thoại cách nhau bởi dấu phẩy , )
                </label>
                <input class="form-control" name="phone" type="text" value="{{Obn::getSetting('phone')}}">
                <span class="help-block"></span>
            </div>
            <div class="form-group text-editor">
                <label class="">Địa chỉ</label>
                <small class="help-block no-margin"></small>
                <textarea class="form-control ckeditor-full ckeditor" id="wbcke_259146634" name="address" cols="50" rows="10">{{Obn::getSetting('address')}}</textarea>
                <span class="help-block"></span>
            </div>
            <div class="form-group text-editor">
                <label class="">Văn phòng</label>
                <small class="help-block no-margin"></small>
                <textarea class="form-control ckeditor-full ckeditor" id="wbcke_259146635" name="office" cols="50" rows="10">{{Obn::getSetting('office')}}</textarea>
                <span class="help-block"></span>
            </div>
            <div class="form-group text-editor">
                <label class="">Thông tin thanh toán</label>
                <small class="help-block no-margin"></small>
                <textarea class="form-control ckeditor-full ckeditor" id="wbcke_25914663412" name="payment_info" cols="50" rows="10">{{Obn::getSetting('payment_info')}}</textarea>
                <span class="help-block"></span>
            </div>
           
           
           
         
         
          
            <div class="form-group">
                <label>Bản đồ
                </label>
                <textarea class="form-control" rows="5" name="maps" cols="50">{{Obn::getSetting('maps')}}</textarea>
                <span class="help-block"></span>
            </div>
            
        </form>
    </fieldset>
@endsection
