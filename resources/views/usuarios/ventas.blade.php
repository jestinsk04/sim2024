@extends('../layout/' . $layout)

@section('subhead')
<title>Dashboard - Usuario - SIMEP</title>
<link href="https://sim-ep.com/build/assets/jquery-jvectormap-2.0.5.css" rel="stylesheet">
<style>
    table.dataTable tr.dtrg-group.dtrg-level-0 td {
    font-weight: bold;
}
table.dataTable tr.dtrg-group td {
    background-color: #e0e0e0;
}
table.dataTable tr.dtrg-group.dtrg-level-1 td:first-child{
    padding-left: 2em;
}
table.dataTable tr.dtrg-group.dtrg-level-1 td{
    background-color: #f0f0f0;
    padding-top: 0.25em;
    padding-bottom: 0.25em;
}
table.dataTable tr.dtrg-group.dtrg-level-2 td:first-child {
    padding-left: 3em;
}
table.dataTable tr.dtrg-group.dtrg-level-2 td {
    background-color: #fff0f0;
}
table.dataTable.compact tbody tr td.order_id {
    padding-left: 4em;
}
</style>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
        
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 md:col-span-12 mt-8">
                <div class="intro-y items-center ">
                    <h2 class="text-3xl font-bold truncate mr-5 w-full title-section">Mercado Local</h2>

                    <div class="col-span-12">
                        <div class=" mt-8">
                            <div class="px-2">
                                <div class="h-full  rounded-md">

                                    <p>Información Local de ventas, márgenes y avances del plan operativo. Ventas por región y categorías.</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>



            </div>
           
            <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-3xl font-bold xl:truncate mr-5">Datos Socio - Económicos</h2>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-3 mt-8 grid grid-cols-1">
                <div class="report-box box p-5 sm:mt-5 grid grid-cols-4">
                    <div>
                    <img alt="" class="w-10 h-10 z-10 absolute my-auto inset-y-0 ml-8 left-0" src="{{ asset('build/assets/images/icono_play.svg') }}">
                    </div>
                    <div class="col-span-3">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5 tooltip" title="Deficit Fiscal">Deficit Fiscal</h2>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">{{$data["deficit"]}} <small>$$</small></h2>
                        </div>
                    </div>


                </div>

                <div class="report-box box p-5 mt-12 sm:mt-5 grid grid-cols-4">
                    <div>
                    <img alt="" class="w-10 h-10 z-10 absolute my-auto inset-y-0 ml-8 left-0" src="{{ asset('build/assets/images/icono_info.svg') }}">
                        <!-- <i data-lucide="bar-chart" class="w-10 h-10 z-10 absolute my-auto inset-y-0 ml-8 left-0"></i> -->
                    </div>
                    <div class="col-span-3">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5 tooltip" title="Reservas Internacionales">Reservas Inter</h2>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">{{$data["reservas"]}} $/$</h2>
                        </div>
                    </div>


                </div>

                <div class="report-box box p-5 mt-12 sm:mt-5 grid grid-cols-4">
                    <div>
                    <img alt="" class="w-10 h-10 z-10 absolute my-auto inset-y-0 ml-8 left-0" src="{{ asset('build/assets/images/icono_message.svg') }}">
                    </div>
                    <div class="col-span-3">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5 tooltip" title="Tasa de Interes">Tasa de Interes</h2>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">{{$data["tasa"]}}% </h2>
                        </div>
                    </div>


                </div>

                <div class="report-box box p-5 mt-12 sm:mt-5 grid grid-cols-4">
                    <div>

                    <img alt="" class="w-10 h-10 z-10 absolute my-auto inset-y-0 ml-8 left-0" src="{{ asset('build/assets/images/icono_checkmark.svg') }}">
                    </div>
                    <div class="col-span-3">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5 tooltip" title="Tasa representativa de mercado">TRM</h2>
                        </div>
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">{{$data["trm"]}}%</h2>
                        </div>
                    </div>


                </div>



            </div>
            
            <div class="col-span-12 lg:col-span-9 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-12">
                        <div class="w-full xl:h-10">
                            <div class="intro-y block items-center  xl:h-10 overflow-auto lg:overflow-visible">
                                <h2 class="text-lg font-medium truncate mr-5">Margen</h2>

                                <table class="table mt-4 col-span-12" id="table-margen">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Categoría</th>
                                <th class="whitespace-nowrap">Volumen</th>
                                <th class=" whitespace-nowrap">Ventas</th>
                                <th class=" whitespace-nowrap">Margen</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            @if(count($data["ventas_8"]) > 0)
                                @foreach($data["ventas_8"] as $value)


                                <tr class="intro-x">
                                <td class="">{{$value->name}}</td>
                                <td class="">{{$value->volumen}}</td>
                                <td class="">{{$value->ventas}}</td>
                                <td class="">{{$value->valor*100}}</td>
                               
                              
                            </tr>

                                @endforeach

                                @endif



                        </tbody>
                    </table>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-span-6 md:col-span-2 report-chart ">
                        
                    </div>
              
                </div>
            </div>


        <div class="col-span-12 md:col-span-12 mt-8 box">
            <div class="grid grid-cols-1 intro-y box p-5 mt-12 sm:mt-5 h-full">

            <ul class="nav nav-boxed-tabs overflow-auto mt-8 md:mt-8" role="tablist">
                    <li id="example-3-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2 active" data-tw-toggle="pill"
                            data-tw-target="#example-tab-3" type="button" role="tab" aria-controls="example-tab-3"
                            aria-selected="true">
                            Total Pais
                        </button>
                    </li>
                    <li id="example-4-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-4"
                            type="button" role="tab" aria-controls="example-tab-4" aria-selected="false">
                            Regiones
                        </button>
                    </li>


            </ul>

            <div class="tab-content mt-14">
                <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel"
                    aria-labelledby="example-3-tab">

                    <div class="col-span-12 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Volumen Ventas  EP </h2>
                            </div>
                        </div>
                    </div>

                      <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                                <div class="grid grid-cols-12 gap-2 mt-4  mb-4">
                                    <select class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option>Periodo</option>
                                        @if(count($data['ventas_3_periodo']) > 0)
                                            @foreach($data['ventas_3_periodo'] as $key => $value)

                                                <option @if($data['ventas_3_periodo_selected'] == $value->periodo) selected @endif value="{{$value->periodo}}">{{$value->periodo}}</option>
                                            @endforeach
                                            @endif
                                    </select>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="table table-report mt-4 col-span-6" id="table-total-pais">
                                        <thead>
                                            <tr>
                                                <th class="text-center whitespace-nowrap">Categoria</th>
                                                <th class="text-center whitespace-nowrap">Volumen (Ton)</th>
                                                <th class="text-center whitespace-nowrap">Valor(COP)</th>
                                                <th class="text-center whitespace-nowrap">$COP/KG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        @if(count($data['ventas_3']) > 0)
                                @foreach($data['ventas_3'] as $key => $value)
                                <tr class="intro-x">
                                    <td class="text-center">{{$value->categoria}}</td>
                                    <td class="text-center">{{number_format($value->volumen,"2",",",".")}}</td>
                                    <td class="text-center">{{number_format($value->valor,"2",",",".")}}</td>
                                    <td class="text-center">{{number_format($value->valor_2,"2",",",".")}}</td>
        
                                </tr>
                                @endforeach
                            @endif
                                           
                                          
                                          
                                           
    
    
    
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>

                    
                    



                </div>
                <div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel"
                    aria-labelledby="example-4-tab">
                    
                        <div class="col-span-12 lg:col-span-12 mt-8">
                            <div class="grid grid-cols-12 intro-y box p-5 mt-12 sm:mt-5 h-full">
                            <div class="col-span-12 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Volumen Ventas  EP </h2>
                            </div>
                        </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">

                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Categorias Vs Regiones </h2>
                            </div>
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

<div class="grid grid-cols-12 gap-2 mt-4  mb-4">
    <select class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 xl:col-span-3"
        aria-label=".form-select-lg example">
        <option>Año</option>
        @if(count($data['ventas_2_ano']) > 0)
            @foreach($data['ventas_2_ano'] as $key => $value)

                <option @if($data['ventas_2_ano_selected'] == $value->ano) selected @endif value="{{$value->ano}}">{{$value->ano}}</option>
            @endforeach
            @endif
    </select>
</div>
<div class="overflow-x-auto">
    <table class="table table-report mt-4 col-span-12" id="table-total-regiones" style="width:100% !important">
        <thead>
            <tr>
              
                <th class="text-center whitespace-nowrap">Departamento/Región</th>
                <th class="text-center whitespace-nowrap">Categoria</th>
                <th class="text-center whitespace-nowrap">Marca</th>
                
                <th class="text-center whitespace-nowrap">Volumen (Ton)</th>
                <th class="text-center whitespace-nowrap">Valor</th>
            </tr>
        </thead>
        <tbody>
    
        @if(count($data['ventas_2']) > 0)
    @foreach($data['ventas_2'] as $key => $value)
    <tr data-color="{{$value->color}}" data-region="{{$value->region}}" class="intro-x">
    <td class="text-center">{{$value->region}}</td>
    <td class="text-center">{{$value->categoria}}</td>
    <td class="text-center">{{$value->marca}}</td>
    <td class="text-center">{{number_format($value->ventas_netas_toneladas,"2",",",".")}}</td>
    <td class="text-center">{{number_format($value->ventas_netas,"2",",",".")}}</td>
    </tr>
    @endforeach
    @endif
           
          
          
           
    
    
    
        </tbody>
    </table>
</div>

</div>

                        
                        
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="intro-y block sm:flex items-center justify-center">

                            <img src="https://sim-ep.com/storage/uploads/{{ $data['pais']->mapa }}" alt="">
                                   
                            </div>
                        </div>
              
                </div>
            </div>
          

            </div>

       
            </div>

                </div>

            </div>
            
            <!-- END: Sales Report -->
            <!-- BEGIN: Weekly Top Seller -->




            <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:block items-center h-10 w-full">
                    <h2 class="text-3xl font-bold truncate mr-5 w-full">Historico</h2>
                    <h2 class="text-sm font-light truncate mr-5 w-full mt-2">Ventas $/Kg</h2>
                </div>
            </div>

            
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-12 md:col-span-12 ">
                        <div class="col-span-12 lg:col-span-12 ">

                            <div class="intro-y block sm:block items-center h-10 w-full">
                                <h2 class="text-lg font-medium truncate mr-5 w-full">Historico </h2>
                                <h2 class="text-sm font-light truncate mr-5 w-full mt-2">Volumen</h2>
                            </div>

                        </div>

                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                                <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
                                    <select id="categoria-list-ventas-4" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-3"
                                        aria-label=".form-select-lg example">
                                            <option>Categoria</option>
                                            @if(count($data['ventas_4_categoria']) > 0)
                                                    @foreach($data['ventas_4_categoria'] as $key => $value)

                                                        <option  @if($data['ventas_4_categoria_selected'] == $value->categoria) selected @endif value="{{$value->categoria}}">{{$value->categoria}}</option>
                                                    @endforeach
                                            @endif
                                    </select>

                                    <select id="periodo-list-ventas-4" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option>Periodo</option>
                                        @if(count($data['ventas_4_periodo']) > 0)
                                            @foreach($data['ventas_4_periodo'] as $key => $value)

                                                <option @if($data['ventas_4_periodo_selected'] == $value->periodo) selected @endif value="{{$value->periodo}}">{{$value->periodo}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                           
                            
                     
                            </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[275px]">
                            <canvas id="historico-1" class="mt-6 -mb-6"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                <div class="col-span-12 md:col-span-12 ">
                        <div class="col-span-12 lg:col-span-12 ">

                            <div class="intro-y block sm:block items-center h-10 w-full">
                                <h2 class="text-lg font-medium truncate mr-5 w-full">Historico </h2>
                                <h2 class="text-sm font-light truncate mr-5 w-full mt-2">$/Kg</h2>
                            </div>

                        </div>

                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                                <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
                                    <select id="categoria-list-ventas-4" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-3"
                                        aria-label=".form-select-lg example">
                                            <option>Categoria</option>
                                            @if(count($data['ventas_5_categoria']) > 0)
                                                    @foreach($data['ventas_5_categoria'] as $key => $value)

                                                        <option  @if($data['ventas_5_categoria_selected'] == $value->categoria) selected @endif value="{{$value->categoria}}">{{$value->categoria}}</option>
                                                    @endforeach
                                            @endif
                                    </select>

                                    <select id="periodo-list-ventas-4" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option>Periodo</option>
                                        @if(count($data['ventas_5_periodo']) > 0)
                                            @foreach($data['ventas_5_periodo'] as $key => $value)

                                                <option @if($data['ventas_5_periodo_selected'] == $value->periodo) selected @endif value="{{$value->periodo}}">{{$value->periodo}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                           
                            
                     
                            </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                    <div class="h-[275px]">
                            <canvas id="historico-2" class="mt-6 -mb-6"></canvas>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:block items-center h-10 w-full">
                    <h2 class="text-3xl font-bold truncate mr-5 w-full">Historico Ventas EP</h2>
                    <h2 class="text-sm font-light truncate mr-5 w-full mt-2" >Ventas $/Kg</h2>
                </div>
            </div>




            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-6 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:block items-center h-10 w-full">
                                <h2 class="text-lg font-medium truncate mr-5 w-full">Historico</h2>
                                <h2 class="text-sm font-light truncate mr-5 w-full mt-2">Plan Operativo vs Real</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[400px]">
                            <canvas id="historico-3"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-6 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:block items-center h-10 w-full">
                                <h2 class="text-lg font-medium truncate mr-5 w-full">Comparativo HPM </h2>
                                <h2 class="text-sm font-light truncate mr-5 w-full mt-2">Mes vs Año anterior</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[400px]">
                            <canvas id="historico-4"></canvas>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0" ></script>
<script src="https://sim-ep.com/build/assets/jquery-jvectormap-2.0.5.min.js"></script>
<script src="https://sim-ep.com/build/assets/colombia.js"></script>
<script>

if ($("#historico-1").length) {
        let ctx = $("#historico-1")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: @json($data['ventas_4_labels']),
                datasets: [
                    @if(count($data['ventas_4_data']) > 0)
                            @foreach($data['ventas_4_data'] as $key => $value)
                            {
                        label: "{{$value->ano}}",
                        data: @json($data['ventas_4_dataset'][$value->ano]),
                        borderWidth: 2,
                        borderColor: '{{$data['colores2'][$key]}}',
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: 0.4,
                    },

                        @endforeach
                    @endif
                    
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                            },
                            color: "#34495E",
                        },
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 12,
                            },
                            color: "#34495E",
                            callback: function (value, index, values) {
                                return value.toFixed(2);
                            },
                        },
                        grid: {
                            color: "#34495E",
                            borderDash: [1, 1],
                            drawBorder: false,
                        },
                    },
                },
            },
        });
    }
    if ($("#historico-2").length) {
        let ctx = $("#historico-2")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: @json($data['ventas_5_labels']),
                datasets: [
                    @if(count($data['ventas_5_data']) > 0)
                            @foreach($data['ventas_5_data'] as $key => $value)
                            {
                        label: "{{$value->ano}}",
                        data: @json($data['ventas_5_dataset'][$value->ano]),
                        borderWidth: 2,
                        borderColor: '{{$data['colores2'][$key]}}',
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: 0.4,
                    },

                        @endforeach
                    @endif
                    
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                            },
                            color: "#34495E",
                        },
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 12,
                            },
                            color: "#34495E",
                            callback: function (value, index, values) {
                                return "$ " + value.toFixed(2);
                            },
                        },
                        grid: {
                            color: "#34495E",
                            borderDash: [1, 1],
                            drawBorder: false,
                        },
                    },
                },
            },
        });
    }

    if ($("#historico-3").length) {
        let ctx = $("#historico-3")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "bar",
            plugins: [ChartDataLabels],
            data: {
                labels: @json($data['ventas_6_labels']),
                datasets: [
                    {
                        label: "Real",
                        barPercentage: 0.5,
                        barThickness: 25,
                        maxBarThickness: 25,
                        minBarLength: 2,
                        data:  @json($data['ventas_6_dataset']),
                        backgroundColor: "#34495e",
                    },
                    {
                        label: "Plan",
                        barPercentage: 0.5,
                        barThickness: 6,
                        maxBarThickness: 8,
                        minBarLength: 2,
                        data:  @json($data['ventas_6_dataset2']),
                        backgroundColor: "#cbd5e1",
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: "#34495E",
                        },
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: function(value, context) {
                                return Math.round(value) + '%';
                        },
                        font: {
                            weight: 'bold'
                        }
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                            },
                            color: "#34495E",
                        },
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                    },
                    y: {
                        ticks: {
                            font: {
                                size: "12",
                            },
                            color: "#34495E",
                            callback: function (value, index, values) {
                                return "" + value;
                            },
                        },
                        grid: {
                            color: "#34495E",
                            borderDash: [2, 2],
                            drawBorder: false,
                        },
                    },
                },
            },
        });
    }

    if ($("#historico-4").length) {
        let ctx = $("#historico-4")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: @json($data['ventas_7_labels']),
                datasets: [
                    {
                        label: {{$data['current_year']}},
                        barPercentage: 0.5,
                        barThickness: 25,
                        maxBarThickness: 25,
                        minBarLength: 2,
                        data:  @json($data['ventas_7_dataset']),
                        backgroundColor: "#34495e",
                    },
                    {
                        label: {{$data['last_year']}},
                        barPercentage: 0.5,
                        barThickness: 6,
                        maxBarThickness: 8,
                        minBarLength: 2,
                        data:  @json($data['ventas_7_dataset2']),
                        backgroundColor: "#cbd5e1",
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: "#34495E",
                        },
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                            },
                            color: "#34495E",
                        },
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                    },
                    y: {
                        ticks: {
                            font: {
                                size: "12",
                            },
                            color: "#34495E",
                            callback: function (value, index, values) {
                                return "" + value;
                            },
                        },
                        grid: {
                            color: "#34495E",
                            borderDash: [2, 2],
                            drawBorder: false,
                        },
                    },
                },
            },
        });
    }
    $(document).ready( function () {
        var collapsedGroups = {};
        var top = '';
    var parent = '';
    jQuery.noConflict();
    
    jQuery('#table-total-pais').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    });
    jQuery('#table-margen').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    });

    var table_regiones = jQuery('#table-total-regiones').DataTable({
    pageLength: -1,
    orderFixed: [[0, 'asc'], [1, 'asc']],
    rowGroup: {
            dataSrc: [0, 1],
            startRender: function(rows, group, level) {
                var all;

                if (level === 0) {
                    top = group;
                    all = group;
                    jQuery
                } else {
                    // if parent collapsed, nothing to do
                    if (!!collapsedGroups[top]) {
                        return;
                    }
                    all = top + group;
                }
                var color = "#FFF";
                var collapsed = !!collapsedGroups[all];
              
                rows.nodes().each(function(r) {
                    if(level === 0){
                        var color_ = jQuery(r).attr("data-color");

                        if(color_ != undefined){
                            color = color_
                        }
                        
                       
                    }
                    
                    r.style.display = collapsed ? 'none' : '';
                });

                // Add category name to the <tr>. NOTE: Hardcoded colspan
                return jQuery('<tr/>')
                    .append('<td style="background-color:'+color+'" colspan="8">' + group + '</td>')
                    .attr('data-name', all)
                    .toggleClass('collapsed', collapsed);
            }
        },
        
        columnDefs: [ {
            targets: [ 0, 1 ],
            visible: false
        } ],
        paging: true,
        responsive: true,
        ordering: true,
        orderClasses: false
    });


    $('#table-total-regiones tbody tr.dtrg-start').each(function() {
    var name = jQuery(this).data('name');
    collapsedGroups[name] = !collapsedGroups[name];
    });
    $('#table-total-regiones tbody tr.dtrg-level-0').each(function() {
        jQuery(this).toggleClass('collapsed', 'none');
        var rowsCollapse = jQuery(this).nextUntil('.dtrg-level-0');
        jQuery(rowsCollapse).css("display","none");

        // var name = jQuery(this).data('name');
        // collapsedGroups[name] = collapsedGroups[name];
        
    });

    $('#table-total-regiones tbody tr.dtrg-level-1').each(function() {
        // var rowsCollapse = jQuery(this).nextUntil('.dtrg-level-1');
        // jQuery(rowsCollapse).toggleClass('hidden');
    
    });
    $('#table-total-regiones tbody').on('click', 'tr.dtrg-start', function() {
        var name = jQuery(this).data('name');

        collapsedGroups[name] = !collapsedGroups[name];
        table_regiones.draw(false);
    });
   

} );

</script>
@endsection