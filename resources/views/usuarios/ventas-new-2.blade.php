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
                    <h2 class="text-xl font-bold truncate mr-5 w-full title-section">Mercado Local</h2>

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
           
            <!-- <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-3xl font-bold xl:truncate mr-5">Datos Socio - Económicos</h2>
                </div>
            </div> -->

            <div class="col-span-12 sm:col-span-4 xl:col-span-3 mt-8 grid grid-cols-1">
                    <div class="intro-y mt-12 sm:mt-5">
                        <div class="report-box box zoom-in">
                            <div class="p-5">

                                <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Consumo H.P.M">Consumo H.P.M</div>
                                    
                                </div>        
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']["consumo_hpm"]}} KG/HAB </div>

                    
                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["consumo_hpm_fuente"] ?: ""}}">
                                            <div class="truncate">{{$data['data']["consumo_hpm_fuente"] ?: ""}}</div>
                                            
                                        </div>
                                    </div>
                                </div>
                                   
                                        
                          

                            </div>
                        </div>
                    </div>


                    <div class="intro-y mt-12 sm:mt-5">
                        <div class="report-box box zoom-in">
                            <div class="p-5">

                                <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Share Volumen">Share Volumen</div>
                                    
                                </div>        
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']["share_volumen"]}}%  </div>

                    
                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["share_volumen_fuente"] ?: ""}}">
                                            <div class="truncate">{{$data['data']["share_volumen_fuente"] ?: ""}}</div>
                                            
                                        </div>
                                    </div>
                                </div>
                                   
                                        
                          

                            </div>
                        </div>
                    </div>

                    <div class="intro-y mt-12 sm:mt-5">
                        <div class="report-box box zoom-in ">
                            <div class="p-5">

                                <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Share Valor">Share Valor</div>
                                    
                                </div>        
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']["share_valor"]}}% </div>

                    
                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["share_valor_fuente"] ?: ""}}">
                                            <div class="truncate">{{$data['data']["share_valor_fuente"] ?: ""}}</div>
                                            
                                        </div>
                                    </div>
                                </div>
                                   
                                        
                          

                            </div>
                        </div>
                    </div>


        


   


            </div>
 
            
            <div class="col-span-12 xl:col-span-9 mt-8">
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
                                    <select id="filter-marca-1" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-6 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                            <option value="">Categoria</option>
                                            @if(count($data['ventas_4_categoria']) > 0)
                                                    @foreach($data['ventas_4_categoria'] as $key => $value)

                                                        <option  @if($data['ventas_4_categoria_selected'] == $value->categoria) selected @endif value="{{$value->categoria}}">{{$value->categoria}}</option>
                                                    @endforeach
                                            @endif
                                    </select>

                                    <select id="filter-periodo-2" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-6 xl:col-span-3"
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
                                    <select id="filter-marca-2" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-6 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                            <option value="">Categoria</option>
                                            @if(count($data['ventas_5_categoria']) > 0)
                                                    @foreach($data['ventas_5_categoria'] as $key => $value)

                                                        <option  @if($data['ventas_5_categoria_selected'] == $value->categoria) selected @endif value="{{$value->categoria}}">{{$value->categoria}}</option>
                                                    @endforeach
                                            @endif
                                    </select>

                                    <select id="filter-periodo-3" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-6 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option value="">Periodo</option>
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



            <!-- <div class="col-span-12 lg:col-span-12 mt-8">
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
            </div> -->


            <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:block items-center h-10 w-full">
                    <h2 class="text-3xl font-bold truncate mr-5 w-full">Plan Operativo</h2>
                    <h2 class="text-sm font-light truncate mr-5 w-full mt-2" ></h2>
                </div>
            </div>




            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-6 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:block items-center h-10 w-full">
                                <h2 class="text-lg font-medium truncate mr-5 w-full">Plan Operativo Comparativo</h2>
                                <h2 class="text-sm font-light truncate mr-5 w-full mt-2"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[400px]">
                            <canvas id="operativo-1"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-6 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:block items-center h-10 w-full">
                                <h2 class="text-lg font-medium truncate mr-5 w-full">Avance Mensual</h2>
                                <h2 class="text-sm font-light truncate mr-5 w-full mt-2"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[400px]">
                            <canvas id="operativo-2"></canvas>
                        </div>
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
                                    <select id="filter-periodo-1" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-3 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option value="">Periodo</option>
                                        @if(count($data['ventas_3_periodo']) > 0)
                                            @foreach($data['ventas_3_periodo'] as $key => $value)

                                                <option @if($data['ventas_3_periodo_selected'] == $value->periodo) selected @endif value="{{$value->periodo}}">{{$value->periodo}}</option>
                                            @endforeach
                                            @endif
                                    </select>
                                </div>

                                <table class="table table-report mt-4 col-span-6" id="table-total-pais">
                                    <thead>
                                        <tr>
                                            <th class="text-center whitespace-nowrap">Categoria</th>
                                            <th class="text-center whitespace-nowrap">Volumen (Ton)</th>
                                            <th class="text-center whitespace-nowrap">Valor(COP)</th>
                                            <th class="text-center whitespace-nowrap">$COP/KG</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-total-pais-content">

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
    <select id="filter-year-1" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-3 xl:col-span-3"
        aria-label=".form-select-lg example">
        <option value="">Año</option>
        @if(count($data['ventas_2_ano']) > 0)
            @foreach($data['ventas_2_ano'] as $key => $value)

                <option @if($data['ventas_2_ano_selected'] == $value->ano) selected @endif value="{{$value->ano}}">{{$value->ano}}</option>
            @endforeach
            @endif
    </select>
</div>

            <div id="faq-accordion-2" class="accordion accordion-boxed mt-8" id="regiones-content">
                   
                        @if(count($data['ventas_2_regiones_data']) > 0)
                        @foreach($data['ventas_2_regiones_data'] as $key => $value)

                      


                        
                        <div class="accordion-item" style="padding: 0px;min-height: 54px;">
                            <div id="faq-accordion-content-{{ $key }}" data-color="{{$data['ventas_2_regiones_data'][$key]['color']}}" class="accordion-header">
                                <button style="background-color:{{$data['ventas_2_regiones_data'][$key]['color']}};padding: 1rem;" class="accordion-button collapsed" type="button" data-tw-toggle="collapse"
                                    data-tw-target="#faq-accordion-collapse-{{ $key }}" aria-expanded="false"
                                    aria-controls="faq-accordion-collapse-{{ $key }}">
                                    {{ $key }}
                                </button>
                            </div>
                            <div id="faq-accordion-collapse-{{ $key }}" class="accordion-collapse collapse"
                                aria-labelledby="faq-accordion-content-{{ $key }}" data-tw-parent="#faq-accordion-2">
                                <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">

                                        <div id="faq-accordion-{{ $key }}" class="accordion accordion-boxed">



                                        
                                @if(is_array($value))
                                    @if(count($value) > 0)
                                        @foreach($value as $key2 => $value2)
                                        @if($key2 != 'color')

                                        


                                        <div class="accordion-item">
                            <div id="inside-accordion-content-{{ $key2 }}" class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse"
                                    data-tw-target="#inside-accordion-collapse-{{ $key2 }}" aria-expanded="false"
                                    aria-controls="inside-accordion-collapse-{{ $key2 }}">
                                    {{ $key2 }}
                                </button>
                            </div>
                            <div id="inside-accordion-collapse-{{ $key2 }}" class="accordion-collapse collapse"
                                aria-labelledby="inside-accordion-content-{{ $key2 }}">
                                <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
<table class="table table-report mt-4 col-span-12 tabla-regiones" id="table-total-regiones" style="width:100% !important">
    <thead>
        <tr>

            <th class="text-center whitespace-nowrap">Marca</th>

            <th class="text-center whitespace-nowrap">Volumen (Ton)</th>
            <th class="text-center whitespace-nowrap">Valor</th>
        </tr>
    </thead>
    <tbody>

        @if(count($value2) > 0)
            @foreach($value2 as $key3 => $value3)
                <tr class="intro-x">
                  
                    <td class="text-center">{{ $value3->marca }}</td>
                    <td class="text-center">
                        {{ number_format($value3->toneladas_netas,"2",",",".") }}
                    </td>
                    <td class="text-center">
                        {{ number_format($value3->total_ventas,"2",",",".") }}
                    </td>
                </tr>
            @endforeach
        @endif







    </tbody>
</table>



                                       
                                    

                               
                                </div>
                            </div>
                        </div>

                              

                        @endif
                                        @endforeach

                                    @endif

                                    @endif



                                    </div>
                                    

                               
                                </div>
                            </div>
                        </div>

                       
                        @endforeach
                        @endif

            
               
                </div>

</div>

                        
                        
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="intro-y block sm:flex items-center justify-center">

                            <img style="max-width:70%;" src="https://sim-ep.com/storage/uploads/{{ $data['pais']->mapa }}" alt="">
                                   
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

            




                   
            <!-- <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-3xl font-bold truncate mr-5">Información General</h2>
                </div>
            </div> -->

   
            <!-- <div class="col-span-12 sm:col-span-8 xl:col-span-9 mt-8">
                <div class="grid grid-cols-1 sm:grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-6 flex flex-col md:flex-row">
                        <div class="flex">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Precios Histórico H.P.M</h2>
                            </div>
                        </div>
                        <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500  h-10">
                            <i data-lucide="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                            <input type="text" class="datepicker form-control sm:w-64 box pl-10">
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-2 report-chart ">
                        <div class="h-[275px]">
                            <canvas id="precios-historicos" class="mt-6 -mb-6"></canvas>
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-3">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Variación H.P.M mes anterior</h2>
                        </div>


                        @if(count($data['kpi2_data']) > 0)
                            @foreach($data['kpi2_data'] as $key => $value)
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">{{$value->name}}</h2>
                            <div class="progress my-auto w-8">

                            <div class="progress-bar" style="background-color:{{$data['colores'][$key]}} !important" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        </div>
                            @endforeach
                        @endif

                    
                    </div>
                </div>
            </div> -->
     
            <!-- END: Sales Report -->
            <!-- BEGIN: Weekly Top Seller -->

            <!-- <div class="col-span-12 sm:col-span-6 lg:col-span-6 mt-8">

                <div class="intro-y box p-5 mt-5">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Avance Plan Operativo H.P.M</h2>
                    </div>
                    <div class="mt-3">
                        <div class="absolute top-4 left-4">Local</div>
                        <div class="h-[213px] border-b border-gray-50">
                            <canvas id="plan-operativo-local"></canvas>
                        </div>
                        <div class="grid grid-cols-12 gap-6 items-center">
                                <div class="col-span-6 sm:col-span-6">0%</div>
                                <div class="col-span-6 sm:col-span-6 text-right">100%</div>
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
                    <div class="absolute top-4 left-4">Exportaciones</div>
                        <div class="h-[213px] border-b border-gray-50">
                            <canvas id="plan-operativo-export"></canvas>
                        </div>
                        <div class="grid grid-cols-12 gap-6 items-center">
                                <div class="col-span-6 sm:col-span-6">0%</div>
                                <div class="col-span-6 sm:col-span-6 text-right">100%</div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="col-span-12 sm:col-span-12 lg:col-span-12 mt-8">
               

                <div class="intro-y box p-5 mt-5">

                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Exportaciones H.P.M Principales destinos</h2>
                </div>
                <div class="grid grid-cols-12 gap-2 mt-4  mb-4">

                            <select id="filter-periodo-hpm" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-3 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option value="">Periodo</option>
                                        @if(count($data['ventas_exportaciones_filtro']) > 0)
                                            @foreach($data['ventas_exportaciones_filtro'] as $key => $value)

                                                <option @if($data['current_periodo_hpm'] == $value->periodo) selected @endif value="{{$value->periodo}}">{{$value->periodo}}</option>
                                            @endforeach
                                            @endif
                            </select>
                 </div>
                 <div id="body-hpm">
                 @if(count($data['ventas_exportaciones']) > 0)
                            @foreach($data['ventas_exportaciones'] as $key => $value)
                <div class="grid grid-cols-12 gap-6 items-center mt-12">
                

                            <?php 

                                $total = $data["ventas_exportaciones_total"];
                                $actual = $value->kilos;

                                $porcentaje = ($actual*100)/$total;
                            ?>
                    <div class="col-span-3 sm:col-span-4">
                        {{$value->codigo_material}}<br>
                        {{$value->descripcion}}<br>
                        {{number_format($value->kilos,"2",",",".")}} Kilos
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                    <div class="progress">
                        <div class="progress-bar" style="width:{{$porcentaje}}%;" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    
                    </div>
                    <div class="col-span-3 sm:col-span-4">
                     {{$value->pais_destino}}
                    </div>
                      
                </div>
                @endforeach
                 @endif 
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
        var ctx = $("#historico-1")[0].getContext("2d");
        var myChart = new Chart(ctx, {
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
        var ctx2 = $("#historico-2")[0].getContext("2d");
        var myChart2 = new Chart(ctx2, {
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
        var ctx3 = $("#historico-3")[0].getContext("2d");
        var myChart3 = new Chart(ctx3, {
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
        var ctx4 = $("#historico-4")[0].getContext("2d");
        var myChart4 = new Chart(ctx4, {
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
    jQuery.noConflict();
    
    jQuery('#table-total-pais').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });
    jQuery('#table-margen').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });

} );

$(document).on("change", "#filter-periodo-1", function () {

jQuery.noConflict();
console.log("Cambio Marca")
var marca = jQuery(this).val();
if(marca != ""){

    let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-ventas') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   periodo: marca,
                   tipo: 1
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var element = "";
                   jQuery.each(response, function(i, item) {
                           console.log(response[i].id);
                          element += '<tr class="intro-x">'+
                               '<td class="text-center">'+response[i].categoria+'</td>'+
                               '<td class="text-center">'+response[i].volumen+'</td>'+
                               '<td class="text-center">'+response[i].valor+'</td>'+
                               '<td class="text-center">'+response[i].valor_2+'</td>'+
                          ' </tr>';
                   });
                 

                   jQuery("#table-total-pais-content").html(element, function(){
                                   jQuery('#table-total-pais').DataTable({
                                   "aaSorting": [[ 1, "asc" ]],
                                   "pageLength": 25
                                   });

                   });


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });



}



});
$(document).on("change", "#filter-year-1", function () {

jQuery.noConflict();
console.log("Cambio Marca")
var marca = jQuery(this).val();
if(marca != ""){

    location.href = "https://sim-ep.com/usuario/ventas?filter-year-1="+marca;

}



});


$(document).on("change", "#filter-periodo-2, #filter-marca-1", function () {

jQuery.noConflict();
console.log("Cambio Año")
var periodo = jQuery("#filter-periodo-2").val();
var marca = jQuery("#filter-marca-1").val();



let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-ventas') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   tipo: 3,
                   periodo: periodo,
                   marca: marca,
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var data_set = [];
                   var data_set_label = [];
                   var data_set_data = [];
               
                   jQuery.each(response.ventas_4_data, function(i, item) {


                        var temo_data = '{'+
                        'label: "'+item.ano+'",'+
                        'data: ['+response.ventas_4_dataset[item.ano]+'],'+
                        'borderWidth: 2,'+
                        'borderColor: "{{$data['colores2'][0]}}",'+
                        'backgroundColor: "transparent",'+
                        'pointBorderColor: "transparent",'+
                        'tension: 0.4'+
                        '},';

                        data_set.push(temo_data);
                        data_set_label.push(item.ano);
                        data_set_data.push(response.ventas_4_dataset[item.ano]);
                        });


                   
                      
                   if (jQuery("#historico-1").length) {

                 

                    myChart.data.labels = response.ventas_4_labels;
                    var cnt = 0;
                    myChart.data.datasets.forEach((dataset) => {
                        dataset.data = data_set_data[cnt];
                        dataset.label = data_set_label[cnt];

                        cnt++;
                    });
                    

                    myChart.update();

               

                    }

          

           


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });

//location.href = "https://sim-ep.com/usuario/ventas?filter-periodo-2="+periodo+"&filter-marca-1="+marca;





});
$(document).on("change", "#filter-periodo-3, #filter-marca-2", function () {

jQuery.noConflict();
console.log("Cambio Año")
var periodo = jQuery("#filter-periodo-3").val();
var marca = jQuery("#filter-marca-2").val();



let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-ventas') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   tipo: 4,
                   periodo: periodo,
                   marca: marca,
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var data_set = [];
                   var data_set_label = [];
                   var data_set_data = [];
               
                   jQuery.each(response.ventas_5_data, function(i, item) {


                        var temo_data = '{'+
                        'label: "'+item.ano+'",'+
                        'data: ['+response.ventas_5_dataset[item.ano]+'],'+
                        'borderWidth: 2,'+
                        'borderColor: "{{$data['colores2'][0]}}",'+
                        'backgroundColor: "transparent",'+
                        'pointBorderColor: "transparent",'+
                        'tension: 0.4'+
                        '},';

                        data_set.push(temo_data);
                        data_set_label.push(item.ano);
                        data_set_data.push(response.ventas_5_dataset[item.ano]);
                        });


                   console.log(data_set)
                      
                   if (jQuery("#historico-2").length) {

                 

                    myChart2.data.labels = response.ventas_5_labels;
                    var cnt = 0;
                    myChart2.data.datasets.forEach((dataset) => {
                        dataset.data = data_set_data[cnt];
                        dataset.label = data_set_label[cnt];

                        cnt++;
                    });
                    

                    myChart2.update();

               

                    }

          

           


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });








});


if ($("#precios-historicos").length) {
        let ctx = $("#precios-historicos")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: @json($data['kpi2_labels']),
                datasets: [
                    @if(count($data['kpi2_data']) > 0)
                            @foreach($data['kpi2_data'] as $key => $value)
                            {
                        label: "{{$value->name}}",
                        data: @json($data['kpi2_dataset'][$value->item]),
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
                        display: false,
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
                                return "COP " + value.toFixed(2);
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

    if ($("#plan-operativo-local").length) {
        let ctx = $("#plan-operativo-local")[0].getContext("2d");
        let myDoughnutChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: [
                    "0%",
                    "100%"
                ],
                datasets: [
                    {
                        data: [{{$data['data']['plan_operativo_local_cumplimiento']}}, {{$data['data']['plan_operativo_local_restante']}}],
                        backgroundColor: [
                            "#D2F154",
                            "#F9F9FF",
                        ],
                        hoverBackgroundColor: [
                            "#D2F154",
                            "#F9F9FF",
                        ],
                        borderWidth: 5
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                circumference: 180,
                rotation: -90,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                cutout: "80%",
            },
        });
    }
    if ($("#plan-operativo-export").length) {
        let ctx = $("#plan-operativo-export")[0].getContext("2d");
        let myDoughnutChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: [
                    "0%",
                    "100%"
                ],
                datasets: [
                    {
                        data: [{{$data['data']['plan_operativo_export_cumplimiento']}}, {{$data['data']['plan_operativo_export_restante']}}],
                        backgroundColor: [
                            "#FB2222",
                            "#F9F9FF",
                        ],
                        hoverBackgroundColor: [
                            "#FB2222",
                            "#F9F9FF",
                        ],
                        borderWidth: 5
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                circumference: 180,
                rotation: -90,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                cutout: "80%",
            },
        });
    }

    $(document).on("change", "#filter-periodo-hpm", function () {

jQuery.noConflict();
console.log("Cambio Año")
var periodo = jQuery("#filter-periodo-hpm").val();


let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-ventas-hpm') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   periodo: periodo
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var elemtens;
               
                   jQuery.each(response.ventas_4_data, function(i, item) {



                        var total = response.total;
                        var actual = item.kilos;
                        var porcentaje = (actual*100)/total;
                        elemtens += '<div class="grid grid-cols-12 gap-6 items-center mt-12">'+
                            '<div class="col-span-3 sm:col-span-4">'+
                            +item.codigo_material+
                            +item.descripcion+
                            +item.kilos+' Kilos'+
                            '</div>'+
                        '<div class="col-span-6 sm:col-span-4">'+
                            '<div class="progress">'
                                '<div class="progress-bar" style="width:'+porcentaje+'%;" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>'+
                                '</div>'+
        
                            '</div>'+
                        '<div class="col-span-3 sm:col-span-4">'+
                        +item.pais_destino+
                        '</div>'+
          
                        '</div>';

                    
                        });



                        jQuery("#body-hpm").html(elemtens)
                   
     

          

           


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });

//location.href = "https://sim-ep.com/usuario/ventas?filter-periodo-2="+periodo+"&filter-marca-1="+marca;





});
if ($("#operativo-1").length) {
        let ctx = $("#operativo-1")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "bar",
            plugins: [ChartDataLabels],
            data: {
                labels:  @json($data['labels_demografico6']),
                datasets: [
                    {
                        label:'Real',
                        categoryPercentage: 0.5,
                        barPercentage: 0.5,
                        data: @json($data['dataset_real']),
                        backgroundColor: "#e84030",
                    },
                    {
                        label:'Operativo',
                        categoryPercentage: 0.5,
                        barPercentage: 0.5,
                        data: @json($data['dataset_planificado']),
                        backgroundColor: "#4080f0",
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display:true,
                        labels: {
                            color: '#35495e',
                        },
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: function(value, context) {
                                return jQuery.number(value, 0, ',', '.' );
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
                                return jQuery.number(value, 0, ',', '.' );
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
    if ($("#operativo-2").length) {
        let ctx = $("#operativo-2")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "bar",
            plugins: [ChartDataLabels],
            data: {
                labels:  @json($data['labels_plan_operativo_a']),
                datasets: [
                    {
                        label:'Real',
                        categoryPercentage: 0.5,
                        barPercentage: 0.5,
                        data: @json($data['dataset_plan_operativo_a_real']),
                        backgroundColor: "#e84030",
                    },
                    {
                        label:'Operativo',
                        categoryPercentage: 0.5,
                        barPercentage: 0.5,
                        data: @json($data['dataset__plan_operativo_a_planificado']),
                        backgroundColor: "#4080f0",
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display:true,
                        labels: {
                            color: '#35495e',
                        },
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: function(value, context) {
                                return jQuery.number(value, 0, ',', '.' );
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
                                return jQuery.number(value, 0, ',', '.' );
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
</script>
@endsection