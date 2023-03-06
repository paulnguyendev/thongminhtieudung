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
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <div class="panel panel-body panel-body-accent">
                                <a class="media no-margin" href="https://dainghiagroup.com/admin/post">
                                    <div class="media-left media-middle">
                                        <i class="icon-magazine icon-3x text-success-400"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3 class="no-margin text-semibold">14</h3>
                                        <span class="text-uppercase text-size-mini text-muted">Bài viết</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="panel panel-body">
                                <a class="media no-margin" href="https://dainghiagroup.com/admin/product">
                                    <div class="media-left media-middle">
                                        <i class="icon-price-tag2 icon-3x text-indigo-400"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3 class="no-margin text-semibold">3</h3>
                                        <span class="text-uppercase text-size-mini text-muted">Sản phẩm</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="panel panel-body">
                                <a class="media no-margin" href="https://dainghiagroup.com/admin/post/category">
                                    <div class="media-body">
                                        <h3 class="no-margin text-semibold">6</h3>
                                        <span class="text-uppercase text-size-mini text-muted">Thể loại bài viết</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-notebook icon-3x text-danger-400"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="panel panel-body">
                                <a class="media no-margin" href="https://dainghiagroup.com/admin/product/category">
                                    <div class="media-body">
                                        <h3 class="no-margin text-semibold">14</h3>
                                        <span class="text-uppercase text-size-mini text-muted">Thể loại sản phẩm</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-folder3 icon-3x text-blue-400"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><i class="icon-menu3 position-left"></i> QUẢN LÝ MENU</h5>
                                </div>
                                <div class="panel-body">
                                    <a style="font-size: 16px" href="https://dainghiagroup.com/admin/menu"><i
                                            class="icon-arrow-right6"></i>
                                        Click vào đây để quản lý menu
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><i class="icon-cog3 position-left"></i> QUẢN LÝ CẤU HÌNH
                                        WEBSITE</h5>
                                </div>
                                <div class="panel-body">
                                    <a style="font-size: 16px"
                                        href="https://dainghiagroup.com/admin/setting/website"><i
                                            class="icon-arrow-right6"></i> Click vào đây để quản lý cấu hình
                                        website</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title text-uppercase">Đơn hàng mới</h6>
                                    <div class="heading-elements">
                                        <span class="heading-text"><a href="https://dainghiagroup.com/admin/order">Xem
                                                tất cả</a></span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Đơn hàng</th>
                                                <th>Ngày đặt</th>
                                                <th>Khách hàng</th>
                                                <th>Tổng tiền</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title text-uppercase">Sản phẩm gần nhất</h6>
                                    <div class="heading-elements">
                                        <span class="heading-text"><a
                                                href="https://dainghiagroup.com/admin/product">Xem tất cả</a></span>
                                    </div>
                                    <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="media-list content-group">
                                                <li class="media stack-media-on-mobile">
                                                    <div class="media-left">
                                                        <div class="thumb">
                                                            <a href="https://dainghiagroup.com/admin/product/29/edit">
                                                                <img src="/jahi-central-home-loc-an.jpg"
                                                                    class="img-responsive img-rounded media-preview"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><a
                                                                href="https://dainghiagroup.com/admin/product/29/edit">Khu
                                                                dân cư Jahi-Central Home Lộc An</a></h6>
                                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                                            <li>08/07/2021 09:06</li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-12">
                                            <ul class="media-list content-group">
                                                <li class="media stack-media-on-mobile">
                                                    <div class="media-left">
                                                        <div class="thumb">
                                                            <a href="https://dainghiagroup.com/admin/product/28/edit">
                                                                <img src="/84-nen-lien-dam.jpg"
                                                                    class="img-responsive img-rounded media-preview"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><a
                                                                href="https://dainghiagroup.com/admin/product/28/edit">Phân
                                                                Lô 84 nền Liên Đầm, Di Linh, Lâm Đồng</a></h6>
                                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                                            <li>08/07/2021 09:05</li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-12">
                                            <ul class="media-list content-group">
                                                <li class="media stack-media-on-mobile">
                                                    <div class="media-left">
                                                        <div class="thumb">
                                                            <a href="https://dainghiagroup.com/admin/product/27/edit">
                                                                <img src="/fbbd00e42ffde1a3b8ec.jpg"
                                                                    class="img-responsive img-rounded media-preview"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><a
                                                                href="https://dainghiagroup.com/admin/product/27/edit">Dự
                                                                Án Tani Villa - Lộc Tân, Lâm Đồng</a></h6>
                                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                                            <li>08/07/2021 09:04</li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Latest posts -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title text-uppercase">Bài viết gần nhất</h6>
                                    <div class="heading-elements">
                                        <span class="heading-text"><a href="https://dainghiagroup.com/admin/post">Xem
                                                tất cả</a></span>
                                    </div>
                                    <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="media-list content-group">
                                                <li class="media stack-media-on-mobile">
                                                    <div class="media-left">
                                                        <div class="thumb">
                                                            <a href="https://dainghiagroup.com/admin/post/19/edit">
                                                                <img src="/223522-302701193-113169774855604-8260449722808231292-n.jpg"
                                                                    class="img-responsive img-rounded media-preview"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><a
                                                                href="https://dainghiagroup.com/admin/post/19/edit">Dịch
                                                                vụ chính marketing obn</a></h6>
                                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                                            <li>17/12/2022 09:07</li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-12">
                                            <ul class="media-list content-group">
                                                <li class="media stack-media-on-mobile">
                                                    <div class="media-left">
                                                        <div class="thumb">
                                                            <a href="https://dainghiagroup.com/admin/post/18/edit">
                                                                <img src="/dat-tho-cu-la-gi.jpg"
                                                                    class="img-responsive img-rounded media-preview"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><a
                                                                href="https://dainghiagroup.com/admin/post/18/edit">Đất
                                                                thổ cư là gì &amp; điều kiện để lên đất thổ cư</a></h6>
                                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                                            <li>24/04/2022 10:50</li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-12">
                                            <ul class="media-list content-group">
                                                <li class="media stack-media-on-mobile">
                                                    <div class="media-left">
                                                        <div class="thumb">
                                                            <a href="https://dainghiagroup.com/admin/post/17/edit">
                                                                <img src="/pho-di-bo-da-lat-4.jpg"
                                                                    class="img-responsive img-rounded media-preview"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><a
                                                                href="https://dainghiagroup.com/admin/post/17/edit">Đà
                                                                Lạt tính làm phố đi bộ ở thắng cảnh hồ Xuân Hương</a>
                                                        </h6>
                                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                                            <li>18/04/2022 15:45</li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-12">
                                            <ul class="media-list content-group">
                                                <li class="media stack-media-on-mobile">
                                                    <div class="media-left">
                                                        <div class="thumb">
                                                            <a href="https://dainghiagroup.com/admin/post/16/edit">
                                                                <img src="/luu-y-khi-dat-coc-nha-dat-8.jpeg"
                                                                    class="img-responsive img-rounded media-preview"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><a
                                                                href="https://dainghiagroup.com/admin/post/16/edit">7
                                                                lưu ý khi ĐẶT CỌC mua đất để HẠN CHẾ gặp rủi ro</a></h6>
                                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                                            <li>15/04/2022 15:09</li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-12">
                                            <ul class="media-list content-group">
                                                <li class="media stack-media-on-mobile">
                                                    <div class="media-left">
                                                        <div class="thumb">
                                                            <a href="https://dainghiagroup.com/admin/post/15/edit">
                                                                <img src="/khac-nhau-giua-so-do-va-so-hong-2.png"
                                                                    class="img-responsive img-rounded media-preview"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><a
                                                                href="https://dainghiagroup.com/admin/post/15/edit">Cách
                                                                KIỂM TRA sổ đỏ và sổ hồng KHI giao dịch mua bán</a></h6>
                                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                                            <li>15/04/2022 10:44</li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title text-uppercase">Có thể bạn quan tâm</h6>
                                    <div class="heading-elements">
                                        <span class="heading-text"><a href="https://itop.website/huong-dan-su-dung/"
                                                target="_blank">Xem tất cả</a></span>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row lasted_blog">
                                        <div style="display: none" class="lasted_blog_item">
                                            <div class="col-lg-12">
                                                <ul class="media-list content-group">
                                                    <li class="media stack-media-on-mobile">
                                                        <div class="media-left">
                                                            <div class="thumb">
                                                                <a href="#url" target="_blank">
                                                                    <img src="#thumbnail"
                                                                        class="img-responsive img-rounded media-preview"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="media-heading"><a href="#url"
                                                                    target="_blank">#title</a></h6>
                                                            <ul
                                                                class="list-inline list-inline-separate text-muted mb-5">
                                                                <li>#category_name</li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /latest posts -->
                        </div>
                    </div>
                    <div class="footer text-muted">
                        &copy; 2017. Xây dựng bởi <a href="http://imgroup.vn" target="_blank">IM GROUP</a>
                    </div>
                    <div class="zalo-chat-widget" data-oaid="1396501067994544259"
                        data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="350"
                        data-height="420"></div>
                    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
                </div>
            </div>
        </div>
    </div>
    <script>
        var loadimg = function() {}
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://static.loveitopcdn.com/backend/plugins/ckeditor/ckeditor.js?v=1.3"></script>
    <script src="https://static.loveitopcdn.com/backend/dist/js/plugin.js?id=1fc69adbc9342466a0a6"></script>
    <script src="https://static.loveitopcdn.com/backend/js/jquery.dirrty.js"></script>
    <script src="https://static.loveitopcdn.com/backend/js/notice.js?v=1.1"></script>
    <script src="https://static.loveitopcdn.com/backend/js/media.js?v=1.2.3"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.datatables.js?v=1.5.7"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.form.js?v=1.7.5.1"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.checkSeo.js?v=1.5"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.seo.js?v=1.6"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.applyTable.js?v=1.1"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.js?v=1.5.6"></script>
    <script type="text/javascript">
        var itop_url = "https://itop.website";
        $.ajax({
                url: itop_url + '/api/blog/lastest/?token=' + _token,
                type: 'GET',
                dataType: 'json',
            })
            .done(function(data) {
                var lasted_blog_item = $('.lasted_blog_item').clone();
                $.each(data, function(index, val) {
                    $('.lasted_blog').append(lasted_blog_item.html().replace("#thumbnail", val.thumbnail)
                        .replace("#category_name", val.category_name).replace("#title", val.title)
                        .replaceAll("#url", val.url));
                });
            })
            .fail(function() {
                console.log("error");
            })
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(loadimg, 1000);
        });
        $(document).find('body').on('click', function() {
            loadimg();
        });
    </script>
</body>
</html>
