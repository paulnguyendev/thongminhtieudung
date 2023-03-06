@php
    use App\Helpers\User;
@endphp
<div class="navbar-header">
    <a class="navbar-brand" href="{{ route('home/index') }}"><img src="{{ asset('obn-dashboard/img/logo.png') }}"
            alt=""></a>
    <a class="navbar-brand quick-view-icon" target="_blank" href="{{ route('home/index') }}"><i
            class="icon-square-up-right"></i></a>
    <ul class="nav navbar-nav visible-xs-block">
        <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
    </ul>
</div>
<div id="navbar-mobile">

    <ul class="nav navbar-nav hidden-xs">
        <li>
            <h5 class="hiden_1024_1350 hiden_768_1023">@yield('navbar_title', 'Nền tảng kinh doanh 0 đ')</h5>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right text-sm-right pr-sm-20 pl-sm-20">

        <li class="dropdown">
            <a href="{{ route('fe_cart/index') }}" aria-expanded="false">
                <i class="icon-cart5"></i> <span class="hiden_1024_1350">Giỏ hàng (<span
                        id="cartTotal">{{ Cart::instance('frontend')->count() }}</span>)</span>
            </a>
        </li>
        @if (session()->has('userInfo'))
            <li class="dropdown mr-5">

               <a href="{{route('user/index')}}">Xin chào {{User::getInfo('','name') ?? ""}}</a>
            </li>
            <li class="dropdown mr-5">

                <a href="{{ route('auth/logout') }}" class="btn btn-primary" id="btnLogin">
                    Đăng xuất
                </a>
            </li>
        @else
            <li class="dropdown mr-5">
                <a href="{{ route('auth/login') }}" class="btn btn-primary" id="btnLogin">
                    Đăng nhập
                </a>
            </li>
        @endif

        <li class="dropdown ">
            <a href="{{ route('auth/register') }}" class="btn btn-info" id="btnLogin">
                Đăng ký
            </a>
        </li>

    </ul>
</div>
