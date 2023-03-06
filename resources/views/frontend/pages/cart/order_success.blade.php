@php
    use App\Helpers\Obn;
@endphp
@extends('frontend.main')
@section('title', 'Đặt hàng thành công')
@section('navbar_title', 'Đặt hàng thành công')
@section('content')
    <div class="page-order">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-body text-center">
                    @php
                        // SDT 0968686868 Nguyen Thi Huong Lan nguyenthihuonglan.gmail.com DH 2313123
                        $fullname = Obn::convert_vi_to_en($info_order['fullname']) ?? '';
                        $phone = $info_order['phone'] ?? '';
                        $email = str_replace('@', '.', $info_order['email']) ?? '';
                        $content = "SDT {$phone} {$fullname} {$email} DH {$code}";
                        
                    @endphp
                    <h2>Đặt hàng thành công</h2>
                    <p> Cảm ơn quý khách {{ $info_order['fullname'] ?? '' }} đã đặt hàng tại Website.</p>
                    <p> Đơn hàng của quý khách đã được tiếp nhận, chúng tôi sẽ xử lý trong khoảng thời gian sớm nhất.</p>
                    <p><strong><i>Nội dung chuyển khoản:</i></strong></p>
                    <div class="order-success-content">
                    <p>{{ $content }}</p>
                </div>
                        <a href="{{ route('home/index') }}" class="btn btn-primary"> Về trang chủ</a>
                    

                </div>
            </div>
        </div>
    </div>
@endsection
