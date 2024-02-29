@extends('../layout/' . $layout)

@section('subhead')
<title>Dashboard - Demografico - Usuario - SIMEP</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 md:col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-3xl font-bold truncate mr-5 w-full ">Información de Mercado H.P.M. (Nilsen)</h2>
                    <p>Tamaño Mercado(Nilsen)</p>
                </div>
                <div class="grid grid-cols-1 gap-6 mt-5 md:grid-cols-4">
                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class="p-5">

                                <div class="text-medium md:text-base text-slate-500 mt-1">EN VOLUMEN</div>
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6">51.000</div>

                                <div class="flex">
                                    <div class="">
                                        <div class="report-box__indicator report-text-success tooltip cursor-pointer"
                                            title="">
                                            Toneladas
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                                <div class="text-medium md:text-base text-slate-500 mt-1">EN VALOR</div>
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6">2.500</div>

                                <div class="flex">
                                    <div class="">
                                        <div class="report-box__indicator report-text-success tooltip cursor-pointer"
                                            title="Miles de $ ">
                                            Miles de $ <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-12 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Historico Precios H.P.M. </h2>
                            </div>
                        </div>
                        <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500  h-10">
                            <i data-lucide="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                            <input type="text" class="datepicker form-control sm:w-64 box pl-10">
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[275px]">
                            <canvas id="report-line-chart" class="mt-6 -mb-6"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-12 lg:col-span-12 mt-8">


                <div class="grid grid-cols-12 gap-6">
                    <div class=" col-span-6">

                        <div class="intro-y box p-5 mt-5 h-full">

                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Share Volumen</h2>
                            </div>

                            <div class="h-[400px]">
                                <canvas id="vertical-bar-chart-widget"></canvas>
                            </div>


                        </div>



                    </div>


                    <div class=" col-span-6">

                        <div class="intro-y box p-5 mt-5 h-full">

                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Share Valor</h2>
                            </div>

                            <div class="h-[400px]">
                                <canvas id="vertical-bar-chart-widget-3"></canvas>
                            </div>


                        </div>



                    </div>


                </div>



            </div>





            <div class="col-span-12 sm:col-span-12 lg:col-span-12 mt-8">

                <div class="intro-y box p-5 mt-5 ">

                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Distribución del gasto por hogar</h2>
                    </div>
                    <div class="">
                        <canvas id="vertical-bar-chart-widget-2"></canvas>
                    </div>



                </div>



            </div>










        </div>
    </div>
</div>
@endsection