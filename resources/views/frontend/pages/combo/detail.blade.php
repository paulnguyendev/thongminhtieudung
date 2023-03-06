@php
    use App\Helpers\Obn;
    use App\Helpers\Package\CoursePackage;
@endphp
@extends('frontend.main')
@section('content')
    <!-- Breadcrumbs start -->
    <div class="breadcrumb-container">
        <div class="container">
        </div>
    </div>
    <!-- Breadcrumbs end -->
    <section>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/legit-ripple@1.1.0/dist/ripple.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/css/perfect-scrollbar.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
            rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@babel/polyfill@7.6.0/dist/polyfill.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js"></script>
        <!--Content-->
        <!-- Block data for track course viewed -->
        <div id="loadReviewUrl" hidden>/course/default/load-review?course_id=152</div>
        <div id="course-detail" class="course-detail">
            <div class="cd-top-banner have-bg opt-1" style="background-image: url('{{ $item['thumbnail'] }}');">
                <div class="container">
                    <div class="course-detail--left">
                        <h1 class="cd-title">{{ $item['title'] ?? '-' }}</h1>
                        <ul class="crs-short-info">
                            {!! $item['description'] ?? 'Nội dung đang cập nhật' !!}
                        </ul>
                    </div>
                </div>
                <div class="cd-overlay" style="background-color:rgba(0, 0, 0, 0.6)"></div>
            </div>
            <section id="courseDetailTabs" class="course-detail-tabs">
                <div class="container">
                    <div class="course-detail-tabs-list ">
                        <a href="{{ Request::url() }}#courseDetailOverview" class="course-detail-tab">Bạn sẽ học được
                            gì?</a>
                        <a href="{{ Request::url() }}#courseDetailIntroduce" class="course-detail-tab">Giới thiệu</a>
                        <a href="{{ Request::url() }}#courseDetailContent" class="course-detail-tab">Nội dung <span
                                class="hide">&nbsp;khóa
                                học</span></a>
                    </div>
                </div>
            </section>
            <div class="container course-detail-container">
                <div class="course-detail--left">
                    <section id="courseDetailIntro">
                        <div id="courseDetailOverview" class="course-general">
                            <h5 class="title">Bạn sẽ học được gì?</h5>
                            <div class="course-general__wrapper ">
                                {!! $item['description'] ?? 'Nội dung đang cập nhật' !!}
                            </div>
                        </div>
                        <div id="courseDetailIntroduce" class="course-general">
                            <h5 class="title">Giới thiệu khóa học</h5>
                            <div class="course-general__wrapper">
                                {!! $item['content'] ?? 'Nội dung đang cập nhật' !!}
                            </div>
                        </div>
                    </section>
                    <section class="course-general related-course__wrapper">
                        <h5 class="title">Khóa học trong Combo <span style="color: #ff7818;"></span></h5>
                        <div class="course-related-horizontal__slider slick__slider--normal "
                            data-slick-class="course-related-horizontal" data-slick-type="course-detail"
                            data-number-card="3" data-see-more-link="">
                            @foreach ($courses as $relatedCourse)
                                @php
                                    $totalLesson = $relatedCourse->totalLesson();
                                    $relatedTeacher = $relatedCourse->teacher()->first();
                                    
                                @endphp
                                <div class="card-course " data-toggle="popover" data-trigger="hover" data-id="376"
                                    data-upload-date="19/06/2021" data-duration="4 giờ" data-user-enroll="1074"
                                    data-promo-text="" data-is-best-seller="" data-status-item="1"
                                    data-course-item-free="">
                                    <div class="card-inner">
                                        <a href="{{ route('fe_course/detail', ['slug' => $relatedCourse['slug']]) }}"
                                            class="card-link">
                                            <div class="card-header">
                                                <img src="{{ Obn::showThumbnail($relatedCourse['thumbnail']) }}"
                                                    alt="course-image">
                                                <div class="card-header__badget card-vertical">
                                                    <span class="card-header__badget-item">
                                                        <i class="fal fa-play-circle"></i>
                                                        22 </span>
                                                    <span class="card-header__badget-item"><i
                                                            class="fal fa-star"></i>5</span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-info">
                                                    <h5 class="heading-card__main">
                                                        {{ $relatedCourse['title'] ?? '-' }} </h5>
                                                    <div class="card-body__badget card-horizontal">
                                                        <span class="card-body__badget-item">
                                                            <img src="https://cdn-skill.kynaenglish.vn/img/duration.svg"
                                                                alt="Kyna" width="18px"
                                                                height="18px">{{ $relatedCourse['time'] ?? 0 }} giờ
                                                        </span>
                                                        <span class="card-body__badget-item">
                                                            <img src="https://cdn-skill.kynaenglish.vn/img/book.svg"
                                                                alt="Kyna" width="18px"
                                                                height="18px">{{ $totalLesson }} bài học
                                                        </span>
                                                    </div>
                                                    <div class="info-card-wrap card-vertical">
                                                        <div class="info-card-avatar">
                                                            <img data-src="{{ Obn::showThumbnail($relatedTeacher['thumbnail']) }}"
                                                                src="{{ Obn::showThumbnail($relatedTeacher['thumbnail']) }}"
                                                                class="img-lazy" alt="ThS Trương Anh Tú">
                                                        </div>
                                                        <div class="info-card-title">
                                                            <span class="info-card">
                                                                <i class="fas fa-user-tie"></i>
                                                                {{ $relatedTeacher['title'] ?? '-' }} </span>
                                                            <span class="info-card">
                                                                <i class="fas fa-briefcase"></i>
                                                                {{ $relatedTeacher['position'] ?? '-' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-rating card-horizontal">
                                                    <span class="card-rating-item">
                                                        <span class="number">5</span>
                                                        <img class="course-rating__icon tablet"
                                                            src="https://cdn-skill.kynaenglish.vn/img/star-fill.svg"
                                                            alt="Kyna - Star">
                                                        <img class="course-rating__icon"
                                                            src="https://cdn-skill.kynaenglish.vn/img/star-fill.svg"
                                                            alt="Kyna - Star">
                                                        <img class="course-rating__icon"
                                                            src="https://cdn-skill.kynaenglish.vn/img/star-fill.svg"
                                                            alt="Kyna - Star">
                                                        <img class="course-rating__icon"
                                                            src="https://cdn-skill.kynaenglish.vn/img/star-fill.svg"
                                                            alt="Kyna - Star">
                                                        <img class="course-rating__icon"
                                                            src="https://cdn-skill.kynaenglish.vn/img/star-fill.svg"
                                                            alt="Kyna - Star">
                                                        <img class="course-rating__icon tablet"
                                                            src="https://cdn-skill.kynaenglish.vn/img/star-fill.svg"
                                                            alt="Kyna - Star">
                                                    </span>
                                                </div>
                                                <div class="pricing-card">

                                                    <span
                                                        class="course-pricing">{{ Obn::showPrice($relatedCourse['price']) }}</u>
                                                    </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <!--    <a class="cta-all-lecturer-course" href="/danh-sach-khoa-hoc">Xem thêm</a>-->
                    </section>
                  
                </div>
                <div class="course-detail--right">
                    <div class="cd-sticky-info opt-1"
                        style="background-color: rgba(255, 255, 255, 0.3); border-color: #FFFFFF; ">
                        <div class="cd-wrap-img">
                            <div class="videoWrapper ">
                                <div id="play_video" class="cursor-pointer">
                                    <img class="img-fluid" src="{{ Obn::showThumbnail($item['thumbnail']) }}"
                                        size="730x436" width="730px" height="436px"
                                        alt="Bí quyết mua bán bất động sản thành công" resizeMode="crop" returnMode="img"
                                        max-width="100%"> <button class="ytp-large-play-button ytp-button"
                                        aria-label="Bí quyết mua bán bất động sản thành công">
                                        <svg height="100%" version="1.1" viewBox="0 0 68 48" width="100%">
                                            <path class="ytp-large-play-button-bg"
                                                d="m .66,37.62 c 0,0 .66,4.70 2.70,6.77 2.58,2.71 5.98,2.63 7.49,2.91 5.43,.52 23.10,.68 23.12,.68 .00,-1.3e-5 14.29,-0.02 23.81,-0.71 1.32,-0.15 4.22,-0.17 6.81,-2.89 2.03,-2.07 2.70,-6.77 2.70,-6.77 0,0 .67,-5.52 .67,-11.04 l 0,-5.17 c 0,-5.52 -0.67,-11.04 -0.67,-11.04 0,0 -0.66,-4.70 -2.70,-6.77 C 62.03,.86 59.13,.84 57.80,.69 48.28,0 34.00,0 34.00,0 33.97,0 19.69,0 10.18,.69 8.85,.84 5.95,.86 3.36,3.58 1.32,5.65 .66,10.35 .66,10.35 c 0,0 -0.55,4.50 -0.66,9.45 l 0,8.36 c .10,4.94 .66,9.45 .66,9.45 z"
                                                fill="#1f1f1e" fill-opacity="0.81"></path>
                                            <path d="m 26.96,13.67 18.37,9.62 -18.37,9.55 -0.00,-19.17 z" fill="#fff">
                                            </path>
                                            <path d="M 45.02,23.46 45.32,23.28 26.96,13.67 43.32,24.34 45.02,23.46 z"
                                                fill="#ccc"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div id="youtube_video_wrapper">
                                    <!-- Copy & Pasted from YouTube -->
                                    <iframe width="560" height="349" src=" {!! $item['video_intro'] ?? '' !!}"
                                        allow="autoplay" frameborder="0" allowfullscreen></iframe>
                                </div>
                                <div class="label-wrap">
                                    <span class="lb-new">NEW</span>
                                    <span class="lb-hot">HOT</span>
                                </div>
                                <div class="rating-box clearfix">
                                    <div class="dot" position="1"><i class="fa fa-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="rating-text"><b>4.4 <i class="icon icon-star"></i></b> <span>(153
                                            <detail> đánh giá</detail>)
                                        </span></div>
                                    <div class="dot" position="2"><i class="fa fa-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="number-student"><i class="fa fa-user" aria-hidden="true"></i>
                                        <span>16490 học viên<detail> đăng ký học</detail></span>
                                    </div>
                                </div>
                            </div>
                            <style>
                                #youtube_video_wrapper {
                                    display: none;
                                }
                                #play_video {
                                    margin-top: -25px;
                                }
                                #play_video>img {
                                    width: 100%;
                                }
                                .cursor-pointer {
                                    cursor: pointer;
                                }
                                .ytp-button {
                                    border: none;
                                    background-color: transparent;
                                    padding: 0;
                                    color: inherit;
                                    text-align: inherit;
                                    font-size: 100%;
                                    font-family: inherit;
                                    cursor: default;
                                    line-height: inherit;
                                }
                                .ytp-button:focus,
                                .ytp-button {
                                    outline: 0;
                                }
                                .ytp-large-play-button {
                                    position: absolute;
                                    left: 50%;
                                    top: 50%;
                                    width: 68px;
                                    height: 48px;
                                    margin-left: -34px;
                                    margin-top: -24px;
                                    -moz-transition: opacity .25s cubic-bezier(0.0, 0.0, 0.2, 1);
                                    -webkit-transition: opacity .25s cubic-bezier(0.0, 0.0, 0.2, 1);
                                    transition: opacity .25s cubic-bezier(0.0, 0.0, 0.2, 1);
                                }
                                .ytp-small-mode .ytp-large-play-button {
                                    width: 42px;
                                    height: 30px;
                                    margin-left: -21px;
                                    margin-top: -15px;
                                }
                                .ytp-button:not([aria-disabled=true]):not([disabled]):not([aria-hidden=true]) {
                                    cursor: pointer;
                                }
                                .html5-video-player svg {
                                    pointer-events: none;
                                }
                                .ytp-large-play-button-bg {
                                    -moz-transition: fill .1s cubic-bezier(0.4, 0.0, 1, 1), fill-opacity .1s cubic-bezier(0.4, 0.0, 1, 1);
                                    -webkit-transition: fill .1s cubic-bezier(0.4, 0.0, 1, 1), fill-opacity .1s cubic-bezier(0.4, 0.0, 1, 1);
                                    transition: fill .1s cubic-bezier(0.4, 0.0, 1, 1), fill-opacity .1s cubic-bezier(0.4, 0.0, 1, 1);
                                    fill: #1f1f1f;
                                    fill-opacity: .81;
                                }
                                .videoWrapper:hover .ytp-large-play-button-bg {
                                    -moz-transition: fill .1s cubic-bezier(0.0, 0.0, 0.2, 1), fill-opacity .1s cubic-bezier(0.0, 0.0, 0.2, 1);
                                    -webkit-transition: fill .1s cubic-bezier(0.0, 0.0, 0.2, 1), fill-opacity .1s cubic-bezier(0.0, 0.0, 0.2, 1);
                                    transition: fill .1s cubic-bezier(0.0, 0.0, 0.2, 1), fill-opacity .1s cubic-bezier(0.0, 0.0, 0.2, 1);
                                    fill: #cc181e;
                                    fill-opacity: 1;
                                }
                            </style>
                            <script type="application/javascript">
    ;(function($, window, document, undefined){
        $(document).ready(function(){
            $('#play_video').on('click', function (event) {
                event.preventDefault();
                $('#youtube_video_wrapper > iframe')[0].contentWindow.postMessage('{"event":"command", "func":"playVideo", "args":""}', '*');
                $(this).hide();
                $('#youtube_video_wrapper').show();
                let src = $('#youtube_video_wrapper > iframe').attr('src');
                let isRel = src.search('rel=0');
                if(isRel > 0) {
                    src += '&autoplay=1&loop=1';
                } else {
                    src += '?autoplay=1&loop=1';
                }
                $('#youtube_video_wrapper > iframe').attr('src', src);
            });
        });
    })(window.jQuery || window.Zepto, window, document);
</script>
                        </div>
                        <div class="crs-price">
                            <span class="crs-price--after" style="color: rgba(251, 106, 2)">
                                {{ Obn::showPrice($item['price'] ?? 0) }}
                            </span>
                        </div>
                        <div class="crs-btn">
                            <a class="btn-buy-now dang-ky-hoc crs-btn-buy" href="#" action="AddToCart"
                                data-ga="event" data-url="{{ route('fe_cart/buyNow',['type' => 'combo']) }}" data-pid="{{ $item['id'] }}"
                                style="background-color: rgba(251, 106, 2); color: #FFFFFF" category="CourseDetail"
                                label="Bí quyết mua bán bất động sản thành công"><b>Mua ngay</b></a>
                            @if (Obn::searchCartById($item['id']))
                                <a id="btn-goto-cart" href="{{route('fe_cart/index')}}" class="go-to-cart dang-ky-hoc crs-btn-add"
                                    style="background-color: transparent; color: #FFFFFF; border-color: #FFFFFF">Xem
                                    giỏ hàng</b></a>
                            @else
                                <a id="btn-add-to-cart" class="go-to-cart add-to-cart dang-ky-hoc crs-btn-add"
                                    href="{{ route('fe_cart/add', ['id' => $item['id'], 'type' => 'combo']) }}" action="AddToCart"
                                    data-ga="event" data-pid="{{ $item['id'] }}"
                                    style="background-color:transparent; color: #FFFFFF; border-color: #FFFFFF"
                                    category="CourseDetail" label="Bí quyết mua bán bất động sản thành công"><b
                                        class=''>Thêm vào giỏ hàng</b></a> <a id="btn-goto-cart" href="{{ route('fe_cart/add', ['id' => $item['id'], 'type' => 'combo']) }}"
                                    class="go-to-cart dang-ky-hoc crs-btn-add"
                                    style="display: none;background-color: transparent; color: #FFFFFF; border-color: #FFFFFF">Xem
                                    giỏ hàng</b></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom_style')
    <style>
        .cd-top-banner .cd-title {
            min-height: auto;
        }
        .crs-short-info {
            color:#fff;
        }
    </style>
@endsection