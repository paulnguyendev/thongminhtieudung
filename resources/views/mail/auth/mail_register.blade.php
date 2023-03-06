@php
    use App\Helpers\Obn;
@endphp
<div
    style="background: #edf2f7;padding:30px;width:100%;height:100%;display:flex;align-items: center;justify-content: center;overflow: hidden;">
    <div style="background:#fff;padding:30px;border-radius:8px;width: 570px;margin:auto">
        <div style="text-align: center">
            <img style="width:200px;margin:auto;" src="{{Obn::get_logo()}}"
                alt="">
        </div>
        <p><strong>Xin chào</strong> {{$data['email']}}</p>
        <p>Chúc mừng bạn đã đăng ký tài khoản thành công</p>
        <p>Chỉ còn 1 bước nữa, vui lòng click vào nút kích hoạt tài khoản để hoàn tất thao tác! </p>
        <p style="text-align:center">
            <a href="{{route('auth/active',['token' => $data['token']])}}"
                style="padding:15px;background:{{config('obn.brand.color_main')}};border-radius:8px;color:#fff;text-decoration: none; display:inline-block;margin:auto">Kích hoạt tài
                khoản</a></p>
        <div style="text-align: center">
            <p>Hoặc tại liên kết sau: </p>
            <p><a href="{{route('auth/active',['token' => $data['token']])}}">{{route('auth/active',['token' => $data['token']])}}</a></p>
        </div>


    </div>

</div>
