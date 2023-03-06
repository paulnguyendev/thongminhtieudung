@php
    use App\Helpers\User;
    use App\Helpers\Obn;
    $seo_default = Obn::getSetting('seo_default');
    $seo_default = json_decode($seo_default, true);
@endphp
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="msvalidate.01" content="E04DEE146525196629F6E1FB54D0A9CD" />
<script src="https://apis.google.com/js/api:client.js"></script>
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=138701140812940&autoLogAppEvents=1">
</script>
<meta name="csrf-param" content="_csrf">
<meta name="cart_url" content="{{ route('fe_cart/index') }}">
<meta name="user-id" content="{{ User::getAffInfo() }}" />
<meta name="csrf-token" content="eGV1NE5FdUstBCVNIX0WfDAKKkwkASoMPjpHYTsHImYSUgQCPXISMQ==">
<title>@yield('title', $seo_default['meta_title'] ?? "")</title>
<meta name="keywords" content="{{$seo_default['meta_keyword'] ?? ""}}">
<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
<link rel="icon" href="{{ Obn::getSetting('icon') }}">
<link rel=preconnect href="https://pro.fontawesome.com">
<meta name="description" content="{{$seo_default['meta_description'] ?? ""}}">
<meta name="robots" content="index,follow">
<meta property="og:type" content="website">
<meta property="og:title" content="{{$seo_default['meta_title'] ?? ""}}">
<meta property="og:description"
    content="{{$seo_default['meta_description'] ?? ""}}">
<meta property="og:image" content="https://rpagroup.vn/public/assets/kyna/img/slide4.jpg">
<meta property="og:url" content="{{ route('home/index') }}">
<link type="text/css" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;900&amp;display=swap"
    rel="stylesheet">
<link type="text/css" href="https://cdn-skill.kynaenglish.vn/css/video/videojs.min.css?v=15217955218005"
    rel="stylesheet">
<link type="text/css" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css" rel="stylesheet">
<link type="text/css" href="{{ asset('kyna') }}/css/slick-theme.min.css?v=15217955218005" rel="stylesheet">
<link type="text/css" href="{{ asset('kyna') }}/css/slick.min.css?v=15217955218005" rel="stylesheet">
<link type="text/css" href="{{ asset('kyna') }}/css/main.css?v=15217955218005" rel="stylesheet">
<link type="text/css" href="{{ asset('kyna') }}/css/app.css?v=15217955218005" rel="stylesheet">
<link type="text/css" href="{{ asset('kyna') }}/css/sweetalert2.min.css?v=15217955218005" rel="stylesheet">
<link type="text/css" href="{{ asset('kyna') }}/css/home-page.css?v=15217955218005" rel="stylesheet">
{{-- Course --}}
<link type="text/css" href="{{ asset('kyna') }}/css/course-detail.css?v=15217955218005" rel="stylesheet">
<link type="text/css" href="{{ asset('kyna') }}/css/course-card.css?v=15217955218005" rel="stylesheet">
<link type="text/css" href="{{ asset('kyna') }}/css/select2.min.css?v=15217955218005" rel="stylesheet">
<link type="text/css" href="{{ asset('kyna/css/obn.css') }}?ver={{ time() }}" rel="stylesheet">
<script src="{{ asset('kyna') }}/js/jquery.min.js"></script>
<script src="{{ asset('kyna') }}/js/yii.js"></script>
<script src="{{ asset('kyna') }}/js/bootbox.js"></script>
@yield('custom_style')
