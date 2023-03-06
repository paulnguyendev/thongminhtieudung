@php
    use App\Helpers\Obn;
    use App\Helpers\Package\CoursePackage;
@endphp
@extends('frontend.main')
@section('content')
    <link rel="stylesheet" href="https://cdn-skill.kynaenglish.vn/css/search.css?v=1672900678">


    <!-- Breadcrumbs start -->
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'>
                    <a itemscope itemtype='http://schema.org/Thing' itemprop='item' id='https://skills.kynaenglish.vn/'
                        href='{{route('home/index')}}'>
                        <span itemprop='name'>Trang chủ</span>
                        <meta itemprop='url' content=https://skills.kynaenglish.vn />
                    </a>
                    <meta itemprop='position' content='1'>
                </li>
                <li><a href="{{route('fe_course/category')}}">Danh sách khóa học</a></li>
                <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem' class='active'>
                    <span itemprop='name'>{{$item['name']}}</span>
                    <meta itemprop='url' content='https://skills.kynaenglish.vn/danh-sach-khoa-hoc/sales-cskh'>
                    <meta itemprop='position' content='2'>
                </li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumbs end -->
    <main>
        <form id="facets-form" class="k-listing-filter form-inline" action="/danh-sach-khoa-hoc/sales-cskh" method="get">
            @if (Obn::checkDevice() == 'mobile')
                @section('body_class', 'mobile')
                {{-- Mobile --}}
                {{-- <div class="t-wrap-sort-mobile">
                    <div class="container">
                        <div class="t-wrap-btn">
                            <a href="javascript:" class="btn-listing-filter" id="t-btn-listing-filter">
                                <img src="https://cdn-skill.kynaenglish.vn/img/kyna-teach/icon-filter.svg" alt="icon">Bộ
                                lọc
                                <span class="t-total-sort" id="t-total-sort">0</span>
                            </a>
                            <a href="javascript:" class="btn-listing-sort" id="t-btn-listing-sort">
                                <img src="https://cdn-skill.kynaenglish.vn/img/kyna-teach/icon-sort.svg" alt="icon">Sắp
                                xếp
                            </a>
                        </div>
                    </div>
                    <div class="t-popup-filter">
                        <div class="t-header-popup-filter">
                            <a href="javascript:" class="t-btn-popup-filter-close" id="t-btn-popup-filter-close">
                                <img src="https://cdn-skill.kynaenglish.vn/img/icon-close.svg" alt="icon">
                            </a>
                            Bộ lọc
                        </div>
                        <div class="t-body-popup-filter">

                            <div class="checkbox">
                                <input id="facet-discount-0" type="checkbox" name="facets[discount][0]" value="0">
                                <label for="facet-discount-0">
                                    <span><span></span></span>Miễn phí </label>
                            </div>
                            <div class="checkbox">
                                <input id="facet-discount-1" type="checkbox" name="facets[discount][1]" value="1"
                                    data-com.bitwarden.browser.user-edited="yes">
                                <label for="facet-discount-1">
                                    <span><span></span></span>Khuyến mãi </label>
                            </div>
                            <div class="t-group-checkbox">
                                <h3 class="t-sub-title-popup-filter">Theo thời lượng:</h3>
                                <div class="checkbox">
                                    <input id="facet-time-0" type="radio" name="facets[time][value]" value="0">
                                    <label for="facet-time-0">
                                        <span><span></span></span>Dưới 3 tiếng </label>
                                </div>
                                <div class="checkbox">
                                    <input id="facet-time-1" type="radio" name="facets[time][value]" value="1">
                                    <label for="facet-time-1">
                                        <span><span></span></span>3 - 24 tiếng </label>
                                </div>
                                <div class="checkbox">
                                    <input id="facet-time-2" type="radio" name="facets[time][value]" value="2">
                                    <label for="facet-time-2">
                                        <span><span></span></span>1 - 3 ngày </label>
                                </div>
                                <div class="checkbox">
                                    <input id="facet-time-3" type="radio" name="facets[time][value]" value="3">
                                    <label for="facet-time-3">
                                        <span><span></span></span>Trên 3 ngày </label>
                                </div>
                            </div>
                            <div class="t-group-checkbox">
                                <h3 class="t-sub-title-popup-filter">Theo trình độ:</h3>
                                <div class="checkbox">
                                    <input id="facet-level-1" type="radio" name="facets[level][value]" value="1">
                                    <label for="facet-level-1">
                                        <span><span></span></span>Cơ bản </label>
                                </div>
                                <div class="checkbox">
                                    <input id="facet-level-2" type="radio" name="facets[level][value]" value="2">
                                    <label for="facet-level-2">
                                        <span><span></span></span>Nâng cao </label>
                                </div>
                                <div class="checkbox">
                                    <input id="facet-level-3" type="radio" name="facets[level][value]" value="3">
                                    <label for="facet-level-3">
                                        <span><span></span></span>Chuyên sâu </label>
                                </div>
                                <div class="checkbox">
                                    <input id="facet-level-4" type="radio" name="facets[level][value]" value="4">
                                    <label for="facet-level-4">
                                        <span><span></span></span>Mọi cấp độ </label>
                                </div>
                            </div>
                        </div>
                        <div class="t-wrap-btn-popup-filter">
                            <a href="javascript:" class="t-btn-popup-filter-cancel" id="t-btn-popup-filter-cancel">Hủy
                                bỏ</a>
                            <a href="javascript:" class="t-btn-popup-filter-update" id="t-btn-popup-filter-update">Cập
                                nhật</a>
                        </div>
                    </div>
                </div> --}}
            @else
            @section('body_class', 'desktop')
            <!-- Desktop -->
            {{-- <div class="container">
                <div class="t-wrap-sort">
                    <div class="t-left-sort">
                        <a href="javascript:" class="btn-listing-filter"><img
                                src="https://cdn-skill.kynaenglish.vn/img/kyna-teach/icon-filter.svg"
                                alt="icon">Bộ
                            lọc:</a>

                        <select class="form-control t-select-custom" id="facet-time" name="facets[time][value]"
                            value="">
                            <option value="">Theo thời lượng</option>
                            <option value="0">Dưới 3 tiếng</option>
                            <option value="1">3 - 24 tiếng</option>
                        </select>
                        <select class="form-control t-select-custom" id="facet-level" name="facets[level][value]"
                            value="">
                            <option value="">Theo trình độ</option>
                            <option value="1">Cơ bản</option>
                            <option value="2">Nâng cao</option>
                            <option value="3">Chuyên sâu</option>
                            <option value="4">Mọi cấp độ</option>
                        </select>
                    </div>
                    <div class="field-sort">
                        <label><img src="https://cdn-skill.kynaenglish.vn/img/kyna-teach/icon-sort.svg"
                                alt="">Sắp
                            xếp:</label>
                        <select class="form-control t-select-custom" id="sort" name="sort" value="">
                            <option selected value="new">Mới nhất</option>
                            <option value="feature">Nổi bật</option>
                            <option value="promotion">% khuyến mãi</option>
                        </select>
                    </div>
                </div>
            </div> --}}
            <!-- End Desktop -->
        @endif
    </form>
    <div id="k-listing" class="container k-height-header">
        {{-- <div class="col-lg-3 col-xs-12 k-listing-sidebar" id="offpage-listing-sidebar">
            <header>
                <div class="k-header-offpage-menu">
                    <img src="https://cdn-skill.kynaenglish.vn/img/logo/Kynavnraftlogo.svg" alt="Kyna.vn"
                        class="img-responsive">
                    <a href="#" class="left offpage-close" data-offpage="#offpage-listing-sidebar">
                        <i class="icon icon-arrow-right-bold" aria-hidden="true"></i>
                    </a>
                </div>
            </header>
            <section>
                <div class="k-listing-category">
                    <h1 class="title-cat">{{ $item['name'] ?? '-' }}</h1>
                    @if (count($childs) > 0)
                        <ul class="k-category-list pd0">
                            @foreach ($childs as $child)
                                @php
                                    $link = CoursePackage::categoryLink($child['slug']);
                                @endphp
                                <li class="tat-ca-khoa-hoc">
                                    <a href="{{ $link }}">
                                        <img class="img-lazy"
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
                                            data-src="https://cdn-skill.kynaenglish.vn/uploads/categories/65/img/menu_icon-1594881835.png"
                                            width="20" height="20"
                                            alt="Tất cả khóa học">{{ $child['name'] ?? '-' }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <!--end k-category-->
            </section>
        </div> --}}
        <!--end .k-listing-sidebar-->
        <div class="col-lg-12 col-xs-12 k-listing-content">
            <!-- start hot courses-->
            <!-- end hot courses -->
            <div>
                <span class="menu-heading">
                    <h1 class="-mob"><b>{{ $item['name'] ?? '-' }}</b></h1>
                    @if (count($childs) > 0)
                        <div class="category-mobile">
                            @foreach ($childs as $child)
                                @php
                                    $link = CoursePackage::categoryLink($child['slug']);
                                @endphp
                                <div>
                                    <a class="" href="{{ $link }}"> {{ $child['name'] }} </a>
                                </div>
                            @endforeach
                        </div>

                    @endif
                    <div class="box-inline">
                        <h1 class="-pc t-h1-search">
                            <span class="t-sub-h1-search">
                                <b>
                                    {{ $coursesTotal }} </b>
                                <b class="-pc">
                                    khóa học
                                </b>
                            </span>
                            <span class="-mob">khóa học </span><br>
                            <b>{{ $item['name'] ?? '-' }} </b>
                        </h1>

                    </div>
                </span>
            </div>
            <section>
                <ul id="w0" class="k-box-card-list">
                    @if ($coursesTotal > 0)
                        @foreach ($coursesList as $course)
                            @php
                                $teacher = $course->teacher()->first();
                                $teacherName = $teacher['title'] ?? '-';
                                $teacherPosition = $teacher['position'] ?? '-';
                                $price = Obn::showPrice($course['price']);
                                $thumbnail = Obn::showThumbnail($course['thumbnail']);
                                $slug = $course['slug'];
                                $time = $course['time'];
                                $link = route('fe_course/detail', ['slug' => $slug]);
                                $student = $course->student()->count();
                            @endphp
                            <li class="col-xl-3 col-md-6 col-xs-12 k-box-card" data-key="0">

                                <div class="k-box-card-wrap clearfix" data-id="1954" data-course-type="1">
                                    <div class="img">
                                        <img class="img-fluid img-lazy" src="{{ $thumbnail }}" size="263x147"
                                            alt="Tự động hóa kinh doanh Online" resizeMode="cover" returnMode="img"
                                            lazyImg data-src="{{ $thumbnail }}">
                                        <div class="label-wrap">
                                        </div>

                                    </div>
                                    <!--end .img-->
                                    <div class="content">
                                        <div class="box-style">
                                        </div>
                                        <h4>{{ $course['title'] ?? '-' }}</h4>
                                        <span class="author"><i class="fas fa-user-tie"></i>
                                            {{ $teacherName }}
                                        </span>
                                        <span class="major"><i class="fas fa-briefcase"></i>
                                            {{ $teacherPosition }}
                                        </span>
                                    </div>
                                    <!--end .content -->
                                    <div class="content-mb">
                                        <b> {{ $teacherName }}</b><span><b>,</b>
                                            {{ $teacherPosition }}
                                        </span>
                                    </div>
                                    <!--end .content mb -->
                                    <div class="view-price">
                                        <ul>
                                            <li class="price"><strong>{{ $price }}</strong></li>
                                        </ul>
                                    </div>
                                    <!--end .view-price-->
                                    <div class="view-price-mb">
                                        <div class="student">
                                            <div class="number">{{ $student }}</div>
                                            <div class="text">học viên</div>
                                        </div>
                                        <div class="time">
                                            <div class="number">{{ $time }}</div>
                                            <div class="text">giờ</div>
                                        </div>
                                        <div class="price">
                                            <div class="label-price">
                                                <div class="first">{{ $price }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end .view-price mb-->
                                    <a href="{{ $link }}" class="link-wrap"></a>
                                </div>
                                <a href=" {{ $link }} " class="card-popup"></a>
                                <!--end .wrap-->
                            </li>
                        @endforeach
                    @else
                        <li class="col-xl-12 col-md-6 col-xs-12 k-box-card">
                            Nội dung đang cập nhật
                        </li>

                    @endif

                </ul>
                <nav id="pager-container">
                </nav>
            </section>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $(document).on('shown.bs.modal', "#modal", function() {
                        setTimeout(function() {
                            FB.XFBML.parse();
                        }, 1000);
                    });
                });
            </script>
        </div>
        <!--end .k-listing-content-->
    </div>
    <!--end #k-listing-->
</main>
@endsection
@section('custom_script')
<script type="text/javascript">
    $('.t-select-custom').select2({
        minimumResultsForSearch: -1
    });
    $('#facets-form select').change(function() {
        var params = decodeURIComponent($('#facets-form').serialize());
        var action = $('#facets-form').attr('action');
        window.location.href = action + '?' + params;
    });
    if ($('body').hasClass('mobile')) {
        let numberOfChecked = $('.k-listing-filter input:checked').length;
        $('.k-listing-filter input:checked').addClass('current-checked');
        $('#t-total-sort').html(numberOfChecked);
        $('#t-btn-listing-filter').click(function() {
            $('main').addClass('show-popup-filter');
        });
        $('#t-btn-popup-filter-cancel').click(function() {
            let action = $('#facets-form').attr('action');
            $('main').removeClass('show-popup-filter');
            window.location.href = action;
        });
        $('#t-btn-popup-filter-close').click(function() {
            $('main').removeClass('show-popup-filter');
            setTimeout(function() {
                $('.k-listing-filter input').prop('checked', false);
                $('.k-listing-filter input.current-checked').prop('checked', true);
            }, 500);
        });
        $('#t-btn-listing-sort').click(function() {
            $('.t-select-custom').select2('open');
            $('.select2-container').addClass('t-select2-sort');
            $('body').prepend('<div class="t-overlay-layout"></div>');
            $('.t-overlay-layout').click(function() {
                $('.t-overlay-layout').remove();
                $('.t-select-custom').select2('close');
            });
        });
        $('#t-btn-popup-filter-update').click(function() {
            var params = decodeURIComponent($('#facets-form').serialize());
            var action = $('#facets-form').attr('action');
            window.location.href = action + '?' + params;
        });
    } else {
        $('#facets-form :checkbox').click(function() {
            var params = decodeURIComponent($('#facets-form').serialize());
            var action = $('#facets-form').attr('action');
            window.location.href = action + '?' + params;
        });
    };
    (function($) {
        if ($('#topbar').length > 0) {
            var imgHeight = $('#topbar').find('img:visible').height();
            var LISTING_MARGIN_TOP = 67;
            $('.k-header-wrap').css('top', imgHeight + 'px');
            $('#k-listing').css('marginTop', LISTING_MARGIN_TOP + imgHeight + 'px');
        }
        $('body').on('submit', '#profile-form', function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var form = $(e.target);
            console.log(form);
            console.log(form.parent());
            $.post(url, form.serialize(), function(res) {
                form.parents('.k-profile-edit-content').html(res);
            });
        });
        $('body').on('submit', '#active-cod-form', function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var form = $(e.target);
            $.post(url, form.serialize(), function(res) {
                form.parent().html(res);
            });
        });
    })(jQuery);
</script>
@endsection
@section('custom_style')

<style>
    .view-price__flash-sale {
        position: absolute;
    }

    .view-price__flash-sale .old-price {
        position: relative;
    }

    .view-price__flash-sale .in-flash {
        left: -10px;
        text-decoration: line-through;
    }

    .view-price__flash-sale .new-price::before {
        content: url("https://cdn-skill.kynaenglish.vn/img/flash-sale/flash-icon.png");
        position: relative;
        top: 2px;
    }

    .view-price__flash-sale .new-price {
        position: relative;
        top: 5px;
        left: 0px;
        color: #ff293f;
        font-size: 18px;
    }

    .clock-flash-sale {
        margin-top: 10px !important;
    }

    @media only screen and (max-width: 540px) {
        .view-price-mb {
            padding: 10px 0 25px !important;
        }

        .clock-flash-sale-text {
            position: absolute;
            left: 10px;
            bottom: 55px;
        }
    }
</style>
<style>
    .k-box-card-list .k-box-card .k-box-card-wrap {
        border: 1px solid #ddd;
    }

    h3.mobile {
        display: none !important;
        font-weight: bold;
    }

    .k-box-card-list .k-box-card .k-box-card-wrap {}

    #best-seller-courses div.hr {
        border: 1px solid #ddd !important;
        margin-bottom: 25px !important;
    }

    .best-seller-categories-container {
        margin-top: 1.3rem !important;
    }

    #best-seller-courses h2 {
        display: block;
        color: #50ad4e;
        font-size: 18px;
        padding-left: 15px;
        font-weight: bold;
    }

    @media (max-width: 767px) {
        #banner-campaign-category h3 {
            display: block;
            font-weight: bold;
            padding-left: 15px;
        }

        .hot-category .img {
            width: 100% !important;
            box-shadow: none !important;
        }

        .k-listing-content span.menu-heading {
            margin-top: -11px !important;
        }

        .slick-dotted.slick-slider {
            margin-bottom: 5px !important;
        }

        .slick-slider {
            margin-top: 0 !important;
        }

        #banner-campaign-category .sm-banner {
            padding-bottom: 15px;
            display: none;
        }

        .hot-category {
            border: 0px solid #ddd !important;
        }

        #hot-courses .box {
            margin: 10px;
        }

        .breadcrumb-container {
            display: none;
        }

        .best-seller-categories-container .col-xl-4,
        .col-lg-6,
        .col-xs-6 {
            padding: 0px !important;
        }

        .slick-slide.k-box-card-list {
            padding-bottom: 0 !important;
        }

        h3.mobile {
            display: block !important;
            font-weight: bold;
            padding-left: 1px;
            color: #50ad4e;
        }

        .slick-dots {
            position: absolute;
            bottom: 5px;
        }

        .breadcrumb-container {
            margin-top: 67px;
            background-color: #fafafa;
        }

        .slick-dots li button:before {
            font-size: 10px !important;
            line-height: 25px;
        }

        .best-seller-categories-container {
            margin-top: 1px !important;
        }

        .best-seller-categories-container {
            margin-top: 1px !important;
        }

        .hot-category {
            padding: 5px !important;
        }

        #best-seller-courses h2 {
            display: block;
            color: #50ad4e;
            font-size: 20px;
            padding-left: 15px;
        }

        #best-seller-courses div.hr {
            margin-top: 20px !important;
            margin-left: 3.5%;
            width: 93%;
        }

        .hot-category .name {
            font-size: unset !important;
        }
    }

    #k-listing {}

    #hot-courses h3 {
        display: none;
    }

    #hot-courses {
        margin-bottom: -15px;
    }

    @media (min-width: 768px) {
        #hot-courses h3 {
            display: block;
            color: #50ad4e;
            font-size: 18px;
            padding-left: 15px;
            padding-right: 14px;
            padding-bottom: 0;
        }
    }

    div.hr {
        width: 96%;
        border-bottom-style: solid;
        border-bottom-width: initial;
        border-color: #aab2bd;
        margin-top: -18px;
        margin-bottom: 40px;
        margin-left: 2%
    }

    .hot-category .name {
        position: absolute;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
        left: 0;
        right: 0;
        bottom: 0;
        text-align: center;
        font-size: large;
        font-weight: bolder;
        color: #FFFFFF;
        height: 100%;
    }

    .hot-category .name span {
        position: absolute;
        width: 94%;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
        left: 2.5%;
    }

    .hot-category:hover .overlay {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #000;
        opacity: 0.2;
        border-radius: 1px;
    }

    @media(max-width: 425px) {
        .hot-category {
            position: unset !important;
        }

        #w2 {
            padding: 0 12px;
        }

        .w3 {
            padding: 0 12px;
        }
    }

    #w2 {
        margin-bottom: 20px;
    }

    .w3 {
        margin-bottom: 20px;
    }

    k-box-card-wrap.k-box-card-wrap-hot {}
</style>

@endsection
