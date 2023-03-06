@extends('user.main')
@section('navbar_title', $navbar_title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
             
                <div class="panel-body">
                    @if ($parent_id)
                        <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                          
                            Bạn đã nhập mã giới thiệu thành công
                        </div>
                    @else
                        <form method="POST" action="{{ route("{$controllerName}/save") }}" accept-charset="UTF-8"
                            id="supplier-form">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Mã giới thiệu (*)
                                            </label>
                                            <input class="form-control" name="code" type="text"
                                                value="{{ $item['name'] ?? '' }}">
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group">
                                            <button type="button"
                                                class="heading-btn btn btn-info btn-ladda btn-ladda-spinner"
                                                onclick="nav_submit_form(this)" data-style="zoom-in"
                                                data-form="supplier-form"><span class="ladda-label">Xác nhận</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif

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
