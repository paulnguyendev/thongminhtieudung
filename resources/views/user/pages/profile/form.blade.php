@extends('user.main')
@section('navbar_title', "Quản lý {$title} / {$actionTitle}")
@section('navbar-right')
    <li>
        <a href="{{ route('user/index') }}" style="padding:5px 0px 5px 5px">
            <button class="btn btn-default heading-btn" type="button">Hủy</button>
        </a>
    </li>
    <li>
        <div style="padding:5px 0px 5px 5px">
            <button type="button" class="heading-btn btn btn-info btn-ladda btn-ladda-spinner" onclick="nav_submit_form(this)"
                data-style="zoom-in" data-form="profile-form"><span class="ladda-label">Lưu</span></button>
        </div>
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('status_success'))
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                            class="sr-only">Close</span>
                    </button>
                    {{ session('status_success') }}
                </div>
            @endif
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Thay đổi thông tin<a class="heading-elements-toggle"><i
                                class="icon-more"></i></a>
                    </h6>
                </div>
                <div class="panel-body">
                    <form id="profile-form" action="{{ route("{$controllerName}/save") }}" method="POST"
                        data-bitwarden-watching="1">
                        <div class="form-group">
                            <label>Họ tên
                            </label>
                            <input class="form-control" name="name" type="text" value="{{ $info['name'] ?? '' }}">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="Email">Tên đăng nhập</label>
                            <input class="form-control" name="username" type="text"
                                value="{{ $info['username'] ?? '' }}">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="Email">Số điện thoại</label>
                            <input class="form-control" name="phone" type="text"
                                value="{{ $info['phone'] ?? '' }}">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <a data-toggle="collapse" href="#change_password" class="collapsed" aria-expanded="false">Thay
                                đổi mật khẩu</a>
                        </div>
                        <div id="change_password" class="form-group collapse" aria-expanded="false" style="height: 0px;">
                            <div class="form-group">
                                <label for="Mật khẩu">Mật Khẩu</label>
                                <input class="form-control" name="password" type="password">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 no-padding-left">
                                    <label>Mật khẩu mới</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6 no-padding-right">
                                    <label>Nhập lại mật khẩu mới</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="heading-btn btn btn-info btn-ladda btn-ladda-spinner"
                                onclick="nav_submit_form(this)" data-style="zoom-in" data-form="profile-form"><span
                                    class="ladda-label">Lưu</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_srcipt')
    <script>
        function nav_submit_form(btn) {
            var l = Ladda.create(btn);
            l.start();
            var formSubmit = $('#' + $(btn).data('form'));
            formSubmit.ajaxSubmit({
                beforeSerialize: function() {
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                    return true;
                },
                beforeSubmit: function(formData, formObject, formOptions) {
                    $('input[bs-type="singleDatePicker"]').each(function() {
                        if ($(this).val() != '') {
                            formData.push({
                                'name': $(this).attr('name'),
                                'value': moment($(this).val(), 'DD-MM-YYYY HH:mm:ss').format(
                                    'YYYY-MM-DD HH:mm:ss')
                            });
                        }
                    });
                    var data_attributes = [];
                    for (var i = 0; i < formData.length; i++) {
                        if (formData[i]['name'].indexOf('attribute[') !== -1) {
                            data_attributes.push(formData[i]);
                            formData.splice(i, 1);
                            i--;
                        }
                    }
                    formData.push({
                        'name': 'data_attributes',
                        'value': JSON.stringify(data_attributes),
                    });
                },
                success: function(data) {
                    l.stop();
                    if (data.success !== 'unfriended') {
                        if (data.success == false) {
                            warningNotice(data.message);
                            return;
                        }
                    }
                    if (!data.redirect) {
                        successNotice('Cập nhật thành công');
                    } else {
                        $(window).unbind('beforeunload');
                        var menu_redirect = "";
                        location.href = menu_redirect ? menu_redirect : data.redirect;
                    }
                },
                error: function(data) {
                    console.log(data);
                    l.stop();
                    WBForm.showError(formSubmit, data);
                }
            });
        }
    </script>
@endsection
