@extends('../layout/main-yellow')

@section('head')
@yield('subhead')
@endsection

@section('content')
@include('../layout/components/mobile-menu')
<div class="flex mt-[4.7rem] md:mt-0">
    <!-- BEGIN: Side Menu -->
    <div class="side-nav-fixed" style="width:360px;">
    <nav class="side-nav" style="border-top-left-radius: 48px;position:fixed;height: 100%;overflow-y: scroll;">
    <a href="" class="intro-x flex items-center pl-5 pt-4 logo-container">
            <img alt="" class="logo" src="{{ asset('build/assets/images/logo_polar.png') }}">
        </a>
            <div class="side-nav__country">

                <div class="flag"
                    style="background-image: url({{ $data['pais']->image }}); background-position: center; background-size: auto 100%; background-repeat:no-repeat;margin-right: 0.6rem;">

                </div>
                <span><strong>País:</strong>
                @if(Auth::user()->role_id == 0)
                <select class="intro-x login__input form-control py-3 px-4 block change-country" style="width: 170px;
display: block;
float: left;
margin-bottom: 2rem;
line-height: 16px;
margin-left: 10px;
margin-top: -6px;
background-color: #025091;
color: #fff;
border-color: #fff;" name="pais" id="">
                                @foreach($data['paises_list'] as $value)

                                    <option  @if($data['pais']->name == $value->name) selected @endif value="{{$value->name}}">{{$value->name}}</option>
                                @endforeach

                    </select>


                    @else
                    <select class="intro-x login__input form-control py-3 px-4 block change-country" style="width: 170px;
display: block;
float: left;
margin-bottom: 2rem;
line-height: 16px;
margin-left: 10px;
margin-top: -6px;
background-color: #025091;
color: #fff;
border-color: #fff;" name="pais" id="">
                                @foreach($data['paises'] as $value)

                                    <option @if($data['pais']->name == $value) selected @endif value="{{$value}}">{{$value}}</option>
                                @endforeach

                    </select>
                    @endif
                
                
                </span>

                

            </div>

      
        <br><br>

       <?php
            $paises = explode(",", Auth::user()->paises);
            $secciones = explode(",", Auth::user()->secciones);
            $subsecciones = explode(",", Auth::user()->subsecciones);
            $dashboard = explode(",", Auth::user()->dashboard);
       ?>
       @if(Auth::user()->role_id == 0)
       <ul style="clear:both">
     
            <li>
                <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" class="side-menu @if($data['menu'] == 'kpi') side-menu--active @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        KPI´s País
                        <div class="side-menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right"
                                class="lucide lucide-chevron-right">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
               
            </li>   
       

            <li>
                <a href="javascript:;" class="side-menu @if($data['menu'] == 'investigacion-mercado') side-menu--active side-menu--open @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        Investigación de mercados
                        <div class="side-menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down"
                                class="lucide lucide-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
                <ul class="@if($data['menu'] == 'investigacion-mercado') side-menu__sub-open @endif">

                <li>
                        <a href="https://sim-ep.com/usuario/global-investigacion?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'investigacion-global') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                               Investigación Global
                            </div>
                        </a>
                    </li>
                   
                    <li>
                        <a href="https://sim-ep.com/usuario/estudios-adhoc?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'estudios-adhoc') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                            Estudios Ad Hoc
                            </div>
                        </a>
                    </li>
          
                    <li>
                        <a href="https://sim-ep.com/usuario/conexion-latina?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'comunidad-online') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Comunidad Online
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/panel-hogares?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'panel-hogares') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Panel Hogares
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/proveedores?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'investigacion-sindicada') sub-menu-selected @endif" >
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Investigación Sindicada
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/investigacion-otros?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'investigacion-otros') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Otros
                            </div>
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="javascript:;" class="side-menu @if($data['menu'] == 'analisis-mercado') side-menu--active @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        Analisis de Mercado
                        <div class="side-menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down"
                                class="lucide lucide-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
                <ul class="@if($data['menu'] == 'analisis-mercado') side-menu__sub-open @endif">

                     <li>
                        <a href="https://sim-ep.com/usuario/global-analisis?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'global-analisis') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Analisis Global
                            </div>
                        </a>
                    </li>
                   
                    <li>
                        <a href="https://sim-ep.com/usuario/valoracion-mercado?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'valoracion-mercado') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                            Valoración de mercado
                            </div>
                        </a>
                    </li>
                
                    <li>
                        <a href="https://sim-ep.com/usuario/redes-sociales?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'redes-sociales') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                RRSS
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/analisis-mercado-clientes?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'analisis-mercado-clientes') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Clientes
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/segmentaciones?layout=side-menu"
                            class="side-menu  @if($data['sub-menu'] == 'segmentaciones') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Segmentaciones
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/analisis-otros?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'analisis-otros') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Otros
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="https://sim-ep.com/usuario/tendencias?layout=side-menu" class="side-menu @if($data['menu'] == 'tendencias') side-menu--active @endif">
                    <div class="side-menu__icon ">
                        
                    </div>
                    <div class="side-menu__title">
                        Tendencias
                        <div class="side-menu__sub-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right"
                                class="lucide lucide-chevron-right">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href="https://sim-ep.com/usuario/precios?layout=side-menu" class="side-menu @if($data['menu'] == 'precios') side-menu--active @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        Precios
                        <div class="side-menu__sub-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right"
                                class="lucide lucide-chevron-right">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
            </li>
        

           
            <li>
                <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" class="side-menu @if($data['menu'] == 'ventas') side-menu--active @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        Ventas
                        <div class="side-menu__sub-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right"
                                class="lucide lucide-chevron-right">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
            </li>
        

            
            <li>
                <a href="javascript:;" class="side-menu @if($data['menu'] == 'admin') side-menu--active @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        Admin
                        <div class="side-menu__sub-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right"
                                class="lucide lucide-chevron-right">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
                <ul class="">
         
                    <li>
                        <a href="http://sim-ep.com/admin/paises-display?layout=side-menu"
                            class="side-menu ">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Paises
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/regiones-display?layout=side-menu"
                            class="side-menu ">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Regiones
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/usuarios-display?layout=side-menu"
                            class="side-menu ">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Usuarios
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/data-add?layout=side-menu"
                            class="side-menu ">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Data
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/proveedores-display?layout=side-menu"
                            class="side-menu ">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Proveedores
                            </div>
                        </a>
                    </li>
              
                </ul>
            </li>
         
        </ul>


    @else
    
    <ul style="clear:both">
            @if(isset($data['permisos'][$data['pais']->name]['kpi']))
            
            <li>
                <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" class="side-menu @if($data['menu'] == 'kpi') side-menu--active @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        KPI´s País
                        <div class="side-menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right"
                                class="lucide lucide-chevron-right">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
               
            </li>   
            @endif
            @if(isset($data['permisos'][$data['pais']->name]['investigacion']))
            <li>
                <a href="javascript:;" class="side-menu @if($data['menu'] == 'investigacion-mercado') side-menu--active @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        Investigación de mercado
                        <div class="side-menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down"
                                class="lucide lucide-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
                <ul class="@if($data['menu'] == 'investigacion-mercado') side-menu__sub-open @endif">

                    @if(isset($data['permisos'][$data['pais']->name]['investigacion']['global']))
                    <li>
                        <a href="https://sim-ep.com/usuario/global-investigacion?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'investigacion-global') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                               Investigación Global
                            </div>
                        </a>
                    </li>
                    @endif
                     @if(isset($data['permisos'][$data['pais']->name]['investigacion']['adhoc']))
                    <li>
                        <a href="https://sim-ep.com/usuario/estudios-adhoc?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'estudios-adhoc') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                            Estudios Ad Hoc
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['investigacion']['online']))

                    <li>
                        <a href="https://sim-ep.com/usuario/conexion-latina?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'comunidad-online') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Comunidad Online
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['investigacion']['hogares']))
                    <li>
                        <a href="https://sim-ep.com/usuario/panel-hogares?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'panel-hogares') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Panel Hogares
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['investigacion']['sindicada']))
                    <li>
                        <a href="https://sim-ep.com/usuario/proveedores?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'investigacion-sindicada') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Investigación Sindicada
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['investigacion']['otros']))
                    <li>
                        <a href="https://sim-ep.com/usuario/investigacion-otros?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'investigacion-otros') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Otros
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(isset($data['permisos'][$data['pais']->name]['analisis']))
            <li>
                <a href="javascript:;" class="side-menu @if($data['menu'] == 'analisis-mercado') side-menu--active @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        Analisis de Mercado
                        <div class="side-menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down"
                                class="lucide lucide-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
                <ul class="@if($data['menu'] == 'analisis-mercado') side-menu__sub-open @endif">

                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['global']))
                    <li>
                        <a href="https://sim-ep.com/usuario/global-analisis?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'global-analisis') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Analisis Global
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['valoracion_mercado']))
                    <li>
                        <a href="https://sim-ep.com/usuario/valoracion-mercado?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'valoracion-mercado') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                            Valoración de mercado
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['rrss']))
                    <li>
                        <a href="https://sim-ep.com/usuario/redes-sociales?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'redes-sociales') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                RRSS
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['clientes']))
                    <li>
                        <a href="https://sim-ep.com/usuario/analisis-mercado-clientes?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'analisis-mercado-clientes') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Clientes
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['segmentaciones']))
                    <li>
                        <a href="https://sim-ep.com/usuario/segmentaciones?layout=side-menu"
                            class="side-menu  @if($data['sub-menu'] == 'segmentaciones') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Segmentaciones
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['otros']))
                    <li>
                        <a href="https://sim-ep.com/usuario/analisis-otros?layout=side-menu"
                            class="side-menu @if($data['sub-menu'] == 'analisis-otros') sub-menu-selected @endif">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Otros
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
  
            @if(isset($data['permisos'][$data['pais']->name]['tendencias']))

            <li>
                <a href="https://sim-ep.com/usuario/tendencias?layout=side-menu" class="side-menu @if($data['menu'] == 'tendencias') side-menu--active @endif">
                    <div class="side-menu__icon">
                        
                    </div>
                    <div class="side-menu__title">
                        Tendencias
                        <div class="side-menu__sub-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right"
                                class="lucide lucide-chevron-right">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
            </li>
            @endif

            @if(isset($data['permisos'][$data['pais']->name]['precios']))

            <li>
                <a href="https://sim-ep.com/usuario/precios?layout=side-menu" class="side-menu @if($data['menu'] == 'precios') side-menu--active @endif">
                    <div class="side-menu__icon">
                        
                    </div>
                    <div class="side-menu__title">
                        Precios
                        <div class="side-menu__sub-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right"
                                class="lucide lucide-chevron-right">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
            </li>
            @endif

            @if(isset($data['permisos'][$data['pais']->name]['ventas']))
            <li>
                <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" class="side-menu @if($data['menu'] == 'ventas') side-menu--active @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        Ventas
                        <div class="side-menu__sub-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right"
                                class="lucide lucide-chevron-right">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
            </li>
            @endif
        

            @if(isset($data['permisos']['Admin']))    
            <li>
                <a href="javascript:;" class="side-menu @if($data['menu'] == 'admin') side-menu--active @endif">
                    <div class="side-menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="side-menu__title">
                        Admin
                        <div class="side-menu__sub-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right"
                                class="lucide lucide-chevron-right">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
                <ul class="">
         
                    <li>
                        <a href="http://sim-ep.com/admin/paises-display?layout=side-menu"
                            class="side-menu ">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Paises
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/usuarios-display?layout=side-menu"
                            class="side-menu ">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Usuarios
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/data-add?layout=side-menu"
                            class="side-menu ">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Data
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/proveedores-display?layout=side-menu"
                            class="side-menu ">
                            <div class="side-menu__icon">

                            </div>
                            <div class="side-menu__title">
                                Proveedores
                            </div>
                        </a>
                    </li>
              
                </ul>
            </li>
            @endif
         
        </ul>
    
    @endif











    </nav>
</div>
    <!-- END: Side Menu -->
    <!-- BEGIN: Content -->
    <div class="content">
        @include('../layout/components/top-bar')
        @yield('subcontent')
    </div>
    <!-- END: Content -->
</div>
@endsection