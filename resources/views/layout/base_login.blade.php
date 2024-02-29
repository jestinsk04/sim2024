<!DOCTYPE html>

<html style="height:100% !important;" lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('build/assets/images/logo_polar.png') }}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    @yield('head')

    <!-- BEGIN: CSS Assets-->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <!-- END: CSS Assets-->
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
        }
        .login{
            padding-top: 0% !important;
        }
        .login .login__input {
min-width: 320px;
border-radius: 26px !important;
height: 65px;
font-size: 24px;
font-family: 'Montserrat', sans-serif;
max-width: 320px;
margin: 0px auto;
}
html .btn-primary {
    min-width: 320px;
height: 65px;
background-color: #ED6C1C !important;
border-radius: 26px !important;
color: #025091;
font-size: 24px;
font-weight: bold;
font-family: 'Montserrat', sans-serif;
max-width: 320px;
margin: 0px auto;
}

        @media (max-width: 1279px){
            .login {

padding-top: 0px !important;
}
        }

    </style>
</head>
<!-- END: Head -->

@yield('body')

</html>
