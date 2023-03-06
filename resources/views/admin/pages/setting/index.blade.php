@extends('admin.admin')
@section('navbar_title', 'Cấu hình chung')
@section('navbar-right')
    <li>
        <div style="padding:5px 0px 5px 5px">
            <button type="button" class="heading-btn btn btn-info btn-ladda btn-ladda-spinner" onclick="nav_submit_form(this)"
                data-style="zoom-in" data-form="setting-form"><span class="ladda-label">Lưu thay đổi</span></button>
        </div>
    </li>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="tabbable nav-tabs-vertical nav-tabs-left">
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        @include('admin.pages.setting.menu')
                    </ul>
                    <div class="tab-content">
                        @yield('setting_content')
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_table')
@endsection
