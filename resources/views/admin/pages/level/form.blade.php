@extends('admin.admin')
@section('navbar_title', 'Danh sách giáo viên / Tạo mới')
@section('navbar-right')
    <li>
        <a href="{{ route('admin_level/index') }}" style="padding:5px 0px 5px 5px">
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
    <form method="POST" action="{{ route('admin_level/save') }}" accept-charset="UTF-8" id="post-form">
        <input name="_token" type="hidden" value="lGm8QXeWUIPrvDtkFZJbmCCGxuAhg8IudqnIWf5Z">
        <style type="text/css">
            #cke_wbcke_1531780663 {
                display: none;
            }
        </style>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label>Tên trình độ (*)
                        </label>
                        <input class="form-control" data-seo="title" name="title" type="text" value="{{$item['title'] ?? ""}}">
                        <span class="help-block"></span>
                    </div>
                    <input name="id" type="hidden" value="{{$id}}">
                   
                   
                </div>
            </div>
        </div>
      
    </form>
@endsection
