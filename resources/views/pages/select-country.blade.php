@extends('../layout/' . $layout)

@section('head')
    <title>Seleccionar Pais - SIMEP</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4 xl:mt-24">
            
            <div class="hidden xl:flex flex-col min-h-screen select-country-section">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="" class="logo" src="{{ asset('build/assets/images/logo_polar.png') }}">  
                </a>
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-center">SIMEP</h2>
                <h4 class="mt-8">Sistema de Información de la Gerencia de Analísis e Investigación de Mercados</h4>
                <p class="mt-8">Comprende la integración de las diferentes fuentes de información (Estudios y Analisis de mercados) de la organización</p>
                <ul>
                    <li class="mt-4">KPI Por País</li>
                    <li class="mt-4">Analisis de relacionamiento estrategico</li>
                    <li class="mt-4">Reportes de Analisis e Investigacion de mercados</li>
                    <li class="mt-4">Ventas</li>
                </ul>
            </div>
 
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 select-country-section-2">
                <div class="bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full">
                    <div class="intro-x mt-8">
                        <img alt="" class="" src="{{ asset('build/assets/images/mapa.svg') }}">  
                    </div>
        
                    <div class="intro-x mt-8">
                        <form id="login-form">
                            <input id="email" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Colombia" value="Colombia"> 
                        </form>
                    </div>

                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-center">
                        <a href="/dashboard" id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Ver Información</a>
                 
                    </div>
                    
                </div>
            </div>
         
        </div>
    </div>
@endsection

@section('script')
    
@endsection
