<ul class="navigation navigation-main navigation-accordion">
    <li data-label="Quản Lý Chung">
        <a href="{{ route('admin/index') }}">
            <i class="icon-home4"></i>
            <span>Quản Lý Chung</span>
        </a>
    </li>
    <li data-label="Quản Lý Bài Viết">
        <a href="javascript:void(0)">
            <i class="icon-price-tag2"></i>
            <span>Quản lý Sản phẩm</span>
        </a>
        <ul class="second-menu-level">
            <li>
                <a href="{{route('product/form')}}">
                    <span>Tạo Sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="{{route('product/index')}}">
                    <span>Tất cả sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="{{route('productCategory/index')}}">
                    <span>Danh mục Sản phẩm</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{route('supplier/index')}}">
                    <span>Danh sách nhà cung cấp</span>
                </a>
            </li> --}}
        </ul>
    </li>
    {{-- <li data-label="Quản Lý Bài Viết">
        <a href="javascript:void(0)">
            <i class="icon-price-tag2"></i>
            <span>Quản lý khóa học</span>
        </a>
        <ul class="second-menu-level">
            <li>
                <a href="{{ route('admin_course/form') }}">
                    <span>Tạo khóa học</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin_course/index') }}">
                    <span>Tất cả khóa học</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin_courseCategory/index') }}">
                    <span>Danh mục khóa học</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin_teacher/index') }}">
                    <span>Danh sách giáo viên</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin_level/index') }}">
                    <span>Danh sách trình độ</span>
                </a>
            </li>
        </ul>
    </li> --}}
    {{-- <li data-label="Quản Lý Bài Viết">
        <a href="javascript:void(0)">
            <i class="icon-price-tag2"></i>
            <span>Quản lý combo</span>
        </a>
        <ul class="second-menu-level">
            <li>
                <a href="{{ route('admin_combo/form') }}">
                    <span>Tạo combo</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin_combo/index') }}">
                    <span>Tất cả combo</span>
                </a>
            </li>
        </ul>
    </li> --}}
    <li data-label="Quản Lý Bài Viết">
        <a href="javascript:void(0)">
            <i class="icon-price-tag2"></i>
            <span>Quản lý bài viết</span>
        </a>
        <ul class="second-menu-level">
            <li>
                <a href="{{ route('admin_post/form') }}">
                    <span>Tạo bài viết</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin_post/index') }}">
                    <span>Tất cả bài viết</span>
                </a>
            </li>
        </ul>
    </li>
    {{-- <li data-label="Quản Lý Bài Viết">
        <a href="javascript:void(0)">
            <i class="icon-magazine"></i>
            <span>Quản Lý Bài Viết</span>
        </a>
        <ul class="second-menu-level">
            <li>
                <a href="#">
                    <span>Tạo bài viết</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span>Tất cả bài viết</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span>Danh mục bài viết</span>
                </a>
            </li>
        </ul>
    </li> --}}
    <li data-label="Quản Lý Bán Hàng">
        <a href="javascript:void(0)" class="has-ul admin-menu-active">
            <i class="icon-cart5"></i>
            <span>Quản Lý Bán Hàng</span>
        </a>
        <ul class="second-menu-level">
            {{-- <li>
                <a href="#">
                    <span>Tạo đơn hàng mới</span>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('admin_order/index') }}">
                    <span>Quản lý đơn hàng</span>
                </a>
            </li>
            {{-- <li>
                <a href="#">
                    <span>Quản lý tồn kho</span>
                </a>
            </li> --}}
        </ul>
    </li>
    <li data-label="Affiliate">
        <a href="javascript:void(0)" class="has-ul admin-menu-active">
            <i class="icon-link"></i>
            <span>Affiliate</span>
        </a>
        <ul class="second-menu-level">
            <li>
                <a href="{{ route('admin_user/index') }}">
                    <span>Danh sách tài khoản</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin_transaction/index') }}">
                    <span>Danh sách thanh toán</span>
                </a>
            </li>
            {{-- <li>
                <a href="#">
                    <span>Yêu cầu rút tiền</span>
                </a>
            </li> --}}
            {{-- <li>
                <a href="#">
                    <span>Cấu hình</span>
                </a>
            </li> --}}
        </ul>
    </li>
    <li data-label="Tài khoản">
        <a href="{{ route('admin_profile/form') }}">
            <i class="icon-info3"></i>
            <span>Tài khoản</span>
        </a>
    </li>
    <li data-label="Cấu Hình Website" >
        <a href="{{route('admin_setting/index')}}">
            <i class="icon-gear"></i>
            <span>Cấu Hình Website</span>
        </a>
    </li>
    <li data-label="Đăng xuất">
        <a href="{{ route('admin_auth/logout') }}">
            <i class="icon-switch2"></i>
            <span>Đăng xuất</span>
        </a>
    </li>
</ul>
