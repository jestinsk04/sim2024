@extends('../layout/' . $layout)

@section('subhead')
<title>Valoración de marca - Usuario - SIMEP</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 md:col-span-12 mt-8">
                <div class="intro-y items-center ">
                    <h2 class="text-xl font-bold truncate mr-5 w-full title-section">Valoración de marca</h2>
                    <div class=" mt-8">
                    <div class="px-2">
                        <div class="h-full  rounded-md">
                          
                            <p>Información y Entregable de las Valoraciones de marcas del mercado de consumo masivo como insumo fundamental para la captación de oportunidades de negocio a ser incorporadas en los planes estratégicos de la empresa y las estimaciones de demanda..</p>
                        </div>
                    </div>
                    
                   
                </div>


                </div>

                <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
        
                                    <select id="marca-list" class="form-select form-select-lg sm:mt-2 sm:mr-2 sm:col-span-3 col-span-6"
                                        aria-label=".form-select-lg example">
                                        <option>Marca</option>
                                        @if(count($data['grafico_data']) > 0)
                            @foreach($data['grafico_data'] as $key => $value)

                            <option  @if($data['marca_selected'] == $value->name) selected @endif value="{{$value->name}}">{{$value->name}}</option>
                            @endforeach
                            @endif
                                    </select>
                                </div>

                <div class="grid grid-cols-2 gap-6 md:grid-cols-5 mt-8">



                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class="p-5">

                                <div class="text-medium md:text-base text-slate-500 mt-1 tooltip"  title="VALOR TOTAL MARCA">VALOR TOTAL MARCA</div>
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6" id="valor-total-marca">{{$data["valor_total_marca"]}}</div>

                                <div class="flex">
                                    <div class="">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y">
                        <div class="report-box box zoom-in">
                            <div class=" p-5">

                                <div class="text-medium md:text-base text-slate-500 mt-1 tooltip"  title="VALOR MARCA PAIS">VALOR MARCA PAIS</div>
                                <div class="md:text-3xl text-xl font-medium leading-8 mt-6" id="valor-marca-pais">{{$data["valor_marca_pais"]}}</div>

                                <div class="flex">
                                    <div class="">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                <div class="intro-y box mt-14 p-5">
                <div class="h-[400px] ">
                    <canvas id="grafico-1"></canvas>
                </div>
                    </div>

                









            </div>
        </div>
    </div>
</div>


<div id="pdf-viewer-modal" class="modal pdf-viewer-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body p-10 text-center">
                <!-- <iframe class="w-full" id="iframe-file" style=""
                    src="https://sim-ep.com/storage/uploads/simep.pdf#toolbar=0" height="800"
                    frameborder="0"></iframe> -->
                <input type="hidden" id="file-url">
                <div class="pagination">
                    <div class="wrap">
                    <a href="javascript:void();" id="prev"><i data-lucide="skip-back" class="w-8 h-8 mr-8"></i></a>
                        <a href="javascript:void();" id="next"><i data-lucide="skip-forward" class="w-8 h-8 mr-8"></i></a>
                            &nbsp; &nbsp;
                            <span>Página: <span id="page_num"></span> /
                                <span id="page_count"></span></span>
                    </div>
                </div>

                <canvas id="the-canvas"></canvas>
            </div>
        </div>
    </div>
</div>


<div id="pdf-solicitud" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Solicitud de Información</h2>

            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 sm:col-span-12">
                    <label for="modal-form-1" class="form-label">De</label>
                    <input id="modal-form-1" type="text" class="form-control" readonly
                        value="{{ Auth::user()->name }} {{ Auth::user()->lname }}">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="modal-form-2" class="form-label">Pais</label>
                    <input id="modal-form-2" type="text" class="form-control" readonly
                        value="{{ $data['pais']->name }}">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="modal-form-3" class="form-label">Categoria</label>
                    <input id="modal-form-3" type="text" class="form-control" value="Categoria" readonly placeholder="Categoria">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="modal-form-4" class="form-label">Año</label>
                    <input id="modal-form-4" type="text" class="form-control" value="2022" readonly placeholder="Año">
                </div>
               
                <div class="col-span-12 sm:col-span-6">
                    <label for="modal-form-5" class="form-label">Nombre Estudio</label>
                    <input id="modal-form-5" type="text" class="form-control" value="Nombre Estudio" readonly placeholder="Nombre Estudio">
                </div>
                <div class="col-span-12 sm:col-span-21">
                    <label for="modal-form-5" class="form-label">Correo Solicitante</label>
                    <input id="modal-form-5" type="text" class="form-control" readonly
                        value="{{ Auth::user()->email }}">
                </div>
                <div class="col-span-12 sm:col-span-21">
                    <label for="modal-form-5" class="form-label">Observaciones</label>
                    <textarea class="form-control" name="" id="" cols="30" rows="10"
                        placeholder="Observaciones"></textarea>

                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal"
                    class="btn btn-outline-secondary w-20 mr-1">Cancelar</button>
                <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-20">Enviar</button>
            </div>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"
    integrity="sha512-j+F4W//4Pu39at5I8HC8q2l1BNz4OF3ju39HyWeqKQagW6ww3ZF9gFcu8rzUbyTDY7gEo/vqqzGte0UPpo65QQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
<script>
    $(document).on("click", ".pdf-viewer", function () {

        console.log("Abrir Modal")
        const myModal = tailwind.Modal.getInstance(document.querySelector("#pdf-viewer-modal"));
        myModal.show();
        var isChrome = navigator.userAgent.toLowerCase().indexOf("chrome") >= 0 ? true : false;

if(isChrome){
    window.scrollTo({ top: 0, behavior: 'smooth' });
}


    });


    $(document).on("click", ".pdf-solicitud", function () {

        console.log("Abrir Modal")
        const myModal = tailwind.Modal.getInstance(document.querySelector("#pdf-solicitud"));
        myModal.show();
        var isChrome = navigator.userAgent.toLowerCase().indexOf("chrome") >= 0 ? true : false;

if(isChrome){
    window.scrollTo({ top: 0, behavior: 'smooth' });
}


    });
    if ($(".banner-informativo").length) {
        $(".banner-informativo").each(function () {
            tns({
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: false,
                controls: false,
                nav: true,
                speed: 500,
            });
        });
    }
   console.log(@json($data['grafico_dataset']));
    if ($("#grafico-1").length) {
        let ctx = $("#grafico-1")[0].getContext("2d");
        var myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: @json($data['grafico_labels']),
                datasets: [
                    {
                        label: "Valor Total Marca",
                        data: @json($data['grafico_dataset']["valor_total_marca"]),
                        borderWidth: 2,
                        borderColor: '{{$data['colores'][0]}}',
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: 0.4,
                    }, 
                    {
                        label: "Valor Marca Pais",
                        data: @json($data['grafico_dataset']["valor_marca_pais"]),
                        borderWidth: 2,
                        borderColor: '{{$data['colores'][1]}}',
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: 0.4,
                    }, 
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
$(document).on("change", "#marca-list", function () {

jQuery.noConflict();
console.log("Cambio Marca")
var marca = jQuery(this).val();
if(marca != ""){

    let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-valoracion-marca') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   marca: marca
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   console.log(response.valor_total_marca);
                   jQuery("#valor-marca-pais").html(response.valor_marca_pais);
                   jQuery("#valor-total-marca").html(response.valor_total_marca);


                   if ($("#grafico-1").length) {
        let ctx = $("#grafico-1")[0].getContext("2d");
        myChart.destroy();
        myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: @json($data['grafico_labels']),
                datasets: [
                    {
                        label: "Valor Total Marca",
                        data: response.grafico_dataset.valor_total_marca,
                        borderWidth: 2,
                        borderColor: '{{$data['colores'][0]}}',
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: 0.4,
                    }, 
                    {
                        label: "Valor Marca Pais",
                        data: response.grafico_dataset.valor_marca_pais,
                        borderWidth: 2,
                        borderColor: '{{$data['colores'][1]}}',
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: 0.4,
                    }, 
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

                


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });

//location.href = "https://sim-ep.com/usuario/valoracion-marca/"+marca;

}



});
</script>


@endsection
