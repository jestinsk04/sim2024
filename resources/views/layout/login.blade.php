@extends('../layout/base_login')

@section('body')
    <body class="login" style="background-size: 100%;background-image: url(https://sigaim.aeriousport.com/build/assets/images/fondo_new_3.jpg) !important;background-color:#025091;background-repeat: no-repeat;background-size: cover !important;background-position: center center;">
        @yield('content')

        <!-- BEGIN: JS Assets-->
        @vite('resources/js/app.js')
        <!-- END: JS Assets-->


        @yield('script')

        <script>
             document.addEventListener('contextmenu', event => event.preventDefault());
        </script>
    </body>
@endsection
