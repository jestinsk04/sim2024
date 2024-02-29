@extends('../layout/' . $layout)

@section('subhead')
<title>Dashboard - Demografico - Usuario - SIMEP</title>
<style>
    #nse-chart{
        height:400px;
    }
    .highcharts-figure,
.highcharts-data-table table {
    min-width: 260px;
    max-width: 100%;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 100%;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
</style>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 md:col-span-3 mt-8">
                <div class="grid grid-cols-1 gap-6 mt-5 md:grid-cols-1">
                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class="p-5">

                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Población Total">Población Total</div>
                                    <div class="ml-auto">
                                        
                                    @if(isset($data['data']["poblacion_total_variacion"]))
                                                @if($data['data']["poblacion_total_variacion"] != "")

                                                    @if($data['data']["poblacion_total_variacion"]>=0)
                                                    <div class="report-box__indicator bg-success cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["poblacion_total_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @elseif($data['data']["poblacion_total_variacion"] < 0)
                                                    <div class="report-box__indicator bg-danger cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["poblacion_total_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @else


                                                    @endif

                                                @endif
                                            @endif
                                    </div>
                                </div>

                       
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6">{{$data['data']["poblacion_total"]}}</div>

                                <div class="">
                                    <div class="">
                                    <div class="report-box__indicator report-text-success  cursor-pointer">
                                        
                                        <div class="truncate">{{$data['data']["poblacion_total_fuente"]}}</div>
                                    </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Migración Venezolana">Migración Venezolana</div>
                                    <div class="ml-auto">
                                    @if(isset($data['data']["diaspora_variacion"]))
                                                @if($data['data']["diaspora_variacion"] != "")

                                                    @if($data['data']["diaspora_variacion"]>=0)
                                                    <div class="report-box__indicator bg-success cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["diaspora_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @elseif($data['data']["diaspora_variacion"] < 0)
                                                    <div class="report-box__indicator bg-danger cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["diaspora_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @else


                                                    @endif

                                                @endif
                                            @endif
                                    </div>
                                </div>

                         
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6">{{$data['data']["diaspora"]}}</div>

                                <div class="">
                                    <div class="">
                                    <div class="report-box__indicator report-text-success  cursor-pointer">
                                        
                                        <div class="truncate">{{$data['data']["diaspora_fuente"]}}</div>
                                    </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Total Hogares">Total Hogares</div>
                                    <div class="ml-auto">
                                    @if(isset($data['data']["hogares_variacion"]))
                                                @if($data['data']["hogares_variacion"] != "")

                                                    @if($data['data']["hogares_variacion"]>=0)
                                                    <div class="report-box__indicator bg-success cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["hogares_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @elseif($data['data']["hogares_variacion"] < 0)
                                                    <div class="report-box__indicator bg-danger cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["hogares_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @else


                                                    @endif

                                                @endif
                                            @endif
                                    </div>
                                </div>
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6">{{$data['data']["hogares"]}}</div>

                                <div class="">
                                    <div class="">
                                    <div class="report-box__indicator report-text-success  cursor-pointer">
                                        
                                        <div class="truncate">{{$data['data']["hogares_fuente"]}}</div>
                                    </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Personas por hogar">Personas por hogar</div>
                                    <div class="ml-auto">
                                    @if(isset($data['data']["personas_hogar_variacion"]))
                                                @if($data['data']["personas_hogar_variacion"] != "")

                                                    @if($data['data']["personas_hogar_variacion"]>=0)
                                                    <div class="report-box__indicator bg-success cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["personas_hogar_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @elseif($data['data']["personas_hogar_variacion"] < 0)
                                                    <div class="report-box__indicator bg-danger cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["personas_hogar_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @else


                                                    @endif

                                                @endif
                                            @endif
                                    </div>
                                </div>
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6">{{$data['data']["personas_hogar"]}}</div>

                                <div class="">
                                    <div class="">
                                    <div class="report-box__indicator report-text-success  cursor-pointer">
                                        
                                        <div class="truncate">{{$data['data']["personas_hogar_fuente"]}}</div>
                                    </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>



                </div>
            </div>


            <!-- END: Sales Report -->



            <div class="col-span-12 sm:col-span-9 lg:col-span-9 mt-8">


                <div class="grid grid-cols-12 gap-6">

                    <div class=" col-span-12 sm:col-span-6">
                        <div class="intro-y box p-5 mt-5 h-full">

                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Poblacion por area</h2>
                            </div>
                            
                                    <table id="table-poblacion-por-area">
                                    <thead>
                                <tr>
                                    <th scope="col"></th>

                                </tr>
                            </thead>
                            <tbody>

                            
                                    @if(count($data['demografico2_data']) > 0)
                                @foreach($data['demografico2_data'] as $key => $value)
                                
                                            <tr>
                                                <td>
                                                <div class="grid grid-cols-12 gap-6 items-center">
                

                <?php 

    
                    $porcentaje = $value->dato_2*100;
                ?>
        <div class="col-span-3 sm:col-span-3 text-xs">
            {{$value->name}}
        </div>
        <div class="col-span-6 sm:col-span-6">
        <div class="progress">
            <div class="progress-bar" style="width:{{$porcentaje}}%;" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
        
        </div>
        <div class="col-span-3 sm:col-span-3 text-xs">
        {{number_format($value->dato,"0",",",".")}}
        </div>
          
    </div>
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                        @endif 

                                        </tbody>
                                        </table>
                           
                         
                        </div>
                    </div>


                    <div class=" col-span-12 sm:col-span-6">

                        <div class="intro-y box p-5 mt-5 h-full">

                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Hogares por numero de personas</h2>
                            </div>

                            <div class="h-[400px]">
                                <canvas id="hogares-por-numero-de-personas"></canvas>
                            </div>


                        </div>



                    </div>

                                        <div class=" col-span-12 sm:col-span-6">

                                            <div class="intro-y box p-5 mt-5 h-full">

                                                <div class="intro-y block sm:flex items-center h-10">
                                                    <h2 class="text-lg font-medium truncate mr-5">Poblacion Migrante</h2>
                                                </div>

                                                <div class="h-[400px]">
                                                    <canvas id="poblacion-migrante"></canvas>
                                                </div>


                                            </div>



                                        </div>

                                        <div class=" col-span-12 sm:col-span-6">

                                            <div class="intro-y box p-5 mt-5 h-full">

                                                <div class="intro-y block sm:flex items-center h-10">
                                                    <h2 class="text-lg font-medium truncate mr-5">N.S.E
                                                    </h2>
                                                </div>

                                                <div class="h-[400px]">
                                                <figure class="highcharts-figure">
                                                    <div id="nse-chart"></div>

                                                </figure>
                                                </div>


                                            </div>



                                        </div>


                </div>



            </div>
            <!-- END: Weekly Top Seller -->


            <div class="col-span-12 sm:col-span-12 lg:col-span-12 mt-8">

                <div class="grid grid-cols-12 intro-y box p-5 mt-5 ">

                    <div class="col-span-12 intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Pirámide poblacional</h2>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">{{$data['demografico5_ano']}}</h2>
                    </div>
                        <canvas id="pyramid-chart-3"></canvas>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">{{$data['demografico5_ano']}}</h2>
                    </div>
                    
                        <canvas id="pyramid-chart-2"></canvas>
                    </div>



                </div>



            </div>

            <div class="col-span-12 sm:col-span-12 lg:col-span-12 mt-8">

                <div class="intro-y box p-5 mt-5 w-3/5 mx-auto">

                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Distribución del gasto por hogar</h2>
                    </div>
                    <div class="h-[400px]">
                                <canvas id="gastos-por-hogar"></canvas>
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


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/funnel.js"></script>


<script>
$( document ).ready(function() {
if ($("#pyramid-chart-2").length) {

    let ctx = $("#pyramid-chart-2")[0].getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: @json($data['demografico5_labels']),
            datasets: [
              {
                label: "Hombres",
                stack: "Stack 0",
                backgroundColor: "#F03327",
                data: @json($data['demografico5_dataset_hombres']),
              },
              {
                label: "Mujeres",
                stack: "Stack 0",
                backgroundColor: "#2778F0",
                data: @json($data['demografico5_dataset_mujeres']).map((k) => -k),
              },
            ],


        },
        options: {
          indexAxis: 'y',
          title: {
            display: true,
            text: "Piramide poblacional",
          },
          elements: {
            bar: {
              borderWidth: 2,
            }
          },
          tooltips: {
            intersect: false,
            callbacks: {
              label: (c) => {
                const value = Number(c.value);
                const positiveOnly = value < 0 ? -value : value;
                let retStr = "";
                if (c.datasetIndex === 0) {
                  retStr += `Hombre: ${positiveOnly.toString()}`;
                } else {
                  retStr += `Mujer: ${positiveOnly.toString()}`;
                }
                return retStr;
              },
            },
          },
          responsive: true,
          legend: {
            position: "bottom",
          },
        },
      });
}
if ($("#pyramid-chart-3").length) {

let ctx = $("#pyramid-chart-3")[0].getContext("2d");
new Chart(ctx, {
    type: "bar",
    data: {
        labels: @json($data['demografico5_labels']),
        datasets: [
          {
            label: "Hombres",
            stack: "Stack 0",
            backgroundColor: "#F03327",
            data: @json($data['demografico5_dataset_hombres']),
          },
          {
            label: "Mujeres",
            stack: "Stack 0",
            backgroundColor: "#2778F0",
            data: @json($data['demografico5_dataset_mujeres']).map((k) => -k),
          },
        ],


    },
    options: {
      indexAxis: 'y',
      title: {
        display: true,
        text: "Piramide poblacional",
      },
      elements: {
        bar: {
          borderWidth: 2,
        }
      },
      tooltips: {
        intersect: false,
        callbacks: {
          label: (c) => {
            const value = Number(c.value);
            const positiveOnly = value < 0 ? -value : value;
            let retStr = "";
            if (c.datasetIndex === 0) {
              retStr += `Hombre: ${positiveOnly.toString()}`;
            } else {
              retStr += `Mujer: ${positiveOnly.toString()}`;
            }
            return retStr;
          },
        },
      },
      responsive: true,
      legend: {
        position: "bottom",
      },
    },
  });
}
});
if ($("#hogares-por-numero-de-personas").length) {
        let ctx = $("#hogares-por-numero-de-personas")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "bar",
            plugins: [ChartDataLabels],
            data: {
                labels:  @json($data['demografico3_labels']),
                datasets: [
                    {
                        barPercentage: 0.5,
                        barThickness: 25,
                        maxBarThickness: 25,
                        minBarLength: 2,
                        data: @json($data['demografico3_dataset']),
                        backgroundColor: @json($data['demografico3_colors']),
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display:false,
                        labels: {
                            color: '#35495e',
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
                            color: '#35495e',
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
                            color: '#35495e',
                            callback: function (value, index, values) {
                                return value + "%";
                            },
                        },
                        grid: {
                            color: '#35495e',
                            borderDash: [2, 2],
                            drawBorder: false,
                        },
                    },
                },
            },
        });
    }
    if ($("#poblacion-migrante").length) {
        let ctx = $("#poblacion-migrante")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "bar",
            plugins: [ChartDataLabels],
            data: {
                labels:  @json($data['demografico7_labels']),
                datasets: [
                    {
                        barPercentage: 0.5,
                        barThickness: 25,
                        maxBarThickness: 25,
                        minBarLength: 2,
                        data: @json($data['demografico7_dataset']),
                        backgroundColor: @json($data['demografico7_colors']),
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display:false,
                        labels: {
                            color: '#35495e',
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
                            color: '#35495e',
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
                            color: '#35495e',
                            callback: function (value, index, values) {
                                return value + "%";
                            },
                        },
                        grid: {
                            color: '#35495e',
                            borderDash: [2, 2],
                            drawBorder: false,
                        },
                    },
                },
            },
        });
    }
    if ($("#gastos-por-hogar").length) {
        let ctx = $("#gastos-por-hogar")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "bar",
            plugins: [ChartDataLabels],
            data: {
                labels:  @json($data['demografico6_labels']),
                datasets: [
                    {
                        barPercentage: 0.5,
                        barThickness: 25,
                        maxBarThickness: 25,
                        minBarLength: 2,
                        data: @json($data['demografico6_dataset']),
                        backgroundColor: @json($data['demografico6_colors']),
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display:false,
                        labels: {
                            color: '#35495e',
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
                    tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';

                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed.y !== null) {
                            label += context.parsed.y + "%";
                        }
                        return label;
                    }
                }
            },
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                            },
                            color: '#35495e',
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
                            color: '#35495e',
                            callback: function (value, index, values) {
                                return value + "%";
                            },
                        },
                        grid: {
                            color: '#35495e',
                            borderDash: [2, 2],
                            drawBorder: false,
                        },
                    },
                },
            },
        });
    }
    if ($("#nse-chart").length) {
 Highcharts.chart('nse-chart', {
    chart: {
        type: 'funnel'
    },
    title: {
        text: ''
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b> ({point.y:,.0f})',
                softConnector: true
            },
            center: ['40%', '50%'],
            neckWidth: '30%',
            neckHeight: '25%',
            width: '80%'
        }
    },
    legend: {
        enabled: false
    },
    series: [{
        name: 'Estratos',
        data: [
            ['Estrato 1', 15654],
            ['Estrato 2', 4064],
            ['Estrato 3', 1987],
            ['Estrato 4', 976],
            ['Estrato 5', 846]
        ]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                plotOptions: {
                    series: {
                        dataLabels: {
                            inside: true
                        },
                        center: ['50%', '50%'],
                        width: '100%'
                    }
                }
            }
        }]
    }
});
    }

    


    $(document).ready( function () {
    jQuery.noConflict();
    jQuery('#table-poblacion-por-area').DataTable({
        "searching": false,
        "ordering": false,
        "lengthChange": false,
    });

} );
</script>
@endsection