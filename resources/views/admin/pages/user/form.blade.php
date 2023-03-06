@extends('admin.admin')
@section('navbar_title', $title ?? "")
@section('navbar-right')
   
    <li>
        <div style="padding:5px 0px 5px 5px">
            <button type="button" class="heading-btn btn btn-info btn-ladda btn-ladda-spinner" onclick="nav_submit_form(this)"
                data-style="zoom-in" data-form="post-form"><span class="ladda-label">Lưu</span></button>
        </div>
    </li>
    <li>
        <a href="{{ route('admin_user/detail',['id' => $id]) }}" style="padding:5px 0px 5px 5px">
            <button class="btn btn-default heading-btn" type="button">Trở về</button>
        </a>
    </li>
@endsection
@section('content')
    <form method="POST" action="{{ route('admin_teacher/save') }}" accept-charset="UTF-8" id="post-form">
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
                        <label>Họ tên (*)
                        </label>
                        <input class="form-control" data-seo="title" name="name" type="text"
                            value="{{ $item['name'] ?? '' }}">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Tên tài khoản (*)
                        </label>
                        <input class="form-control" data-seo="title" name="username" type="text"
                            value="{{ $item['username'] ?? '' }}">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Email (*)
                        </label>
                        <input class="form-control" data-seo="title" name="email" type="text"
                            value="{{ $item['email'] ?? '' }}">
                        <span class="help-block"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Cấp độ (*)
                        </label>
                        <select name="level_id" id="" class="form-control">
                            <option value="">Cấp 1</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái
                        </label>
                        <select name="level_id" id="" class="form-control">
                            <option value="">Ngừng kích hoạt</option>
                            <option value="">Kích hoạt</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Người giới thiệu
                        </label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="">Cấp 1</option>
                        </select>
                        <span class="help-block"></span>
                    </div>

                </div>
            </div>
        </div>

        <input name="id" type="hidden" value="{{ $id }}">
    </form>
@endsection
