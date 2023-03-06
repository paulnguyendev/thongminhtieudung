@php
    use App\Helpers\User;
    use App\Helpers\Package\AffiliatePackage;
@endphp
<div class="navbar-header">
    <a class="navbar-brand" href="{{ route('user/index') }}"><img src="{{ asset('obn-dashboard/img/logo.png') }}"
            alt=""></a>
    <a class="navbar-brand quick-view-icon" target="_blank" href="{{ route('home/index') }}"><i
            class="icon-square-up-right"></i></a>
    <ul class="nav navbar-nav visible-xs-block">
        <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
    </ul>
</div>
<div id="navbar-mobile">
    {{-- <ul class="nav navbar-nav">
        <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
        </li>
    </ul> --}}
    <ul class="nav navbar-nav hidden-xs">
        <li>
            <h5 class="hiden_1024_1350 hiden_768_1023">@yield('navbar_title', 'Quản lý chung')</h5>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right text-sm-right pr-sm-20 pl-sm-20">

        {{-- <li class="dropdown">
            <a href="{{route('cart/index')}}"  aria-expanded="false">
                <i class="icon-cart5"></i> <span class="hiden_1024_1350">Giỏ hàng (<span id="cartTotal">{{Cart::count()}}</span>)</span>
            </a>
        </li> --}}
        <li><a href="{{ route('user_profile/form') }}"><i class="icon-user"></i> <span
                    class="hiden_1024_1350">{{ User::getInfo('', 'email') }}</span></a>
        </li>
        <li><a href="{{route('user_aff/commission',['status' => 'active'])}}"><i class="icon-coin-dollar"></i> <span
            class="hiden_1024_1350">{{AffiliatePackage::getBalance()}}</span></a>
</li>

        <li><a href="{{ route('auth/logout') }}"><i class="icon-switch2"></i> <span
                    class="hiden_1024_1350">Thoát</span></a></li>
    </ul>
</div>
