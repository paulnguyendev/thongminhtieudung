@php
    use App\Helpers\Obn;
@endphp
@extends('user.main')
@section('navbar_title', $navbar_title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('status_success'))
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span>
                    </button>
                    {{ session('status_success') }}
                </div>
            @endif
            <div class="panel panel-flat">
                <div class="panel-body">
                    <form method="POST" action="{{ route("{$controllerName}/save") }}" accept-charset="UTF-8"
                        id="supplier-form">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    @if ($id)
                                        <div class="form-group">
                                            <label>Nội dung
                                            </label>
                                            <div class="ticket-desc">
                                                {!! $item['content'] ?? '' !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Số điện thoại: </label>
                                            <strong><a
                                                    href="tel:{{ $item['phone'] ?? '' }}">{{ $item['phone'] ?? '' }}</a></strong>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Trạng thái: </label>
                                            {!! Obn::showTicketStatus($item['status'] ?? '') !!}
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label>Tiêu đề
                                            </label>
                                            <input class="form-control" name="name" type="text"
                                                value="{{ $item['name'] ?? '' }}">
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại
                                            </label>
                                            <input class="form-control" name="phone" type="tel"
                                                value="{{ $phone ?? '' }}">
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Loại hỗ trợ
                                            </label>
                                            @php
                                                $types = config('obn.ticket.type');
                                            @endphp
                                            <select name="type" class="form-control">
                                                @foreach ($types as $key => $type)
                                                    @php
                                                        $currentType = $item['type'] ?? '';
                                                        $selected = $currentType == $key ? 'selected' : '';
                                                    @endphp
                                                    <option value="{{ $key }}" {{ $selected }}>
                                                        {{ $type['name'] ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    @endif
                                    <div class="form-group text-editor">
                                        <label class="">Nội dung cần hỗ trợ</label>
                                        <textarea class="ckeditor-basic" id="wbcke_1366359631" data-seo="content" name="content" cols="50" rows="10">{{ $item_meta['description'] ?? '' }}</textarea>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="heading-btn btn btn-info btn-ladda btn-ladda-spinner"
                                            onclick="nav_submit_form(this)" data-style="zoom-in"
                                            data-form="supplier-form"><span class="ladda-label">Gửi yêu cầu</span></button>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $id }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($items)
        @foreach ($items as $value)
            @php
                $user = $value->user()->first();
            @endphp
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ $user['name'] ?? '-' }}</h6>
                    <div class="heading-elements">
                        <span class="heading-text">{{$value['created_at'] ?? ""}}</span>
                    </div>
                </div>
                <div class="panel-body panel-flat">
                    {!! $value['content'] ?? "" !!}
                </div>
            </div>
        @endforeach
    @endif
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
        $('select[name="type"]').select2({
            placeholder: 'Chọn loại yêu cầu'
        });
    </script>
@endsection
