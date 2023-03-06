<div class="navbar-header">
    <a class="navbar-brand" target="_blank" href="{{route('home/index')}}"><img
            src="{{ asset('obn-dashboard/img/logo.png') }}" alt=""></a>
    <a class="navbar-brand quick-view-icon" target="_blank" href="{{route('home/index')}}"><i
            class="icon-square-up-right"></i></a>
    <ul class="nav navbar-nav visible-xs-block">
        <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
    </ul>
</div>
<div id="navbar-mobile">
    <ul class="nav navbar-nav">
        <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
        </li>
    </ul>
    <ul class="nav navbar-nav hidden-xs">
        <li>
            <h5 class="hiden_1024_1350 hiden_768_1023">@yield('navbar_title','Quản lý chung')</h5>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right text-sm-right pr-sm-20 pl-sm-20">
       @yield('navbar-right')
    </ul>
</div>
