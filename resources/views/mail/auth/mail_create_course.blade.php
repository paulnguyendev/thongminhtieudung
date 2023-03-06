@php
    use App\Helpers\Obn;
@endphp
<div
    style="background: #edf2f7;padding:30px;width:100%;height:100%;display:flex;align-items: center;justify-content: center;overflow: hidden;">
    <div style="background:#fff;padding:30px;border-radius:8px;width: 570px;margin:auto">
        <div style="text-align: center">
            <img style="width:200px;margin:auto;" src="{{ Obn::get_logo() }}" alt="">
        </div>
        <p><strong>Xin chào</strong> {{ $data['email'] }}</p>
        <p>Chúc mừng bạn, tài khoản của bạn đã được thêm khóa học thành công, bạn vui lòng đăng nhập vào tài khoản hiện
            tại để kiểm tra</p>
        <p>Danh sách khóa học đã được thêm: </p>
        @php
            $courses = $data['course'] ?? [];
        @endphp
        @if (count($courses) > 0)
            <ul>
                @foreach ($courses as $item)
                    <li>{{ $item['title'] ?? '-' }}</li>
                @endforeach
            </ul>
        @endif
        <p>Nếu có vấn đề gì cần trao đổi thêm, bạn có thể liên hệ với RPA qua kênh hỗ trợ.</p>
    </div>
</div>
