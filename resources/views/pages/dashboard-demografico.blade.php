@extends('../layout/' . $layout)

@section('subhead')
<title>Dashboard - SIMEP</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Salud País</h2>
                </div>
                <div class="grid grid-cols-5 gap-6 mt-5">
                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class="p-5">

                                <div class="text-base text-slate-500 mt-1">PIB (US$mm)</div>
                                <div class="text-3xl font-medium leading-8 mt-6">271.448</div>

                                <div class="flex">
                                    <div class="">
                                        <div class="report-box__indicator report-text-success tooltip cursor-pointer"
                                            title="33% Higher than last month">
                                            33% Higher than last month<i data-lucide="chevron-up"
                                                class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                                <div class="text-base text-slate-500 mt-1">PIB PER CAPITA</div>
                                <div class="text-3xl font-medium leading-8 mt-6">5.335</div>

                                <div class="flex">
                                    <div class="">
                                        <div class="report-box__indicator report-text-error tooltip cursor-pointer"
                                            title="5% ($/Hab)">
                                            5% ($/Hab)<i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                                <div class="text-base text-slate-500 mt-1">INFLACIÓN</div>
                                <div class="text-3xl font-medium leading-8 mt-6">9.07%</div>

                                <div class="flex">
                                    <div class="">
                                        <div class="report-box__indicator report-text-success tooltip cursor-pointer"
                                            title="4% a Mayo">
                                            4% a Mayo<i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                                <div class="text-base text-slate-500 mt-1">SALARIO MÍNIMO</div>
                                <div class="text-3xl font-medium leading-8 mt-6">1.000.000</div>

                                <div class="flex">
                                    <div class="">
                                        <div class="report-box__indicator report-text-success tooltip cursor-pointer"
                                            title="COP">
                                            COP<i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                                <div class="text-base text-slate-500 mt-1">TASA DE CAMBIO</div>
                                <div class="text-3xl font-medium leading-8 mt-6">$4.500</div>

                                <div class="flex">
                                    <div class="">
                                        <div class="report-box__indicator report-text-success tooltip cursor-pointer"
                                            title="4% COP">
                                            4% COP<i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                                <div class="text-base text-slate-500 mt-1">ÍNDICE BIG MAC</div>
                                <div class="text-3xl font-medium leading-8 mt-6">-43.5</div>

                                <div class="flex">
                                    <div class="">
                                        <div class="report-box__indicator report-text-success tooltip cursor-pointer"
                                            title="">
                                            <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                                <div class="text-base text-slate-500 mt-1">POBLACION ACTIVA</div>
                                <div class="text-3xl font-medium leading-8 mt-6">48.79%</div>

                                <div class="flex">
                                    <div class="">
                                        <div class="report-box__indicator report-text-success tooltip cursor-pointer"
                                            title="">
                                            <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                                <div class="text-base text-slate-500 mt-1">TASA DE DESEMPLEO</div>
                                <div class="text-3xl font-medium leading-8 mt-6">10.6%</div>

                                <div class="flex">
                                    <div class="">
                                        <div class="report-box__indicator report-text-success tooltip cursor-pointer"
                                            title="">
                                            <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Información General</h2>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-3 mt-8 grid grid-cols-1">
                <div class="report-box box p-5 mt-12 sm:mt-5 grid grid-cols-4">
                    <div>
                        <i data-lucide="play-circle" class="w-10 h-10 z-10 absolute my-auto inset-y-0 ml-8 left-0"></i>
                    </div>
                    <div class="col-span-3">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Consumo H.P.M</h2>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">4.7 <small>KG/HAB</small></h2>
                        </div>
                    </div>


                </div>

                <div class="report-box box p-5 mt-12 sm:mt-5 grid grid-cols-4">
                    <div>
                        <i data-lucide="bar-chart" class="w-10 h-10 z-10 absolute my-auto inset-y-0 ml-8 left-0"></i>
                    </div>
                    <div class="col-span-3">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Share Volumen</h2>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">4.8 %</h2>
                        </div>
                    </div>


                </div>

                <div class="report-box box p-5 mt-12 sm:mt-5 grid grid-cols-4">
                    <div>
                        <i data-lucide="message-circle"
                            class="w-10 h-10 z-10 absolute my-auto inset-y-0 ml-8 left-0"></i>
                    </div>
                    <div class="col-span-3">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Precio Compra MB-EP</h2>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">344 <small>$/TONELADAS</small></h2>
                        </div>
                    </div>


                </div>

                <div class="report-box box p-5 mt-12 sm:mt-5 grid grid-cols-4">
                    <div>
                        <i data-lucide="check-circle-2"
                            class="w-10 h-10 z-10 absolute my-auto inset-y-0 ml-8 left-0"></i>
                    </div>
                    <div class="col-span-3">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Share VALOR</h2>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">4.7 %</h2>
                        </div>
                    </div>


                </div>



            </div>
            <div class="col-span-12 lg:col-span-9 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-3 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Precios Histórico H.P.M</h2>
                            </div>
                        </div>
                        <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500">
                            <i data-lucide="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                            <input type="text" class="datepicker form-control sm:w-56 box pl-10">
                        </div>
                    </div>
                    <div class="col-span-2 report-chart ">
                        <div class="h-[275px]">
                            <canvas id="report-line-chart" class="mt-6 -mb-6"></canvas>
                        </div>
                    </div>
                    <div class="">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Variación H.P.M mes anterior</h2>
                        </div>

                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">P.A.N</h2>
                        </div>

                        <div class="progress mt-3">

                            <div class="progress-bar w-1/2" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Doña Arepa</h2>
                        </div>
                        <div class="progress mt-3">

                            <div class="progress-bar w-2/3 bg-success" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Arepasan</h2>
                        </div>
                        <div class="progress mt-3">

                            <div class="progress-bar w-3/4 bg-warning" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Otras</h2>
                        </div>
                        <div class="progress mt-3">

                            <div class="progress-bar w-3/4 bg-danger" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Sales Report -->
            <!-- BEGIN: Weekly Top Seller -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-6 mt-8">

                <div class="intro-y box p-5 mt-5">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Avance Plan Operativo H.P.M</h2>
                    </div>
                    <div class="mt-3">
                        <div class="h-[213px]">
                            <canvas id="report-half-donut-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 lg:col-span-6 mt-8">

                <div class="intro-y box p-5 mt-5">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5"></h2>
                    </div>
                    <div class="mt-3">
                        <div class="h-[213px]">
                            <canvas id="report-half-donut-chart-2"></canvas>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-span-12 sm:col-span-12 lg:col-span-12 mt-8">
               

                <div class="intro-y box p-5 mt-5">

                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Exportaciones H.P.M Principales destinos</h2>
                </div>
                    <div class="progress mt-12">
                        <div class="progress-bar w-1/2" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>

                    <div class="progress mt-12">
                        <div class="progress-bar w-1/2" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>

                    <div class="progress mt-12">
                        <div class="progress-bar w-1/2" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>

                    <div class="progress mt-12">
                        <div class="progress-bar w-1/2" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>

                    <div class="progress mt-12">
                        <div class="progress-bar w-1/2" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <!-- END: Weekly Top Seller -->



        </div>
    </div>
</div>
@endsection