<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title',"Quản trị Website")</title>
<link rel="shortcut icon" type="image/png" href="https://media.loveitopcdn.com/itop.website/favicon.png" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700&amp;amp;subset=vietnamese"
    rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet"
    href="https://static.loveitopcdn.com/backend/plugins/mCustomScrollbar/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="https://static.loveitopcdn.com/backend/dist/css/plugin.css?id=a8f96327b6c3773821a1">
<link rel="stylesheet" href="https://static.loveitopcdn.com/backend/dist/css/style.css?id=fca89b87486ea1f07891">
<link media="all" type="text/css" rel="stylesheet"
    href="https://static.loveitopcdn.com/backend/css/custom_new.css?v=1.0.2">
    <link rel="stylesheet" href="{{ asset('obn-dashboard/css/obn.css') }}?ver={{ time() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://static.loveitopcdn.com/backend/dist/js/loading.js?id=7e97bd818d6bd28c3dc8"></script>
<style>
    .language-switch {
        display: none !important;
    }
    @media (min-width: 1024px) and (max-width: 1350px) {
        .hiden_1024_1350 {
            display: none;
        }
    }
    @media (min-width: 768px) and (max-width: 1023px) {
        .hiden_768_1023 {
            display: none !important;
        }
    }
    .media-preview {
        max-height: 50px;
        width: 83px;
    }
</style>
<script>
    var _token = 'NN2qLcQhx0Cv4lMh5Wl8yaKE7XXEdhqtl2VyI22q';
    var base_domain = '{{env("APP_URL")}}';
    var assets_url = base_domain + '/public';
    var cke_conf_path = assets_url + '/backend/plugins/ckeditor';
    var default_currency = 'đ';
    var default_weight_unit = "kg";
    var storage_url = '{{url("public/uploads/images")}}';
</script>
