@extends('../layout/' . $layout)

@section('subhead')
<title>Dashboard - Usuario - SIMEP</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
  

           
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-bold truncate mr-5 title-section">Salud País</h2>
                </div>
                <div class="grid grid-cols-2 gap-6 mt-5 md:grid-cols-5">
                    <div class="intro-y mt-8 open-grafico" data-item = "pib_(usd_mm)">
                        <div class="report-box box zoom-in">
                            <div class="p-5">

                                <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="PRODUCTO INTERNO BRUTO">PIB (US$mm)</div>
                                    
                                </div>
                                <!-- <div class="ml-auto">
                                    @if(isset($data['data']["pib_variacion"]))
                                                @if($data['data']["pib_variacion"] != "")

                                                    @if($data['data']["pib_variacion"]>=0)
                                                    <div class="report-box__indicator bg-success cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["pib_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @elseif($data['data']["pib_variacion"] < 0)
                                                    <div class="report-box__indicator bg-danger cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["pib_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @else


                                                    @endif

                                                @endif
                                            @endif
                                    </div> -->
                                
                                             
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']["pib"]}} USD</div>

                    
                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["pib_fuente"]}}">
                                            <div class="truncate">{{$data['data']["pib_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>
                                   
                                        
                          

                            </div>
                        </div>
                    </div>

                    <div class="intro-y mt-8 open-grafico" data-item = "pib_per_capital">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="PIB PER CAPITA">PIB PER CAPITA</div>
                                    
                                </div>
                                <!-- <div class="ml-auto">
                                    @if(isset($data['data']["pib_per_capita_variacion"]))
                                                @if($data['data']["pib_per_capita_variacion"] != "")

                                                    @if($data['data']["pib_per_capita_variacion"]>=0)
                                                    <div class="report-box__indicator bg-success cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["pib_per_capita_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @elseif($data['data']["pib_per_capita_variacion"] < 0)
                                                    <div class="report-box__indicator bg-danger cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["pib_per_capita_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @else


                                                    @endif

                                                @endif
                                            @endif
                                    </div> -->

                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']["pib_per_capita"]}} USD </div>

                              
                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["pib_per_capita_fuente"]}}">
                                            <div class="truncate">{{$data['data']["pib_per_capita_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="intro-y mt-8 open-grafico" data-item = "salario_minimo">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="SALARIO MÍNIMO">SALARIO MÍNIMO</div>
                                    
                                </div>
                                <div class="ml-auto">
                                   
                                    </div>

                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']['salario_minimo']}} {{$data['pais']->simbolo_moneda ?? ""}}</div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["salario_minimo_fuente"]}}">
                                            <div class="truncate">{{$data['data']["salario_minimo_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>

                    <div class="intro-y mt-8 open-grafico" data-item = "inflacion_(usd_mm)">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="INFLACIÓN">INFLACIÓN</div>
                                    
                                </div>

                                <!-- <div class="ml-auto">
                                    @if(isset($data['data']["inflacion_variacion"]))
                                                @if($data['data']["inflacion_variacion"] != "")

                                                    @if($data['data']["inflacion_variacion"]>=0)
                                                    <div class="report-box__indicator bg-success cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["inflacion_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @elseif($data['data']["inflacion_variacion"] < 0)
                                                    <div class="report-box__indicator bg-danger cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["inflacion_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @else


                                                    @endif

                                                @endif
                                            @endif
                                    </div> -->

                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']['inflacion']}} %</div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["inflacion_fuente"]}}">
                                            <div class="truncate">{{$data['data']["inflacion_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                               

                            </div>
                        </div>
                    </div>

                    <div class="intro-y mt-8 open-grafico" data-item = "indice_big_mac">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="ÍNDICE BIG MAC">ÍNDICE BIG MAC</div>
                                    
                                </div>
                                <!-- <div class="ml-auto">
                                    @if(isset($data['data']["big_mac_variacion"]))
                                                @if($data['data']["big_mac_variacion"] != "")

                                                    @if($data['data']["big_mac_variacion"]>=0)
                                                    <div class="report-box__indicator bg-success cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["big_mac_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @elseif($data['data']["big_mac_variacion"] < 0)
                                                    <div class="report-box__indicator bg-danger cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["big_mac_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @else


                                                    @endif

                                                @endif
                                            @endif
                                    </div> -->
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']['big_mac']}}</div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["big_mac_fuente"]}}">
                                            <div class="truncate">{{$data['data']["big_mac_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                         

                            </div>
                        </div>
                    </div>


                    <div class="intro-y mt-8 open-grafico" data-item = "DEFICIT FISCAL">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="DEFICIT FISCAL">DEFICIT FISCAL</div>
                         
                                </div>
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{number_format($data["deficit"],"2",",",".")}} USD </div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data["deficit_fuente"]}}">
                                            <div class="truncate">{{$data["deficit_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="intro-y mt-8 open-grafico" data-item = "RESERVAS INTERNACIONALES">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Reservas Internacionales">RESERVAS INTER</div>
                         
                                </div>
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{number_format($data["reservas"],"2",",",".")}} USD </div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data["reservas_fuente"]}}">
                                            <div class="truncate">{{$data["reservas_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y mt-8 open-grafico" data-item = "TASA DE INTERES">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Tasa de Interes">TASA DE INTERES</div>
                         
                                </div>
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data["tasa"]}} %</div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data["tasa_fuente"]}}">
                                            <div class="truncate">{{$data["tasa_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>




                    <div class="intro-y mt-8 open-grafico" data-item = "tasa_de_cambio">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="TASA DE CAMBIO">TASA DE CAMBIO</div>
                                    
                                </div>
                                <div class="ml-auto">
                                  
                                    </div>
                           
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']['tasa_cambio']}} {{$data['pais']->simbolo_moneda ?? ""}}</div>

             

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["tasa_cambio_fuente"]}}">
                                            <div class="truncate">{{$data['data']["tasa_cambio_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="intro-y mt-8 open-grafico" data-item = "tasa_de_desempleo">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="TASA DE DESEMPLEO">TASA DE DESEMPLEO</div>
                                    
                                </div>
                                <!-- <div class="ml-auto">
                                    @if(isset($data['data']["tasa_desempleo_variacion"]))
                                                @if($data['data']["tasa_desempleo_variacion"] != "")

                                                    @if($data['data']["tasa_desempleo_variacion"]>=0)
                                                    <div class="report-box__indicator bg-success cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["tasa_desempleo_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @elseif($data['data']["tasa_desempleo_variacion"] < 0)
                                                    <div class="report-box__indicator bg-danger cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["tasa_desempleo_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @else


                                                    @endif

                                                @endif
                                            @endif
                                    </div> -->
              
                                <div class="md:text-3xl text-xlfont-medium leading-8 mt-6 truncate">{{$data['data']['tasa_desempleo']}} %</div>


                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["tasa_desempleo_fuente"]}}">
                                            <div class="truncate">{{$data['data']["tasa_desempleo_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="intro-y mt-8 open-grafico" data-item = "poblacion_total">
                        <div class="report-box box zoom-in">
                            <div class="p-5">

                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Población Total">POBLACIÓN TOTAL</div>
                                   
                                </div>
                                <!-- <div class="ml-auto">
                                        
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
                                        </div> -->
                       
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']["poblacion_total"]}}</div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["poblacion_total_fuente"]}}">
                                            <div class="truncate">{{$data['data']["poblacion_total_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                             

                            </div>
                        </div>
                    </div>



                    <div class="intro-y mt-8 open-grafico" data-item = "poblacion_activa">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="POBLACIÓN ACTIVA">POBLACION ACTIVA</div>
                                    
                                </div>
                                <div class="ml-auto">
                                
                                   
                                    </div>
             
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']['poblacion_activa']}}</div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["poblacion_activa_fuente"]}}">
                                            <div class="truncate">{{$data['data']["poblacion_activa_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        
                    </div>

                    <div class="intro-y mt-8 open-grafico" data-item = "total_hogares">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Total Hogares">TOTAL HOGARES</div>
                                    
                                </div>
                                <!-- <div class="ml-auto">
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
                                    </div> -->
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']["hogares"]}}</div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["hogares_fuente"]}}">
                                            <div class="truncate">{{$data['data']["hogares_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                          

                            </div>
                        </div>
                    </div>

                    <div class="intro-y mt-8 open-grafico" data-item = "_personas_por_hogar">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Personas por hogar">PERSONAS POR HOGAR</div>
                                    
                                </div>
                                <!-- <div class="ml-auto">
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
                                    </div> -->
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']["personas_hogar"]}}</div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["personas_hogar_fuente"]}}">
                                            <div class="truncate">{{$data['data']["personas_hogar_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                             

                            </div>
                        </div>
                    </div>




                    <div class="intro-y mt-8 open-grafico" data-item = "diaspora_venezolana">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Migración Venezolana">MIGRACIÓN VENEZOLANA</div>
                                    
                                </div>
                                <!-- <div class="ml-auto">
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
                                    </div> -->

                         
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']["diaspora"]}}</div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["diaspora_fuente"]}}">
                                            <div class="truncate">{{$data['data']["diaspora_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                        

                            </div>
                        </div>
                    </div>

                    @if($data['data']["canasta_alimentaria_normativa"] != "")
                    <div class="intro-y mt-8 open-grafico" data-item = "canasta_alimentaria_normativa">
                        <div class="report-box box zoom-in">
                            <div class="p-5">

                                <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="CANASTA ALIMENTARIA NORMATIVA">CANASTA ALIMENTARIA NORMATIVA</div>
                                    
                                </div>
                                <!-- <div class="ml-auto">
                                    @if(isset($data['data']["pib_variacion"]))
                                                @if($data['data']["pib_variacion"] != "")

                                                    @if($data['data']["pib_variacion"]>=0)
                                                    <div class="report-box__indicator bg-success cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["pib_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @elseif($data['data']["pib_variacion"] < 0)
                                                    <div class="report-box__indicator bg-danger cursor-pointer" style="padding-left: 3px;">
                                                    {{$data['data']["pib_variacion"]}}% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                    </div>

                                                    @else


                                                    @endif

                                                @endif
                                            @endif
                                    </div> -->
                                
                                             
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{$data['data']["canasta_alimentaria_normativa"]}} USD</div>

                    
                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data['data']["canasta_alimentaria_normativa_fuente"]}}">
                                            <div class="truncate">{{$data['data']["canasta_alimentaria_normativa_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>
                                   
                                        
                          

                            </div>
                        </div>
                    </div>
                    @endif



      


                   

                   

                    

                    <!-- <div class="intro-y mt-8">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">
                            <div class="flex">
                                <div class="text-medium md:text-base text-slate-500 truncate tooltip" title="Tasa representativa de mercado">TRM</div>
                         
                                </div>
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6 truncate">{{number_format($data["trm"],"2",",",".")}} {{$data['pais']->simbolo_moneda ?? ""}}</div>

                                <div class="">
                                    <div class="">
                                        <div class="text-xs  report-text-success  cursor-pointer" title="{{$data["trm_fuente"]}}">
                                            <div class="truncate">{{$data["trm_fuente"]}}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> -->


  





                </div>
            </div>
     
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->

            <!-- END: Weekly Top Seller -->
            

            <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-bold mr-5 title-section">Datos Demográficos</h2>
                </div>
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


            <div class="col-span-12 sm:col-span-12 lg:col-span-12 mt-8">

<div class="grid grid-cols-12 intro-y box p-5 mt-5 ">

    <div class="col-span-12 intro-y block sm:flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Pirámide poblacional</h2>
    </div>
    <div class="col-span-12 sm:col-span-6">
    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">{{$data['demografico5_ano_old']}}</h2>
    </div>
        <div class="piramide-poblacional">
        <canvas id="pyramid-chart-3"></canvas>
        </div>
    </div>

    <div class="col-span-12 sm:col-span-6">
    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">{{$data['demografico5_ano']}}</h2>
    </div>
    <div class="piramide-poblacional">
        <canvas id="pyramid-chart-2"></canvas>
        </div>
    </div>



</div>



</div>

<div class="grid grid-cols-12 gap-6">
<div class="col-span-12 sm:col-span-6 mt-8">

<div class="intro-y box p-5 mt-5 w-full mx-auto">

    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Distribución del gasto por hogar</h2>
    </div>
    <div class="h-[400px]">
        <canvas id="gastos-por-hogar"></canvas>
    </div>



</div>



</div>

<div class="col-span-12 sm:col-span-6 mt-8">

            @if(session('pais_selected') == "Venezuela" || session('pais_selected') == "Colombia" )
                <div class="intro-y box p-5 mt-5 w-full mx-auto">

                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Canasta Alimentaria Normativa</h2>
                    </div>
                    <div class="h-[400px]">
                        <canvas id="canasta-alimentaria"></canvas>
                    </div>



                </div>

                @endif



</div>


</div>



</div>
</div>
</div>

<div id="open-grafico-modal" class="modal open-grafico-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body p-10 text-center">
            <div class="loader-pdf"
                style="visibility:visible;width: 100%; height: 100%; position: absolute; background-color: rgba(255,255,255,1); z-index: 9999; display: flex; align-items: center; text-align: center;top: 0px;left:0px;">
                <svg width="25" viewBox="-2 -2 42 42" xmlns="http://www.w3.org/2000/svg" stroke="rgb(30, 41, 59)"
                    class="w-32 h-32" style="margin: 0px auto;">
                    <g fill="none" fill-rule="evenodd">
                        <g transform="translate(1 1)" stroke-width="4">
                            <circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle>
                            <path d="M36 18c0-9.94-8.06-18-18-18">
                                <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18"
                                    dur="1s" repeatCount="indefinite"></animateTransform>
                            </path>
                        </g>
                    </g>
                </svg>
            </div>

            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-6 md:flex-row">
                        <div class="col-span-12">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5" id="item-name-grafico"></h2>
                            </div>
                        </div>
                  
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[400px]">
                            <canvas id="grafico-modal" class="mt-6 -mb-6"></canvas>
                        </div>
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


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/funnel.js"></script>
<script>
    const plugin = {
id: "increase-legend-spacing",
beforeInit(chart) {
// Get reference to the original fit function
const originalFit = chart.legend.fit;

// Override the fit function
chart.legend.fit = function fit() {
// Call original function and bind scope in order to use `this` correctly inside it
originalFit.bind(chart.legend)();
// Change the height as suggested in another answers
this.height += 20;
}
}
};
$( document ).ready(function() {
if ($("#pyramid-chart-2").length) {

    let ctx = $("#pyramid-chart-2")[0].getContext("2d");
    new Chart(ctx, {
        type: "bar",
        plugins: [ChartDataLabels],
        data: {
            labels: @json($data['demografico5_labels']),
            datasets: [
              {
                label: "Hombres",
                stack: "Stack 0",
                backgroundColor: "#2778F0",
                data: @json($data['demografico5_dataset_hombres']),
                datalabels: {
                        color: '#000',
                        anchor: 'left',
                        align: 'end',
                        font: {
                            size: 10
                        }
                    }
              },
              {
                label: "Mujeres",
                stack: "Stack 0",
                backgroundColor: "#F03327",
                data: @json($data['demografico5_dataset_mujeres']).map((k) => -k),
                datalabels: {
                        color: '#000',
                        anchor: 'left',
                        align: 'start',
                        font: {
                            size: 10
                        }
                    }
              },
            ],


        },
        options: {
            plugins: {
                    legend: {
                        display:false,
                        labels: {
                            color: '#FFF',
                        },
                    },
                    datalabels: {
                        color: '#000',
                        formatter: function(value, context) {
                            const valor = Number(value);
                            const positiveOnly = valor < 0 ? -valor : valor;
                            return jQuery.number(positiveOnly, 0, ',', '.' );
                        },
                        font: {
                            size: 10
                        }
                    },
                },
        maintainAspectRatio: false,
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
    plugins: [ChartDataLabels],
    data: {
        labels: @json($data['demografico5_labels_old']),
        datasets: [
          {
            label: "Hombres",
            stack: "Stack 0",
            backgroundColor: "#2778F0",
            data: @json($data['demografico5_dataset_hombres_old']),
            datalabels: {
                        color: '#000',
                        anchor: 'left',
                        align: 'end',
                        font: {
                            size: 10
                        }
                    }
          },
          {
            label: "Mujeres",
            stack: "Stack 0",
            backgroundColor: "#F03327",
            data: @json($data['demografico5_dataset_mujeres_old']).map((k) => -k),
            datalabels: {
                        color: '#000',
                        anchor: 'left',
                        align: 'start',
                        font: {
                            size: 10
                        }
                    }
          },
        ],


    },
    options: {
        plugins: {
                    legend: {
                        display:false,
                        labels: {
                            color: '#FFF',
                        },
                    },
                    datalabels: {
                        color: '#000',
                        formatter: function(value, context) {
                            const valor = Number(value);
                            const positiveOnly = valor < 0 ? -valor : valor;
                            return jQuery.number(positiveOnly, 0, ',', '.' );
                        },
                        font: {
                            size: 10
                        }
                    },
                },
      maintainAspectRatio: false,
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
                                return value.toFixed(1) + '%';
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
        jQuery.noConflict();
        let ctx = jQuery("#poblacion-migrante")[0].getContext("2d");
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
    if (jQuery("#gastos-por-hogar").length) {
        let ctx = jQuery("#gastos-por-hogar")[0].getContext("2d");
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
    if (jQuery("#nse-chart").length) {
 Highcharts.chart('nse-chart', {
    chart: {
        type: 'funnel',
        backgroundColor:"#EDEFF5"
    },
    title: {
        text: ''
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b> - {point.y:,.0f}%',
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
        data: @json($data['dataset_demografico4'])
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


    if (jQuery("#canasta-alimentaria").length) {
        let ctx30 = jQuery("#canasta-alimentaria")[0].getContext("2d");
     
        var myChart30 = new Chart(ctx30, {
            type: "line",
            plugins: [ChartDataLabels, plugin],
            data: {
                labels: @json($data['labels_comodities']),
                datasets: [
                    {
                        label: "Colombia",
                        data: @json($data['dataset_comodities']['item']),
                        borderWidth: 2,
                        borderColor: '#84cc16',
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: 0.4,
                        datalabels: {
                        color: '#000',
                        anchor: 'left',
                        align: 'end',
                        font: {
                            size: 10
                        }
                    }
                    },

                    {
                        label: "Venezuela",
                        data: @json($data['dataset_comodities2']['item']),
                        borderWidth: 2,
                        borderColor: '#f03427',
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: 0.4,
                        datalabels: {
                        color: '#000',
                        anchor: 'left',
                        align: 'end',
                        font: {
                            size: 10
                        }
                    }
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
            padding: {
                right: 20 // or however much padding you need
            }
        },
                plugins: {
                    legend: {
                        display: true,
                    },
                    datalabels: {
                        color: '#000',
                        formatter: function(value, context) {
                            return jQuery.number(value, 2, ',', '.' );
                        },
                        font: {
                            size: 10
                        }
                    },
                },
                scales: {
                    x: {
                        padding: 20,
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
                            padding: 20,
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

    


    jQuery(document).ready( function () {
    jQuery.noConflict();
    jQuery('#table-poblacion-por-area').DataTable({
        "searching": false,
        "ordering": false,
        "lengthChange": false,
    });

} );
var myChart3;
jQuery(document).on("click", ".open-grafico", function () {


let loader = document.querySelector('.loader-pdf')
jQuery.noConflict();
console.log("Abrir Modal");
var item = jQuery(this).attr("data-item");
jQuery.ajax({
                type: 'POST',
                url: "{{ url('usuario/grafico-kpi') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    item: item
                },
                success: function (data) {
                    loader.style.visibility = 'hidden';
                    response = JSON.parse(data);


                    var data_set = [];

                    $("#item-name-grafico").html(response.item_name);

                    if ($("#grafico-modal").length) {
        let ctx = $("#grafico-modal")[0].getContext("2d");

        if(typeof myChart3 !== "undefined" && myChart3 !== null){
                    myChart3.destroy();
                    myChart3 = null;
        }
     
        myChart3 = new Chart(ctx, {
            type: "line",
            plugins: [ChartDataLabels, plugin],
            data: {
                labels: response.labels_comodities,
                datasets: [
                    {
                        label: response.item_name,
                        data: response.dataset_comodities['item'],
                        borderWidth: 2,
                        borderColor: '#84cc16',
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: 0.4,
                        datalabels: {
                        color: '#000',
                        anchor: 'left',
                        align: 'end',
                        font: {
                            size: 10
                        }
                    }
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                    },
                    datalabels: {
                        color: '#000',
                        formatter: function(value, context) {
                            return jQuery.number(value, 2, ',', '.' );
                        },
                        font: {
                            size: 10
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
                            padding: 20,
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




                            const myModal = tailwind.Modal.getInstance(document.querySelector("#open-grafico-modal"));
                            myModal.show();
                            var isChrome = navigator.userAgent.toLowerCase().indexOf("chrome") >= 0 ? true : false;

                            if(isChrome){
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            }

     


                },
                error: function (e) {
                    loader.style.visibility = 'hidden';
                    console.log(e);
                }
            });




});

</script>
@endsection