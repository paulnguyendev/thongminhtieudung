<!DOCTYPE html>
<html lang="vi">

<head>
    @include('user.elements.head')
</head>

<body class="navbar-top has-detached-right pace-done " data-env="production">
    <!-- Main navbar -->
    <div class="navbar navbar-default navbar-fixed-top header-highlight">
        @include('user.elements.navbar')
    </div>
    <!-- /main navbar -->
    <div class="page-container">
        <div class="page-content">
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">
                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        @include('user.elements.sidebar_menu')
                    </div>
                    <!-- /main navigation -->
                </div>
            </div>
            <div class="content-wrapper">
                <div class="content">
                    @yield('content')
                    <div class="footer text-muted">
                        &copy; 2022. Xây dựng bởi <a href="http://obn.marketing" target="_blank">OBN MARKETING</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://static.loveitopcdn.com/backend/plugins/ckeditor/ckeditor.js?v=1.3"></script>
    <script src="https://static.loveitopcdn.com/backend/dist/js/plugin.js?id=1fc69adbc9342466a0a6"></script>
    <script src="{{ asset('obn-dashboard/plugin/slick.min.js') }}"></script>
    <script src="{{ asset('obn-dashboard/plugin/fancybox.umd.js') }}"></script>
    <script src="{{ asset('obn-dashboard/js/obn.js') }}"></script>
    <script src="https://static.loveitopcdn.com/backend/js/jquery.dirrty.js"></script>
    <script src="https://static.loveitopcdn.com/backend/js/notice.js?v=1.1"></script>
    <script src="https://static.loveitopcdn.com/backend/js/media.js?v=1.2.3"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.datatables.js?v=1.5.7"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.form.js?v=1.7.5.1"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.checkSeo.js?v=1.5"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.seo.js?v=1.6"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.applyTable.js?v=1.1"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.js?v=1.5.6"></script>
    <script src="https://static.loveitopcdn.com/backend/js/stepy.min.js"></script>
    <script src="https://static.loveitopcdn.com/backend/js/validate.min.js"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wizard_stepy.js"></script>

    <script>
        var loadimg = function() {}
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(loadimg, 1000);
        });
        $(document).find('body').on('click', function() {
            loadimg();
        });
    </script>
    @yield('custom_srcipt')
</body>

</html>
