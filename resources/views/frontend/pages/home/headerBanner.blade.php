@php
    use App\Helpers\Package\CoursePackage;
@endphp
<section id="headerBanner" class="header-banner">
    <div class="container">
        <div class="d-flex1 flex-wrap1">
            <div class="header-banner-right">
                <div class="inner">
                    <div class="header-banner-first header-banner-slider slick__slider--normal animate-fade-in">
                        <div class="inner">
                            <a href="javascript:void(0)" class="item">
                                <div class="inner">
                                    <picture>
                                        <source media="(min-width: 767px)" srcset="{{ asset('kyna/img/slide1.jpg') }}">
                                        <img width="100%" height="auto" class="img"
                                            data-lazy="{{ asset('kyna/img/slide1.jpg') }}"
                                            alt="7-buoc-ban-hang-chuyen-nghiep ">
                                    </picture>
                                </div>
                            </a>
                            <a href="javascript:void(0)" class="item">
                                <div class="inner">
                                    <picture>
                                        <source media="(min-width: 767px)" srcset="{{ asset('kyna/img/slide2.jpg') }}">
                                        <img width="100%" height="auto" class="img"
                                            data-lazy="{{ asset('kyna/img/slide1.jpg') }}"
                                            alt="7-buoc-ban-hang-chuyen-nghiep ">
                                    </picture>
                                </div>
                            </a>
                            <a href="javascript:void(0)" class="item">
                                <div class="inner">
                                    <picture>
                                        <source media="(min-width: 767px)" srcset="{{ asset('kyna/img/slide3.jpg') }}">
                                        <img width="100%" height="auto" class="img"
                                            data-lazy="{{ asset('kyna/img/slide1.jpg') }}"
                                            alt="7-buoc-ban-hang-chuyen-nghiep ">
                                    </picture>
                                </div>
                            </a>
                            <a href="javascript:void(0)" class="item">
                                <div class="inner">
                                    <picture>
                                        <source media="(min-width: 767px)" srcset="{{ asset('kyna/img/slide4.jpg') }}">
                                        <img width="100%" height="auto" class="img"
                                            data-lazy="{{ asset('kyna/img/slide4.jpg') }}"
                                            alt="7-buoc-ban-hang-chuyen-nghiep ">
                                    </picture>
                                </div>
                            </a>
                            <a href="javascript:void(0)" class="item">
                                <div class="inner">
                                    <picture>
                                        <source media="(min-width: 767px)" srcset="{{ asset('kyna/img/slide5.jpg') }}">
                                        <img width="100%" height="auto" class="img"
                                            data-lazy="{{ asset('kyna/img/slide5.jpg') }}"
                                            alt="7-buoc-ban-hang-chuyen-nghiep ">
                                    </picture>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="header-banner-second header-banner-slider" data-url="{{ route('home/subBanner') }}">
                        <div class="inner">
                            <!-- Render js -->
                            <div class="item item-loading">
                                <img src="https://cdn-skill.kynaenglish.vn/img/loading-larger.gif"
                                    alt="Khóa học trực tuyến">
                            </div>
                            <div class="item item-loading">
                                <img src="https://cdn-skill.kynaenglish.vn/img/loading-larger.gif"
                                    alt="Khóa học trực tuyến">
                            </div>
                            <div class="item item-loading">
                                <img src="https://cdn-skill.kynaenglish.vn/img/loading-larger.gif"
                                    alt="Khóa học trực tuyến">
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
@section('custom_style')
    <style>
        .header-banner-second .item img {
            object-position: top;
        }
    </style>
@endsection
