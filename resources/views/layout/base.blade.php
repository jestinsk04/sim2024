<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}">
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
    <link href="https://cdn.datatables.net/rowgroup/1.3.0/css/rowGroup.dataTables.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
    <!-- END: CSS Assets-->
    <style>
      body{
      font-family: 'Montserrat', sans-serif;
      }
      html .btn-primary {
      background: #ED6C1C!important;
      border-radius:26px !important;
      color:#025091;
      font-family: 'Montserrat', sans-serif;
      font-weight:bold;

      }
      .font-montserrat{
        font-family: 'Montserrat', sans-serif !important;
      }
      p{
        font-family: 'Montserrat', sans-serif !important;
      }
      span{
        font-family: 'Montserrat', sans-serif !important;
      }
      h1,h2,h3,h4,h5,h6{
        font-family: 'Montserrat', sans-serif !important;
      }
      .clear-layout {
      background-color: #025091 !important;

      }
      .clear-layout .select-country-section h4 {
      padding-right: 0rem !important;
      }
      @media(max-width: 500px) {
          .clear-layout .select-country-section h2 {
          
          margin-top: 0rem !important;
          }
          }
    </style>
</head>
<!-- END: Head -->

@yield('body')

</html>
