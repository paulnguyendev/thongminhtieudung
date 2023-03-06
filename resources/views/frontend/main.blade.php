<!DOCTYPE HTML>
<html lang="vi">
<head data-user-id="">
    @include('frontend.elements.head')
</head>
<body class="@yield('body_class','desktop')">
    <div class="modal fade" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="video-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times-circle"></i></span>
                    </button>
                    <div class="video-preview__wrapper">
                        <div style="position: relative; padding-top: 56.25%;"><iframe src loading="lazy" style="border: none; position: absolute; top: 0; height: 100%; width: 100%;" allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;" allowfullscreen="true"></iframe></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="video-preview__playlist"></div>
                </div>
            </div>
        </div>
    </div>
    <header id="header">
        <div id="fb-root"></div>
        @include('frontend.elements.nav_desktop')
        <!-- Menu mobile -->
        @include('frontend.elements.nav_mobile')
        <!-- End Menu mobile-->
        <!--  -->
    </header>
    <div class="modal fade" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="video-modal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times-circle"></i></span>
                    </button>
                    <div class="video-preview__wrapper">
                        <video id="video-preview__player" class="video-js vjs-fluid" controls>
                            <video id="video-preview__player" class="video-js vjs-fluid" controls>
                            </video>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="video-preview__playlist"></div>
                </div>
            </div>
        </div>
    </div>
    <main id="@yield('id', 'home-page')" data-cdn-url="https://cdn-skill.kynaenglish.vn">
        @yield('content')
        <a href="#" class="cta-scroll-to-top"><i class="fas fa-arrow-up"></i></a>
    </main>
    <footer>
       @include('frontend.elements.footer')
    </footer>
    <!-- Góp ý -->
    @include('frontend.elements.script')
    @yield('custom_script')
</body>
</html>
