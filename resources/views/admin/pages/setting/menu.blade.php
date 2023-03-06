
<li class="{{$type == 'info' ? "active" : ""}}">
    <a href="{{ route('admin_setting/index') }}">
        <i class="icon-info22"></i> Thông tin website
    </a>
</li>
{{-- <li class="{{$type == 'general' ? "active" : ""}}">
    <a href="{{ route('admin_setting/index', ['type' => 'general']) }}">
        <i class="icon-info22"></i> Cấu hình chung
    </a>
</li> --}}
<li class="{{$type == 'contact' ? "active" : ""}}">
    <a href="{{ route('admin_setting/index', ['type' => 'contact']) }}">
        <i class="fa fa-address-book" aria-hidden="true"></i> Thông tin liên hệ
    </a>
</li>
