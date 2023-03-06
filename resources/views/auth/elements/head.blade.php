<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title','Đăng nhập')</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="robots" content="noindex, nofollow">
<link media="all" type="text/css" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css">
<link rel="stylesheet" href="{{ asset('obn-dashboard/css/plugin.css') }}?id={{ time() }}">
<link rel="stylesheet" href="{{ asset('obn-dashboard/css/style.css') }}?id={{ time() }}">
<link rel="stylesheet" href="{{ asset('obn-dashboard/css/obn.css') }}?id={{ time() }}">
