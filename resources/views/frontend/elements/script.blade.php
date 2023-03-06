<script>
    function Copyvoucher() {
        var copyText = document.getElementById("showvoucher");
        copyText.select();
        document.execCommand("copy");
    }
</script>
<script>
    var countCart = 0;
    var sendData = true;
    // Close banner app mobile
    $('.mobilefooterbar .close').click(function() {
        $('.mobilefooterbar').hide();
    });

    function setCookie(name, value, expiredDay) {
        var expired = "";
        if (expiredDay !== null) {
            var date = new Date();
            date.setTime(date.getTime() + (expiredDay * 24 * 60 * 60 * 1000));
            expired = "expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + ";" + expired + ";path=/";
    }

    function getCookie(name) {
        var name = name + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    // Set show mobilefooterbar once a day
    $(document).ready(function() {
        var date = new Date();
        if (getCookie('mobilefooterbar_showed') === "" && getCookie('mobilefooterbar_showed') !== date
            .getDate()) {
            setCookie('mobilefooterbar_showed', date.getDate(), 1);
            $('.mobilefooterbar').show();
        } else {
            $('.mobilefooterbar').hide();
        }
    });
</script>
@php
    $currentRoute = Route::currentRouteName();
@endphp
<script src="{{ asset('kyna') }}/js/popup-get-user-info.js"></script>
<script src="{{ asset('kyna/js/add-to-cart.js') }}?ver={{ time() }}"></script>
<script src="{{ asset('kyna') }}/js/jquery-ui.js"></script>
<script src="{{ asset('kyna/js/autocomplete.js') }}?ver={{ time() }}"></script>

<script src="{{ asset('kyna') }}/js/slick.min.js?v=15217955218005"></script>
<script src="{{ asset('kyna') }}/js/jquery.lazy.min.js?v=15217955218005"></script>
<script src="{{ asset('kyna') }}/js/jquery.lazy.plugins.min.js?v=15217955218005"></script>
<script src="{{ asset('kyna') }}/js/sweetalert2.min.js?v=15217955218005"></script>
<script src="{{ asset('kyna') }}/js/app.min.js?v=15217955218005"></script>

@if ($currentRoute == 'home/index')
    <script src="{{ asset('kyna') }}/js/videojs.min.js?v=15217955218005"></script>
    <script src="{{ asset('kyna') }}/js/videojs-http-streaming.min.js?v=15217955218005"></script>
    <script src="{{ asset('kyna') }}/js/videojs-playlist.min.js?v=15217955218005"></script>
    <script src="{{ asset('kyna/js/home-page.min.js') }}?ver={{ time() }}"></script>
    <script src="{{ asset('kyna/js/header.min.js') }}?ver={{ time() }}"></script>
    <script src="{{ asset('kyna') }}/js/course-card.js?v=15217955218005"></script>
@endif
@if ($currentRoute == 'fe_course/detail')
    <script>
        $(".cta-open-video").click(function(e) {
            e.preventDefault();
            var t = $(this).attr("data-source");

            $("#video-modal").modal("show");
            $(".video-preview__wrapper iframe").attr("src", t);
        })
    </script>
@endif
{{-- Course --}}
{{-- <script src="{{asset('kyna/js/course-detail.min.js')}}?ver={{time()}}"></script> --}}



<script src="{{ asset('kyna') }}/js/select2.min.js?v=15217955218005"></script>
<script src="{{ asset('kyna') }}/js/tether.min.js?v=15217955218005"></script>
<script src="{{ asset('kyna') }}/js/bootstrap.min.js?v=15217955218005"></script>
<script src="{{ asset('kyna') }}/js/offpage.js?version=1562727393"></script>
<script src="{{ asset('kyna') }}/js/main.js?v=1568114107"></script>
<script src="{{ asset('kyna') }}/js/details.js?v=1562727393"></script>
<script src="{{ asset('kyna') }}/js/ajax-caller.js?v=31073107"></script>
<script src="{{ asset('kyna') }}/js/firebase.min.js?v=1"></script>
<script src="{{ asset('kyna') }}/js/push-notification-main.min.js?v=1"></script>
<script src="{{ asset('kyna') }}/js/jquery.validate.min.js?v=15217955218005"></script>
<script src="{{ asset('kyna') }}/js/bootstrap-notify.js"></script>
<script src="{{ asset('kyna') }}/js/yii.activeForm.js"></script>
<script type="text/javascript">
    ;
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
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#search-form').yiiActiveForm([], []);
    });
</script>
