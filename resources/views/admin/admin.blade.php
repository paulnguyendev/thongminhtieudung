<!DOCTYPE html>
<html lang="vi">

<head>
    @include('admin.elements.head')
</head>

<body class="navbar-top has-detached-right pace-done " data-env="production">
    <!-- Main navbar -->
    <div class="navbar navbar-default navbar-fixed-top header-highlight">
        @include('admin.elements.navbar')
    </div>
    <!-- /main navbar -->
    <div class="page-container">
        <div class="page-content">
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">
                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            @include('admin.elements.sidebar_menu')
                        </div>
                    </div>
                    <!-- /main navigation -->
                </div>
            </div>
            <div class="content-wrapper">
                <div class="content">
                    @yield('content')
                    <div class="footer text-muted">
                        &copy; 2017. Xây dựng bởi <a href="http://obn.marketing" target="_blank">OBN Marketing</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://static.loveitopcdn.com/backend/plugins/ckeditor/ckeditor.js?v=1.3"></script>
    <script src="https://static.loveitopcdn.com/backend/dist/js/plugin.js?id=1fc69adbc9342466a0a6"></script>
    <script src="https://static.loveitopcdn.com/backend/js/jquery.dirrty.js"></script>
    <script src="https://static.loveitopcdn.com/backend/js/notice.js?v=1.1"></script>
    <script src=" {{ asset('obn-dashboard/js/core/media.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('obn-dashboard/js/core/wb.datatables.js') }}?v=1.5.7"></script>
    <script src="{{ asset('obn-dashboard/js/core/affiliate.js') }}?v={{time()}}"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.form.js?v=1.7.5.1"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.checkSeo.js?v=1.5"></script>
    <script src="{{ asset('obn-dashboard/js/core/wb.seo.js') }}?v=1.6"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.applyTable.js?v=1.1"></script>
    <script src="https://static.loveitopcdn.com/backend/js/wb.js?v=1.5.6"></script>
    <script>
        $('#lfm_thumbnail').mlibready({
            returnto: '#thumbnail',
            maxselect: 1,
            runfunction: 'fillImage',
            maxFilesize: 5
        });
        $('#lfm_gallery').mlibready({
            returnto: '#gallery',
            runfunction: 'fillGallery',
            maxFilesize: 5
        });


        function nav_submit_form(btn) {
            var l = Ladda.create(btn);
            l.start();
            var formSubmit = $('#' + $(btn).data('form'));
           
            formSubmit.ajaxSubmit({
                beforeSerialize: function() {
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                    return true;
                },
                beforeSubmit: function(formData, formObject, formOptions) {
                    $('input[bs-type="singleDatePicker"]').each(function() {
                        if ($(this).val() != '') {
                            formData.push({
                                'name': $(this).attr('name'),
                                'value': moment($(this).val(), 'DD-MM-YYYY HH:mm:ss').format(
                                    'YYYY-MM-DD HH:mm:ss')
                            });
                        }
                    });
                    var data_attributes = [];
                    for (var i = 0; i < formData.length; i++) {
                        if (formData[i]['name'].indexOf('attribute[') !== -1) {
                            data_attributes.push(formData[i]);
                            formData.splice(i, 1);
                            i--;
                        }
                    }

                    formData.push({
                        'name': 'data_attributes',
                        'value': JSON.stringify(data_attributes),
                    });
                },
                success: function(data) {
                    l.stop();
                    if (data.success !== 'unfriended') {
                        if (data.success == false) {
                            warningNotice(data.message);
                            return;
                        }
                    }
                    if (!data.redirect) {
                        successNotice('Cập nhật thành công');
                    } else {
                        $(window).unbind('beforeunload');
                        var menu_redirect = "";
                        location.href = menu_redirect ? menu_redirect : data.redirect;
                    }
                },
                error: function(data) {
                    console.log(data);
                    l.stop();
                    WBForm.showError(formSubmit, data);
                }
            });
        }
    </script>
    @yield('script_table')

</body>

</html>
