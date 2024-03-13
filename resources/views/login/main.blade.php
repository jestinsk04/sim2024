@extends('../layout/' . $layout)

@section('head')
    <title>Login - SIMEP</title>
@endsection

@section('content')
    <div class="flex sm:px-10" style="align-items: center;justify-content: center;height: 100%;">
        <div class="block xl:grid grid-cols-1 gap-4" style="min-width: 350px; align-self: center;">
            <!-- BEGIN: Login Form -->
            <div class="xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0  mx-auto">
                <div class="md:my-auto mx-auto dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-center" style="color: #FFFFFF !important;font-family: 'Montserrat', sans-serif;font-weight: bold;">S I M E P</h2>
                   
                    <div class="intro-x mt-8">
                        <form id="login-form">
                            @csrf
                            <input id="email" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Email" value="">
                            <div id="error-email" class="login__input-error text-danger mt-2"></div>
                            <input id="password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password" value="">
                            <div id="error-password" class="login__input-error text-danger mt-2"></div>
                        </form>
                    </div>

                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-center">
                        <button id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" style="color: #FFFFFF">Ingresar</button>
                 
                    </div>
                    <div class="intro-x mt-10 xl:mt-4 text-slate-600 dark:text-slate-500 text-center xl:text-center">
                        <img alt="" style="width:200px; margin:0px auto;" class="logo" src="{{ asset('build/assets/images/log_blanco.png') }}">
                    </div>
                    <div class="intro-x mt-10 text-slate-600 dark:text-slate-500 text-center xl:text-center color-white" style="color: #FFFFFF !important;font-family: 'Montserrat', sans-serif; font-size:24px;">
                        Al ingresar aceptas los <a class="text-primary dark:text-slate-200 color-white" href="">Términos y condiciones</a>
                    </div>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
@endsection

@section('script')
    <script type="module">
        (function () {
            async function login() {
                // Reset state
                $('#login-form').find('.login__input').removeClass('border-danger')
                $('#login-form').find('.login__input-error').html('')

                // Post form
                let email = $('#email').val()
                let password = $('#password').val()

                // Loading state
                $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
                tailwind.svgLoader()
                await helper.delay(1500)

                axios.post(`login`, {
                    email: email,
                    password: password
                }).then(res => {
                    location.href = '/'
                }).catch(err => {
                    $('#btn-login').html('Login')
                    if (err.response.data.message != 'Wrong email or password.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            $(`#${key}`).addClass('border-danger')
                            $(`#error-${key}`).html(val)
                        }
                    } else {
                        $(`#password`).addClass('border-danger')
                        $(`#error-password`).html(err.response.data.message)
                    }
                })
            }

            $('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })

            $('#btn-login').on('click', function() {
                login()
            })
        })()
    </script>
@endsection
