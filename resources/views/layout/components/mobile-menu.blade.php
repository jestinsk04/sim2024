<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="" class="w-24" src="{{ asset('build/assets/images/logo_polar.png') }}">
        </a>

            <!-- BEGIN: Search -->
    <div class="intro-x relative mr-3 sm:mr-6">
        <div class="search hidden sm:block">
            <input type="text" class="search__input form-control border-transparent" placeholder="Buscar...">
            <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
        </div>
        <a class="notification sm:hidden" href="">
            <i data-lucide="search" class="notification__icon dark:text-slate-500"></i>
        </a>
        <div class="search-result">
            <div class="search-result__content">
                <!-- <div class="search-result__content__title">Pages</div>
                <div class="mb-5">
                    <a href="" class="flex items-center">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="inbox"></i>
                        </div>
                        <div class="ml-3">Mail Settings</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="users"></i>
                        </div>
                        <div class="ml-3">Users & Permissions</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="credit-card"></i>
                        </div>
                        <div class="ml-3">Transactions Report</div>
                    </a>
                </div>
                <div class="search-result__content__title">Users</div>
                <div class="mb-5">
                    @foreach (array_slice($fakers, 0, 4) as $faker)
                        <a href="" class="flex items-center mt-2">
                            <div class="w-8 h-8 image-fit">
                                <img alt="" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['photos'][0]) }}">
                            </div>
                            <div class="ml-3">{{ $faker['users'][0]['name'] }}</div>
                            <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">{{ $faker['users'][0]['email'] }}</div>
                        </a>
                    @endforeach
                </div>
                <div class="search-result__content__title">Products</div>
                @foreach (array_slice($fakers, 0, 4) as $faker)
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][0]) }}">
                        </div>
                        <div class="ml-3">{{ $faker['products'][0]['name'] }}</div>
                        <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">{{ $faker['products'][0]['category'] }}</div>
                    </a>
                @endforeach -->
            </div>
        </div>
    </div>
    <!-- END: Search -->
    <!-- BEGIN: Notifications -->
    <div class="intro-x dropdown mr-3 sm:mr-6">
        <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <i data-lucide="bell" class="notification__icon dark:text-slate-500"></i>
        </div>
        <div class="notification-content pt-2 dropdown-menu">
            <div class="notification-content__box dropdown-content">
                <div class="notification-content__title">Notificaciones</div>
                @foreach (array_slice($fakers, 0, 5) as $key => $faker)
                    <!-- <div class="cursor-pointer relative flex items-center {{ $key ? 'mt-5' : '' }}">
                        <div class="w-12 h-12 flex-none image-fit mr-1">
                            <img alt="" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['photos'][0]) }}">
                            <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600"></div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a href="javascript:;" class="font-medium truncate mr-5">{{ $faker['users'][0]['name'] }}</a>
                                <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">{{ $faker['times'][0] }}</div>
                            </div>
                            <div class="w-full truncate text-slate-500 mt-0.5">{{ $faker['news'][0]['short_content'] }}</div>
                        </div>
                    </div> -->
                @endforeach
            </div>
        </div>
    </div>
    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8 mr-3">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <img alt="" src="https://sim-ep.com/storage/uploads/{{Auth::user()->image}}">
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary text-white">
                <li class="p-2">
                    <div class="font-medium">{{Auth::user()->name}} {{Auth::user()->lname}}</div>
                    @if(Auth::user()->role_id == 0)
                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">Admin</div>
        @else
        <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">Usuario</div>
        @endif
                    
                </li>
                <li><hr class="dropdown-divider border-white/[0.08]"></li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i> Perfil
                    </a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Ayuda
                    </a>
                </li>
                <li><hr class="dropdown-divider border-white/[0.08]"></li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->


        <a href="javascript:;" class="mobile-menu-toggler">
        <img alt="" class="w-8 h-8 transform" src="{{ asset('build/assets/images/icono_dashboard.svg') }}">
        </a>
    </div>
    <div class="scrollable">
        <a href="javascript:;" class="mobile-menu-toggler">
       
            <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
        @if(Auth::user()->role_id == 0)
        <ul class="scrollable__content py-2">
            <li>
                <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" class="menu @if($data['menu'] == 'kpi') menu--active @endif">
                    <div class="menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="menu__title">
                        KPI´s País
                        <div class="menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down"
                                class="lucide lucide-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
            </li>  

            <li>
                <a href="javascript:;" class="menu @if($data['menu'] == 'investigacion-mercado') menu--active @endif">
                    <div class="menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="menu__title">
                        Investigación de mercado
                        <div class="menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down"
                                class="lucide lucide-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
                <ul class="">
                <li>
                        <a href="https://sim-ep.com/usuario/global-investigacion?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                               Investigación Global
                            </div>
                        </a>
                    </li>
                   
                    <li>
                        <a href="https://sim-ep.com/usuario/estudios-adhoc?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                            Estudios Ad Hoc
                            </div>
                        </a>
                    </li>
          
                    <li>
                        <a href="https://sim-ep.com/usuario/conexion-latina?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Comunidad Online
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/panel-hogares?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Panel Hogares
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/proveedores?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Información Sindicada
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/investigacion-otros?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Otros
                            </div>
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="javascript:;" class="menu @if($data['menu'] == 'analisis-mercado') menu--active @endif">
                    <div class="menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="menu__title">
                        Analisis de Mercado
                        <div class="menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down"
                                class="lucide lucide-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
                <ul class="">
                <li>
                        <a href="https://sim-ep.com/usuario/global-analisis?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                               Analisis Global
                            </div>
                        </a>
                    </li>
                   
                    <li>
                        <a href="https://sim-ep.com/usuario/valoracion-mercado?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                            Valoración de mercado
                            </div>
                        </a>
                    </li>
                  
                    <li>
                        <a href="https://sim-ep.com/usuario/valoracion-marca?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                            Valoración de marca
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/redes-sociales?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                RRSS
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/analisis-mercado-clientes?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Clientes
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/segmentaciones?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Segmentaciones
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sim-ep.com/usuario/analisis-otros?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Otros
                            </div>
                        </a>
                    </li>
                </ul>
            </li>

           

            <li>
                <a href="https://sim-ep.com/usuario/tendencias?layout=side-menu" class="menu">
                    <div class="menu__icon">
                        
                    </div>
                    <div class="menu__title">
                        Tendencias
                        <div class="menu__sub-icon">
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
                <a href="javascript:;" class="menu @if($data['menu'] == 'ventas') menu--active @endif">
                    <div class="menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="menu__title">
                        Ventas
                        <div class="menu__sub-icon">
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
                        <a href="https://sim-ep.com/usuario/ventas?layout=side-menu"
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Mercado Local
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="https://sim-ep.com/usuario/ventas-otros?layout=side-menu"
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Otros
                            </div>
                        </a>
                    </li>
              
                </ul>
            </li>
        

            
            <li>
                <a href="javascript:;" class="menu @if($data['menu'] == 'admin') menu--active @endif">
                    <div class="menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="menu__title">
                        Admin
                        <div class="menu__sub-icon">
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
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Paises
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/usuarios-display?layout=side-menu"
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Usuarios
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/data-add?layout=side-menu"
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Data
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/proveedores-display?layout=side-menu"
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Proveedores
                            </div>
                        </a>
                    </li>
              
                </ul>
            </li>
         
        </ul>

        @else

        <ul class="scrollable__content py-2" style="clear:both">
            @if(isset($data['permisos'][$data['pais']->name]['kpi']))
            <li>
                <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" class="menu @if($data['menu'] == 'kpi') menu--active @endif">
                    <div class="menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="menu__title">
                        KPI´s País
                        <div class="menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down"
                                class="lucide lucide-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
            </li>  
            @endif
            @if(isset($data['permisos'][$data['pais']->name]['investigacion']))
            <li>
                <a href="javascript:;" class="menu @if($data['menu'] == 'investigacion-mercado') menu--active @endif">
                    <div class="menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="menu__title">
                        Investigación de mercado
                        <div class="menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down"
                                class="lucide lucide-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
                <ul class="">
                <li>
                        <a href="https://sim-ep.com/usuario/global-investigacion?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                               Investigación Global
                            </div>
                        </a>
                    </li>
                     @if(isset($data['permisos'][$data['pais']->name]['investigacion']['adhoc']))
                    <li>
                        <a href="https://sim-ep.com/usuario/estudios-adhoc?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                            Estudios Ad Hoc
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['investigacion']['online']))

                    <li>
                        <a href="https://sim-ep.com/usuario/conexion-latina?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Comunidad Online
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['investigacion']['hogares']))
                    <li>
                        <a href="https://sim-ep.com/usuario/panel-hogares?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Panel Hogares
                            </div>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="https://sim-ep.com/usuario/proveedores?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Información Sindicada
                            </div>
                        </a>
                    </li>
                    @if(isset($data['permisos'][$data['pais']->name]['investigacion']['otros']))
                    <li>
                        <a href="https://sim-ep.com/usuario/investigacion-otros?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
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
                <a href="javascript:;" class="menu @if($data['menu'] == 'analisis-mercado') menu--active @endif">
                    <div class="menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="menu__title">
                        Analisis de Mercado
                        <div class="menu__sub-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down"
                                class="lucide lucide-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
                <ul class="">
                <li>
                        <a href="https://sim-ep.com/usuario/global-analisis?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                               Analisis Global
                            </div>
                        </a>
                    </li>
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['valoracion_mercado']))
                    <li>
                        <a href="https://sim-ep.com/usuario/valoracion-mercado?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                            Valoración de mercado
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['valoracion_marca']))
                  
                    <li>
                        <a href="https://sim-ep.com/usuario/valoracion-marca?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                            Valoración de marca
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['rrss']))
                    <li>
                        <a href="https://sim-ep.com/usuario/redes-sociales?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                RRSS
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['clientes']))
                    <li>
                        <a href="https://sim-ep.com/usuario/analisis-mercado-clientes?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Clientes
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['segmentaciones']))
                    <li>
                        <a href="https://sim-ep.com/usuario/segmentaciones?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Segmentaciones
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['analisis']['otros']))
                    <li>
                        <a href="https://sim-ep.com/usuario/analisis-otros?layout=side-menu"
                            class="menu">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
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
                <a href="https://sim-ep.com/usuario/tendencias?layout=side-menu" class="menu">
                    <div class="menu__icon">
                        
                    </div>
                    <div class="menu__title">
                        Tendencias
                        <div class="menu__sub-icon">
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
                <a href="javascript:;" class="menu @if($data['menu'] == 'ventas') menu--active @endif">
                    <div class="menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="menu__title">
                        Ventas
                        <div class="menu__sub-icon">
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
                    @if(isset($data['permisos'][$data['pais']->name]['ventas']['local']))
                    <li>
                        <a href="https://sim-ep.com/usuario/ventas?layout=side-menu"
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Mercado Local
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(isset($data['permisos'][$data['pais']->name]['ventas']['otros']))
                    <li>
                        <a href="https://sim-ep.com/usuario/ventas-otros?layout=side-menu"
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Otros
                            </div>
                        </a>
                    </li>
                    @endif
              
                </ul>
            </li>
            @endif
        

            @if(isset($data['permisos']['Admin']))    
            <li>
                <a href="javascript:;" class="menu @if($data['menu'] == 'admin') menu--active @endif">
                    <div class="menu__icon">
                        <i data-lucide=""></i>
                    </div>
                    <div class="menu__title">
                        Admin
                        <div class="menu__sub-icon">
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
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Paises
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/usuarios-display?layout=side-menu"
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Usuarios
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/data-add?layout=side-menu"
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Data
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="http://sim-ep.com/admin/proveedores-display?layout=side-menu"
                            class="menu ">
                            <div class="menu__icon">

                            </div>
                            <div class="menu__title">
                                Proveedores
                            </div>
                        </a>
                    </li>
              
                </ul>
            </li>
            @endif
         
        </ul>
    
        @endif
    </div>
</div>
<!-- END: Mobile Menu -->
