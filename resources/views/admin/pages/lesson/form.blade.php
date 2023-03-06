@extends('admin.admin')
@section('navbar_title')
    {!! $courseTitleLink !!} / Quản lý {!! $title !!} / Tạo mới
@endsection
@section('script_table')
    <script src="https://static-demo.loveitopcdn.com/backend/js/item.select.js?v=1.2.7"></script>
    <script>
        $('select[name="cat_id"]').select2({
            placeholder: 'Chọn thể loại'
        });

        $('select[name="level_id"]').select2({
            placeholder: 'Chọn trình độ'
        });
        $('select[name="parent_id"]').select2({
            placeholder: 'Chọn bài học'
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
        $("#btnUploadVideo").click(function() {
            $("#videoInput").click();
        })
        $("#videoInput").change(function() {
            let url = $(this).data('url');
            const files = jQuery(this)[0].files[0];
            let form = new FormData();
            form.append("", files, "");

            console.log(files);
        })

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
    @if ($course_id)
        <li>
            <a href="{{ route("{$controllerName}/course_index", ['course_id' => $course_id]) }}"
                style="padding:5px 0px 5px 5px">
                <button class="btn btn-default heading-btn" type="button">Hủy</button>
            </a>
        </li>
    @else
        <li>
            <a href="{{ route("{$controllerName}/index") }}" style="padding:5px 0px 5px 5px">
                <button class="btn btn-default heading-btn" type="button">Hủy</button>
            </a>
        </li>
    @endif
    @if ($id)
        <li>
            <a href="{{ route("{$controllerName}/index") }}" style="padding:5px 0px 5px 5px">
                <button class="btn btn-danger heading-btn" type="button">Thêm tài liệu</button>
            </a>
        </li>
        <li>
            <a href="{{ route("{$controllerName}/index") }}" style="padding:5px 0px 5px 5px">
                <button class="btn btn-primary heading-btn" type="button">Danh sách tài liệu</button>
            </a>
        </li>
    @endif

    <li>
        <div style="padding:5px 0px 5px 5px">
            <button type="button" class="heading-btn btn btn-info btn-ladda btn-ladda-spinner"
                onclick="nav_submit_form(this)" data-style="zoom-in" data-form="post-form"><span
                    class="ladda-label">Lưu</span></button>
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
                        @if ($course_id)
                            <div class="form-group">
                                <label> Khóa học (*)
                                </label>
                                <input class="form-control" type="text" value="{{ $courseTitle ?? '' }}" readonly>
                                <input type="hidden" value="{{ $course_id ?? '' }}" name="course_id">
                                <span class="help-block"></span>
                            </div>
                        @else
                        @endif
                        <div class="form-group">
                            <label>Tên bài học (*)
                            </label>
                            <input class="form-control" data-seo="seo_keyword" name="title" type="text"
                                value="{{ $item['title'] ?? '' }}">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn bài học</label>
                            <select name="parent_id" class="form-control" id="">
                                @if (count($lessons) > 0)
                                    @foreach ($lessons as $lesson)
                                        @php
                                            $parent_id = $item['parent_id'] ?? '';
                                        @endphp
                                        <option value="">Chọn bài học</option>
                                        <option value="{{ $lesson['id'] ?? '' }}" {{ $parent_id == $lesson['id'] ? 'selected' : '' }}>{{ $lesson['title'] ?? '' }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline">
                                @php
                                    $is_try = $item['is_try'] ?? '';
                                @endphp
                                <input bs-type="checkbox" {{ $is_try == '1' ? 'checked' : '' }} name="is_try"
                                    type="checkbox" value="1">
                                Cho phép Học thử
                            </label>

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title">Video</h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse" class=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="">Video ID</label>
                            <input type="text" class="form-control" name="video" value="{{ $item['video'] ?? ' ' }}">
                            {{-- <input type="file" name="video" id="videoInput" class="hide" data-url="{{route('admin_bunny/uploadVideo')}}">
                            <button class="btn btn-default" id="btnUploadVideo" type="button" >Tải video</button> --}}
                        </div>
                        <div class="form-group">
                            <label for="">Video Youtube ( Dành cho khóa học free )</label>
                            <input type="text" class="form-control" name="video_youtube" value="{{ $item['video_youtube'] ?? ' ' }}">
                            
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title">Nội dung</h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse" class=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-editor">
                                    <label class="">Nội dung bài học</label>
                                    <small class="help-block no-margin"></small>
                                    <textarea class="form-control ckeditor-full ckeditor" id="wbcke_200072389" data-seo="content" name="content"
                                        cols="50" rows="10">{{ $item['content'] ?? '' }}</textarea>
                                    <span class="help-block"></span>
                                </div>
                                <span class="recommended-keyword-appear-time-label"></span>
                            </div>
                        </div>
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
                                $is_published = $item['is_published'] ?? '1';
                            @endphp
                            <input bs-type="checkbox" {{ $is_published == '1' ? 'checked' : '' }} name="is_published"
                                type="checkbox" value="1">
                            Hiện
                        </label>
                    </div>
                </div>
            </div>

        </div>
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="redirect" value="{{ $redirect }}">
    </form>
@endsection
