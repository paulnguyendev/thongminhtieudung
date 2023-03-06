@extends('admin.admin')
@section('navbar_title', "Quản lý {$title} / {$actionTitle}")
@section('navbar-right')
    <li>
        <a href="{{ route("{$controllerName}/index") }}" style="padding:5px 0px 5px 5px">
            <button class="btn btn-default heading-btn" type="button">Hủy</button>
        </a>
    </li>
    <li>
        <div style="padding:5px 0px 5px 5px">
            <button type="button" class="heading-btn btn btn-info btn-ladda btn-ladda-spinner" onclick="nav_submit_form(this)"
                data-style="zoom-in" data-form="supplier-form"><span class="ladda-label">Lưu</span></button>
        </div>
    </li>
@endsection
@section('content')
    <form method="POST" action="{{ route("{$controllerName}/save") }}" accept-charset="UTF-8" id="supplier-form">
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label>Tên nhà cung cấp (*)
                        </label>
                        <input class="form-control" data-seo="title" name="name" type="text" value="{{$item['name'] ?? ""}}">
                        <span class="help-block"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Số điện thoại (*)
                        </label>
                        <input class="form-control" name="phone" type="text" value="{{$item['phone'] ?? ""}}">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Email (*)
                        </label>
                        <input class="form-control" name="email" type="email" value="{{$item['email'] ?? ""}}">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ (*)
                        </label>
                        <input class="form-control" name="address" type="text" value="{{$item['address'] ?? ""}}">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">Hình đại diện</h6>
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
                            <img class="img-thumbnail" data-no-image="https://via.placeholder.com/150x120&amp;text=No+Image"
                                src="{{$item['thumbnail'] ?? "https://via.placeholder.com/150x120&amp;text=No+Image"}}" width="150px" height="120px"
                                id="holder_thumbnail" style="max-height: 100%">
                        </div>
                        <div class="clearfix"></div>
                        <a style="margin-top: 5px;margin-bottom: 3px" data-input="thumbnail" data-type="single"
                            data-preview="holder_thumbnail" id="lfm_thumbnail" class="btn ;btn-sm btn-default"
                            bs-type="filemanager">
                            Chọn hình
                        </a>
                    </div>
                </div>
            </div>
            <input name="id" type="hidden" value="{{$id}}">
        </div>
    </form>
@endsection
