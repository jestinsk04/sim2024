<!-- BEGIN: Top Bar -->
<div class="top-bar" style="padding-top: 3rem;">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
    <a href="javascript:void();" class="compress-menu">
    <div class="w-8 h-12 bg-default dark:bg-success/10 text-default flex items-center justify-center rounded-full mr-8" style="margin-right: 1rem;">
        <i class="w-8 h-8" style="color: #ED6C1C;" data-lucide="menu"></i>
     </div>
     </a>


        <ol class="breadcrumb">
     
            @if(isset($data['breadcrumb']))
        <li class="breadcrumb-item"><a href="#">{{$data['breadcrumb']}}</a></li>
            @endif
            @if(isset($data['breadcrumb2']))
        <li class="breadcrumb-item active" aria-current="page">{{$data['breadcrumb2']}}</li>
            @endif
     
    
        </ol>
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    <div class="hidden md:block intro-x relative mr-3 sm:mr-6">
        <div class="search hidden sm:block">
            <input type="text" id="search-input" class="search__input form-control border-transparent" placeholder="Buscar...">
            <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
        </div>
        <a class="notification sm:hidden" href="">
            <i data-lucide="search" class="notification__icon dark:text-slate-500"></i>
        </a>
        <div class="search-result">
            <div class="search-result__content">
                <div class="search-result__content__title">Resultados</div>
                <div class="mb-5" id="list-results">
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="pib" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">PIB</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="pib per capita" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">PIB per Capita</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="inflacion" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Inflación</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="salario minimo" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Salario Minimo</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="tasa de cambio" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Tasa de Cambio</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="indice big mac" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Indice Big Mac</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="poblacion activa" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Poblacion Activa</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="tasa de desempleo" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Tasa de Desempleo</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="consumo hpm" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Consumo HPM</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="share volume" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Share Volume</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="precio compra mb ep" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Precio compra mb-ep</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="share valor" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Share Valor</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="precios historicos hpm" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Precios Historicos HPM</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="plan operativo local" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Plan Operativo Local</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="plan operativo exportaciones" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Plan Operativo Exportaciones</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-usuario?layout=side-menu" data-valor="exportaciones hpm principales destinos" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Exportaciones HPM Principales destinos</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-demografico?layout=side-menu" data-valor="poblacion total" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Población Total</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-demografico?layout=side-menu" data-valor="diaspora venezolana" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Diaspora Venezolana</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-demografico?layout=side-menu" data-valor="total hogares" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Total Hogares</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-demografico?layout=side-menu" data-valor="personas por hogar" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Personas por hogar</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-demografico?layout=side-menu" data-valor="poblacion por area" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Población por area</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-demografico?layout=side-menu" data-valor="hogares por numeros de personas" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Hogares por numeros de personas</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-demografico?layout=side-menu" data-valor="poblacion migrante" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Población Migrante</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-demografico?layout=side-menu" data-valor="nse" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">NSE</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-demografico?layout=side-menu" data-valor="piramide poblacional" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Piramide Poblacional</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/dashboard-demografico?layout=side-menu" data-valor="distribucion del gasto por hogar" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Distribución del gasto por hogar</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/global-analisis?layout=side-menu" data-valor="analisis global" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Analisis Global</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/global-investigacion?layout=side-menu" data-valor="investigacion global" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Investigación Global</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/estudios-adhoc?layout=side-menu" data-valor="reportes ad hoc" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Reportes Ad Hoc</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/estudios-adhoc?layout=side-menu" data-valor="reportes ad hoc" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Reportes Ad Hoc</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/conexion-latina?layout=side-menu" data-valor="comunidad online" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Comunidad Online</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/conexion-latina?layout=side-menu" data-valor="actividades de engagement" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Actividades de Engagement</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/conexion-latina?layout=side-menu" data-valor="actividades de research" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Actividades de Research</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/panel-hogares?layout=side-menu" data-valor="panel hogares" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Panel Hogares</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/investigacion-otros?layout=side-menu" data-valor="investigacion de mercado - otros" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Investigación de mercado - Otros</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/valoracion-mercado?layout=side-menu" data-valor="valoracion de mercado" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Valoración de Mercado</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/valoracion-mercado?layout=side-menu" data-valor="mercado total consumo masivo" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Mercado total consumo masivo</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/valoracion-mercado?layout=side-menu" data-valor="relevancia de las categorias de mercado total" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Relevancia de las categorias de mercado total</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/valoracion-marca?layout=side-menu" data-valor="valor total marca" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Valor total marca</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/valoracion-marca?layout=side-menu" data-valor="valor marca pais" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Valor marca pais</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/redes-sociales?layout=side-menu" data-valor="rrss" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">RRSS</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/analisis-mercado-clientes?layout=side-menu" data-valor="clientes" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Clientes</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/segmentaciones?layout=side-menu" data-valor="segmentaciones" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Segmentaciones</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/analisis-otros?layout=side-menu" data-valor="analisis de mercado - otros" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Analisis de mercado - Otros</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/proveedores?layout=side-menu" data-valor="proveedores" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Proveedores</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/tendencias?layout=side-menu" data-valor="tendencias" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Tendencias</div>
                    </a>

                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="mercado local" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Mercado Local</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="datos socioeconomicos" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Datos Socioeconomicos</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="deficit fiscal" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Deficit Fiscal</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="reservas internacionales" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Reservas internacionales</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="tasas de interes" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Tasas de Interes</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="trm" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">TRM</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="margen" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Margen</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="volumen ventas ep" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Volumen Ventas EP</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="historico volumen" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Historico Volumen</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="historico $/kg" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Historico $/Kg</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="historico plan operativo vs real" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Historico Plan Operativo vs Real</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas?layout=side-menu" data-valor="comparativo hpm" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Comparativo HPM</div>
                    </a>
                    <a href="https://sim-ep.com/usuario/ventas-otros?layout=side-menu" data-valor="ventas - otros" class="flex items-center hidden">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="circle"></i>
                        </div>
                        <div class="ml-3">Ventas - Otros</div>
                    </a>
                    
                </div>


            </div>
        </div>
    </div>
    <!-- END: Search -->
    <!-- BEGIN: Notifications -->
    <div class="hidden md:block intro-x dropdown mr-auto sm:mr-6">
            
        <div class="dropdown-toggle notification @if(isset($data['notificaciones']))@if(count($data['notificaciones'])>0) notification--bullet @endif @endif  cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <i data-lucide="bell" class="notification__icon dark:text-slate-500"></i>
        </div>
        <div class="notification-content pt-2 dropdown-menu">
            <div class="notification-content__box dropdown-content">
                <div class="notification-content__title">Notificaciones</div>
                @if(isset($data['notificaciones']))
                @if(count($data['notificaciones'])>0)
                @foreach ($data['notificaciones'] as $key => $value)
                    <div class="cursor-pointer relative flex items-center {{ $key ? 'mt-5' : '' }}">
                        <div class="w-12 h-12 flex-none image-fit mr-1">
                            
                            <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600"></div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a href="javascript:;" class="font-medium truncate mr-5">{{ $value->title }}</a>
                                
                            </div>
                            <div class="w-full truncate text-slate-500 mt-0.5">{{ $value->description }}</div>
                        </div>
                    </div>
                @endforeach
                @endif
                @endif
            </div>
        </div>
    </div>
    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="hidden md:block intro-x dropdown w-8 h-8">
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
                    <a href="https://sim-ep.com/usuario/cambiar-clave?layout=side-menu" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i> Cambiar Clave
                    </a>
                </li>
                <li><hr class="dropdown-divider border-white/[0.08]"></li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Salir
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
