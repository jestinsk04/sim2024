@extends('../layout/' . $layout)

@section('subhead')
<title>Dashboard - Usuario - SIMEP</title>
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
                            <h2 class="text-lg font-medium truncate mr-5">Deficit Fiscal</h2>
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
                            <h2 class="text-lg font-medium truncate mr-5">Reservas Inter</h2>
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
                            <h2 class="text-lg font-medium truncate mr-5">Tasa de Interes</h2>
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
                            <h2 class="text-lg font-medium truncate mr-5">TRM</h2>
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

                                <table class="table mt-4 col-span-12">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Categoría</th>
                                <th class="whitespace-nowrap">Volumen</th>
                                <th class=" whitespace-nowrap">Ventas</th>
                                <th class=" whitespace-nowrap">Margen</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            @if(count($data["ventas_2"]) > 0)
                                @foreach($data["ventas_2"] as $value)


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
          
            <!-- END: Sales Report -->
            <!-- BEGIN: Weekly Top Seller -->

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

                            <ul>
                            @if(count($data["ventas_3"]) > 0)
                                @foreach($data["ventas_3"] as $value)

                                    <li class="mt-4">{{$value->name}} <span class="float-right">{{$value->valor*100}}%</span></li>

                                @endforeach
                            @endif
                            </ul>
                        
                    </div>
                     <div class="col-span-12 md:col-span-6">

                            <div class="intro-y block sm:flex items-center justify-center">
                                <img class="" style="height:400px" src="https://sim-ep.com/storage/uploads/mapa_colombia.png" alt="">
                            </div>
                        
                    </div>
              
                </div>
            </div>


            <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:block items-center h-10 w-full">
                    <h2 class="text-3xl font-bold truncate mr-5 w-full">Historico</h2>
                    <h2 class="text-sm font-light truncate mr-5 w-full mt-2">Ventas $/Kg</h2>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-6 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:block items-center h-10 w-full">
                                <h2 class="text-lg font-medium truncate mr-5 w-full">Historico</h2>
                                <h2 class="text-sm font-light truncate mr-5 w-full mt-2">Volumen</h2>
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
                    <div class="col-span-6 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:block items-center h-10 w-full">
                            <h2 class="text-lg font-medium truncate mr-5 w-full">Historico</h2>
                                <h2 class="text-sm font-light truncate mr-5 w-full mt-2">$ /Kg</h2>
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
                        borderColor: '{{$data['colores'][$key]}}',
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
                        borderColor: '{{$data['colores'][$key]}}',
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

</script>
@endsection