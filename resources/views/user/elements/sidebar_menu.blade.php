@php
    use App\Helpers\Template\Product;
    use App\Helpers\Link\ProductLink;
    use App\Helpers\User;
    use App\Helpers\Package\AffiliatePackage;
    $suppliers = Product::getListSupplier();
    $user_id = User::getInfo('', 'id');
    $code = User::getInfo('', 'code');
    $level = User::getInfo('', 'level');
    $checkAffiliate = User::checkAffiliate($user_id);
    $levelName = User::getCurrentLevel($level);
@endphp
<div class="category-content no-padding">
    @if ($checkAffiliate == 1)
        <div class="sidebar-info">
            <div class="sidebar-info-title"><strong>Thông tin tài khoản</strong>
                @if ($levelName)
                    <span class="badge badge-primary"> {{ $levelName }} </span>
                @endif

            </div>
            <div class="sidebar-info-body">
                <div>Mã giới thiệu</div>
                <div class="sidebar-info-code">
                    <span>{{ $code }}</span>
                    <a data-href="{{ $code ?? '' }}" class="btn btn-success btn-xs copy-affiliate-url">Copy</a>
                </div>
            </div>
        </div>
    @endif
    <ul class="navigation navigation-main navigation-accordion">
        <li data-label="Quản Lý Chung">
            <a href="{{ route('user/index') }}">
                <i class="icon-home4"></i>
                <span>Quản Lý Chung</span>
            </a>
        </li>
        @if ($checkAffiliate == 1)
            <li data-label="Quản Lý Bài Viết">
                <a href="javascript:void(0)">
                    <i class="icon-users"></i>
                    <span>Quản lý Affiliate</span>
                </a>
                <ul class="second-menu-level">
                    <li>
                        <a href="{{ route('user_aff/index') }}">
                            <span>Danh sách thành viên</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user_aff/form') }}">
                            <span>Nhập mã giới thiệu </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user_aff/commission') }}">
                            <span>Hoa hồng </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user_aff/withdraw') }}">
                            <span>Rút tiền </span>
                        </a>
                    </li>
                    {{-- <li>
                    <a href="{{ route('user_order/income') }}">
                        <span>Doanh thu</span>
                    </a>
                </li> --}}
                </ul>
            </li>
        @endif
        <li data-label="Quản Lý Chung">
            <a href="{{ route('user_order/index') }}">
                <i class="icon-folder"></i>
                <span>Đơn hàng</span>
            </a>
        </li>
        <li data-label="Quản Lý Chung">
            <a href="{{ route('user_course/index') }}">
                <i class="icon-price-tag2"></i>
                <span>Khu vực học tập</span>
            </a>
        </li>
        <li data-label="Quản Lý Bài Viết">
            <a href="javascript:void(0)">
                <i class="icon-ticket"></i>
                <span>Hỗ trợ</span>
            </a>
            <ul class="second-menu-level">
                <li>
                    <a href="{{ route('user_ticket/form') }}">
                        <span>Tạo yêu cầu hỗ trợ </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user_ticket/index') }}">
                        <span>Danh sách hỗ trợ</span>
                    </a>
                </li>
            </ul>
        </li>
        <li data-label="Tài khoản">
            <a href="{{ route('user_profile/form') }}">
                <i class="icon-info3"></i>
                <span>Tài khoản</span>
            </a>
        </li>
        <li data-label="Đăng xuất">
            <a href="{{ route('auth/logout') }}">
                <i class="icon-switch2"></i>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</div>
