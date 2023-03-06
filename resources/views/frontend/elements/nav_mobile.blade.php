@php
    use App\Helpers\Package\CoursePackage;
@endphp
<nav id="navMobile" class="nav-mobile">
    <div class="navbar-wrap">
        <div class="navbar-burger">
            <i class="far fa-bars"></i>
        </div>
        <div class="navbar-brand logo">
            <a href="{{route('home/index')}}"><img width="120" height="auto"
                    src="{{asset('kyna/img/logo.png')}}"
                    class="img-fluid" /></a>
        </div>
        <div class="navbar-cart">
            <div class="navbar-cart_search">
                <i class="far fa-search"></i>
            </div>
            <div class="header-cart">
                <a href="{{route('fe_cart/index')}}">
                    <img src="https://cdn-skill.kynaenglish.vn/img/cart/cart.svg" width="24" height="24"
                        alt="Khóa học trực tuyến">
                    <span class="count-number none-item">0</span>
                </a>
                <ul class="dropdown-menu wrap clearfix">
                    <div class="hidden" id="items-id-in-current-cart" style="display: none"
                        data-all-cart-items=""></div>
                    <li class="clearfix wrap-form-cart k-add-to-cart-register" id="k-header-form-cart">
                        <p class="empty-cart">Giỏ hàng trống!</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="navbar-bottom">
        <div class="mobile-button-wrap">
            <a class="mobile-button-header mobile-button-header__outline" href="{{route('auth/register')}}" >Đăng ký</a>
        </div>
        <div class="mobile-button-wrap">
            <a href="{{route('auth/login')}}" class="mobile-button-header" >Đăng nhập
            </a>
        </div>
    </div>
    <!-- Menu Search Mobile -->
    <div id="nav-mobile-search" class="nav-mobile-search">
        <div class="inner">
            <form id="search-form" action="{{route('fe_course/category',['slug' => 'tim-kiem'])}}" method="get">
                <div class="input-group">
                    <input id="m-live-search-bar" name="q" type="text"
                        class="form-control live-search-bar" placeholder="Nhập tên khóa học/giảng viên">
                    <div class="list-suggest-category">
                        <a href="/tag/dau-tu-chung-khoan">
                            Đầu tư chứng khoán </a>
                        <a href="/tag/digital-marketing">
                            Digital Marketing </a>
                        <a href="/tag/seo">
                            SEO </a>
                        <a href="/tag/guitar">
                            Guitar </a>
                        <a href="/tag/photoshop-thiet-ke">
                            Đồ họa - Thiết kế </a>
                        <a href="/tag/khoa-hoc-duoc-yeu-thich-nhat">
                            Được yêu thích nhất </a>
                        <a href="/tag/hoc-kinh-doanh-2020">
                            Học Kinh doanh 2020 </a>
                        <a href="/tag/khoa-hoc-moi">
                            Khoá học mới </a>
                        <a href="/tag/ky-nang-mem">
                            Kỹ năng mềm </a>
                        <a href="/tag/hoc-lam-lanh-dao">
                            Học làm lãnh đạo </a>
                    </div>
                </div>
            </form>
            <div id="m-live-search-result" class="live-search-result"></div>
        </div>
    </div>
    <!-- End Search mobile-->
    <!-- Left sidebar -->
    <div class="header-left-menu">
        <div class="btn-close">
            <i class="fal fa-times"></i>
        </div>
        <div class="inner">
            <div class="list-category list-category-parent-js">
                {{-- {!!  CoursePackage::showCategory('mobile') !!} --}}
            </div>
            <div class="header-child-category">
                <div class="go-back nav-header">
                    <i class="far fa-chevron-left"></i>Trở về
                </div>
                <div class="list-category">
                    <!--     Render by js         -->
                </div>
            </div>
        </div>
    </div>
    <!-- End left sidebar-->
</nav>