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
        <p>Chúc mừng bạn, tài khoản của bạn đã được khởi tạo thành công</p>
        <p>Thông tin tài khoản: </p>
        <p>Tên đăng nhập: {{$data['email'] ?? ""}} </p>
        <p>Mật khẩu: {{$data['password'] ?? "-"}}</p>
    </div>
</div>
