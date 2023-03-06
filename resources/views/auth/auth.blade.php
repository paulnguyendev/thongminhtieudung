<!DOCTYPE html>
<html lang="vi">
<head>
    @include('auth.elements.head')
</head>
<body class="login-container">
    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        @include('auth.elements.navbar')
    </div>
    <!-- /main navbar -->
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content">
                    @yield('content')
                    <!-- Simple login form -->
                    
                    <!-- /simple login form -->
                    <!-- Footer -->
                    <div class="footer text-muted text-center">
                        &copy; 2022. Xây dựng bởi <a href="https://obn.marketing/" target="_blank">OBN MARKETING</a>
                    </div>
                    <!-- /footer -->
                </div>
                <!-- /content area -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->
    @include('core.loading')
    @include('auth.elements.scripts')
</body>
</html>
