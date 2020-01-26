<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ config('app.url') }}">
    @yield('meta')

    <!-- Favicon icon -->
    <link rel="icon" type="{{asset('/image/png')}}" sizes="16x16" href="images/favicon.png">
    <title>Panel de administración | @yield('htmlheader_title', 'Your title here')</title>

    <link rel="stylesheet" href="{{asset('/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bundle/css/vendor.bundle.base.css')}}">

    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">

</head>