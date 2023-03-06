@extends('auth.auth')
@section('content')
    <form id="formLogin" data-url="{{ route('auth/postLogin') }}" data-type="user">
        <div class="panel panel-body login-form">
            <div class="text-center">
                <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i>
                </div>
                <h5 class="content-group">Đăng nhập hệ thống thành viên</h5>
            </div>
            <div class="form-group has-feedback">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" required class="form-control" placeholder="Tên đăng nhập"
                    value="" id="username">
            </div>
            <div class="form-group has-feedback">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" required class="form-control" placeholder="Mật khẩu" value="" id="password">
            </div>
            {{-- <div class="form-group login-options">
                <div class="row">
                    <div class="col-sm-6">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="remember" value="1"> Nhớ
                            mật khẩu
                        </label>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/password/reset">Quên mật khẩu?</a>
                    </div>
                </div>
            </div> --}}
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Đăng nhập
                    <i class="icon-circle-right2 position-right"></i></button>
            </div>
            <div class="form-group login-options text-center">
                <p>Chưa có tài khoản? <a href="{{route('auth/register')}}">Đăng ký ngay</a></p>
            </div>
        </div>
    </form>
@endsection
