@php
    use App\Helpers\User;
@endphp
@extends('auth.auth')
@section('title', 'Đăng Ký Tài Khoản')
@section('content')
    <form method="POST" autocomplete="off" id="formRegister" data-url="{{ route('auth/postRegister') }}">
        <input type="hidden" name="_token" value="NN2qLcQhx0Cv4lMh5Wl8yaKE7XXEdhqtl2VyI22q">
        <div class="panel panel-body login-form">
            <div class="text-center">
                <h5 class="content-group">ĐĂNG KÝ TÀI KHOẢN</h5>
            </div>
            <div class="form-group has-feedback">
                <label for="name">Họ tên <span class="text-danger">(*)</span></label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nhập họ & tên của bạn"
                    autocomplete="false">
            </div>
            <div class="form-group has-feedback">
                <label for="username">Tên đăng nhập <span class="text-danger">(*)</span></label>
                <input type="text" id="username" name="username" class="form-control"
                    placeholder="Nhập tên đăng nhập của bạn" autocomplete="false">
            </div>
            <div class="form-group has-feedback">
                <label for="password">Mật khẩu <span class="text-danger">(*)</span></label>
                <input type="password" id="password" name="password" class="form-control"
                    placeholder="Nhập mật khẩu của bạn" autocomplete="false">
            </div>
            <div class="form-group has-feedback">
                <label for="email">Email <span class="text-danger">(*)</span></label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email của bạn"
                    autocomplete="false">
            </div>
            <div class="form-group has-feedback">
                <label for="phone">Số điện thoại <span class="text-danger">(*)</span></label>
                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại của bạn"
                    autocomplete="false">
            </div>
            <div class="form-group has-feedback">
                <label for="parent_code">Mã giới thiệu <span class="text-danger">(*)</span></label>
                <input type="text" id="parent_code" name="parent_code" class="form-control"
                    placeholder="Nhập mã giới thiệu của bạn" autocomplete="false" value="{{User::getAffInfo('aff_user_code') ?? ""}}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Đăng ký
                    <i class="icon-circle-right2 position-right"></i></button>
            </div>
            <div class="form-group login-options text-center">
                <p>Đã có tài khoản? <a href="{{ route('auth/login') }}">Đăng nhập ngay</a></p>
            </div>
        </div>
    </form>
@endsection
