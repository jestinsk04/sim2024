@extends('../layout/' . $layout)

@section('subhead')
<title>Valoración de Mercado - Usuario - SIMEP</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 md:col-span-12 mt-8">
                <div class="intro-y items-center">
                    <h2 class="text-xl font-bold xl:truncate mr-5 w-full title-section">Valoración de mercado</h2>
                    <div class=" mt-8">
                    <div class="px-2">
                        <div class="h-full  rounded-md">
                          
                            <p>Información y Entregable de la Valoración anual del mercado de consumo masivo como insumo fundamental para la captación de oportunidades de negocio a ser incorporadas en los planes estratégicos de la empresa y las estimaciones de demanda por categoría (categorías objetivo para Empresas Polar)</p>
                           
                        </div>
                    </div>
                    
                   
                </div>
                   
                </div>
                
                <div class="intro-y col-span-12 box p-5 overflow-auto lg:overflow-visible mt-8">
                <div class="col-span-12 lg:col-span-12 ">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Informes</h2>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-report -mt-2" id="table-informes">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Fecha</th>
                                <th class="whitespace-nowrap">Categoria</th>
                                <th class="text-center whitespace-nowrap">Año</th>
                                <th class="text-center whitespace-nowrap">Nombre</th>
                                <th class="text-center whitespace-nowrap">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        @if(count($data['valoracion_mercado_1']) > 0)
                            @foreach($data['valoracion_mercado_1'] as $key => $value)
                            <tr class="intro-x">
                                <td class="text-center">{{$value->fecha}}</td>
                                <td class="text-center">{{$value->categoria}}</td>
                                <td class="text-center">{{$value->ano}}</td>
                                <td class="text-center">{{$value->name}}</td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                    @str_contains($value->url, 'app.powerbi.com')
                                            <a class="btn btn-primary py-3 px-4  h-8 xl:w-32 xl:mr-3 mr-3 power-viewer"  data-file="{{$value->url}}" href="javascript:;">Ver</a>
                                            @else

                                            <a class="btn btn-primary py-3 px-4  h-8 xl:w-32 xl:mr-3 mr-3r mr-3 pdf-viewer" data-file="{{trim(str_replace('https://sim-ep.com', '', $value->url))}}" href="javascript:;">Ver</a>

                                            @endstr_contains

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                           
                                      
                               
                    
                                </tbody>
                    </table>
                </div>
                    
                </div>
            </div>


            <div class="col-span-12 sm:col-span-12 lg:col-span-12 mt-8">
               

                <div class="intro-y box p-5 mt-5">

                <div class="intro-y block sm:flex items-center ">
                    <h2 class="text-lg font-medium xl:truncate mr-5">Mercado total consumo masivo</h2>
                </div>
                <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-6 ">
                    <div class="h-[500px]" style="height:500px;margin-top: 4rem;">
                        <canvas id="grafico-1"></canvas>
                    </div>
                </div>


                <div class="col-span-12 sm:col-span-6">
                    <div class="overflow-x-auto">
                        <table class="table table-report -mt-2" id="table-total-consumo-masivo">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">Categoria</th>
                           @if(count($data['valoracion_mercado_2_anos']) > 0)
                                @foreach($data['valoracion_mercado_2_anos'] as $key => $value)
                                <th class="whitespace-nowrap">{{$value->ano}}</th>
                                @endforeach
                            @endif
                               
                                </tr>
                            </thead>
                            <tbody>
    
                            @if(count($data['valoracion_mercado_2_names']) > 0)
                                @foreach($data['valoracion_mercado_2_names'] as $key => $value)
                                <tr class="intro-x">
                                   
                                        <td class="">{{$value->name}}</td>
                            @if(count($data['valoracion_mercado_2_anos']) > 0)
                                @foreach($data['valoracion_mercado_2_anos'] as $key2 => $value2)
                                <td class="">{{$data['valoracion_mercado_2_data'][$value2->ano][$value->name]['dato'] ?? 0}}%</td>
                                @endforeach
                            @endif
                                        
                                    </tr>
                                @endforeach
                            @endif
                                    
                                   
                                 
                                   
                        
                                    </tbody>
                        </table>
                    </div>
                
                </div>

                </div>
                    
                </div>



            </div>

            <div class="col-span-12 sm:col-span-12 lg:col-span-12 mt-8">
               

               <div class="intro-y box p-5 mt-5">
              
               <div class="intro-y block sm:flex items-center mb-4">
                   <h2 class="text-lg font-medium mr-5">Relevancia de las categorias de mercado total</h2>
               </div>
               <div class="grid grid-cols-12 gap-6">
               <div class="col-span-12 sm:col-span-6 ">
                   <div class="h-[500px]"  style="height:500px;margin-top: 4rem;">
                       <canvas id="grafico-2"></canvas>
                   </div>
               </div>


               <div class="col-span-12 sm:col-span-6 ">
                <div class="overflow-x-auto">
                    <table class="table table-report -mt-2" id="table-categorias-mercado">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Categorias</th>
                                <th class="whitespace-nowrap">MMBs</th>
                                <th class=" whitespace-nowrap">%</th>
                                
                            </tr>
                        </thead>
                        <tbody>
 
                        @if(count($data['grafico2_data_grafico']) > 0)
                             @foreach($data['grafico2_data_grafico'] as $key => $value)
                             <tr class="intro-x">
                                     <td class="">{{$value->name}}</td>
                                     <td class="">{{$value->dato}}</td>
                                     <td class="">{{$value->porcentaje*100}}%</td>
                                   
                                 </tr>
                             @endforeach
                         @endif
                    
                                </tbody>
                    </table>
                </div>
               
               </div>

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
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0" ></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-funnel@1.0.5/dist/chart.funnel.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function encodeURLNFD(str) {
    // Normalize the string to NFD
    let normalizedStr = str.normalize('NFD');

    // Encode spaces as %20 and non-ASCII characters
    let encodedStr = '';
    for (let i = 0; i < normalizedStr.length; i++) {
        let charCode = normalizedStr.charCodeAt(i);
        if (charCode === 32) {
            encodedStr += '%20';
        } else if (charCode > 0x7F) {
            encodedStr += encodeURIComponent(normalizedStr[i]);
        } else {
            encodedStr += normalizedStr[i];
        }
    }

    return encodedStr;
}
    var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.5,
    canvas = document.getElementById('the-canvas'),
    ctx = canvas.getContext('2d');

    $(document).on("click", ".pdf-viewer", function () {
        jQuery.noConflict();
        console.log("Abrir Modal")
        var file = jQuery(this).attr("data-file");
        var url = encodeURLNFD(file);
        if(file != undefined){

            $("#file-url").val(url);
        }else{

            url = $("#file-url").val();

        }
        
        // jQuery("#iframe-file").attr("src", url);
        const myModal = tailwind.Modal.getInstance(document.querySelector("#pdf-viewer-modal"));
        // myModal.show();
       


console.log(url);
        loadPDF(url);
        
       
        myModal.show();
        var isChrome = navigator.userAgent.toLowerCase().indexOf("chrome") >= 0 ? true : false;

if(isChrome){
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

  







    });

    function loadPDF(url){
        let loader = document.querySelector('.loader-pdf')
        loader.style.visibility = 'visible';
        pageNum = 1;
// Loaded via <script>
    var pdfjsLib = window['pdfjs-dist/build/pdf'];

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';



    // Asynchronous download of PDF
    // var loadingTask = pdfjsLib.getDocument(url);
    // loadingTask.promise.then(function(pdf) {
    //   console.log('PDF loaded');

    //   // Fetch the first page
    //   var pageNumber = 1;
    //   pdf.getPage(pageNumber).then(function(page) {
    //     console.log('Page loaded');

    //     var scale = 1.5;
    //     var viewport = page.getViewport({scale: scale});

    //     // Prepare canvas using PDF page dimensions
    //     var canvas = document.getElementById('the-canvas');
    //     var context = canvas.getContext('2d');
    //     canvas.height = viewport.height;
    //     canvas.width = viewport.width;

    //     // Render PDF page into canvas context
    //     var renderContext = {
    //       canvasContext: context,
    //       viewport: viewport
    //     };
    //     var renderTask = page.render(renderContext);
    //     renderTask.promise.then(function () {
    //       console.log('Page rendered');
    //     });
    //   });
    // }, function (reason) {
    //   // PDF loading error
    //   console.error(reason);
    // });



    pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('page_count').textContent = pdfDoc.numPages;
        loader.style.visibility = 'hidden';
        // Initial/first page rendering
        renderPage(pageNum);
    })
    .catch(function (error){
                if(error.name == "MissingPDFException"){
                    const myModal = tailwind.Modal.getInstance(document.querySelector("#pdf-viewer-modal"));
                    myModal.hide();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El PDF solicitado no existe.'
                    })
                }
                console.error('Error loading PDF:', error);
                loader.style.visibility = 'hidden';



            });
    }
        /**
         * Displays previous page.
         */
        function renderPage(num) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function (page) {
                var viewport = page.getViewport({
                    scale: scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function () {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').textContent = num;
        }

        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }

        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Displays next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }

        document.getElementById('prev').addEventListener('click', onPrevPage);



        document.getElementById('next').addEventListener('click', onNextPage);


    $(document).on("click", ".pdf-solicitud", function () {

        console.log("Abrir Modal")
        const myModal = tailwind.Modal.getInstance(document.querySelector("#pdf-solicitud"));
        myModal.show();
        var isChrome = navigator.userAgent.toLowerCase().indexOf("chrome") >= 0 ? true : false;

if(isChrome){
    window.scrollTo({ top: 0, behavior: 'smooth' });
}


    });


    // if ($("#grafico-2").length) {
    //     let ctx = $("#grafico-2")[0].getContext("2d");
    //     let myChart = new Chart(ctx, {
    //         type: "bar",
    //         plugins: [ChartDataLabels],
    //         data: {
    //             labels:  @json($data['grafico2_labels']),
    //             datasets: [
    //                 {
    //                     barPercentage: 0.5,
    //                     barThickness: 25,
    //                     maxBarThickness: 25,
    //                     minBarLength: 2,
    //                     data: @json($data['grafico2_dataset']),
    //                     backgroundColor: @json($data['grafico2_colors']),
    //                 },
    //             ],
    //         },
    //         options: {
    //             maintainAspectRatio: false,
    //             plugins: {
    //                 legend: {
    //                     display:false,
    //                     labels: {
    //                         color: '#35495e',
    //                     },
    //                 },
    //                 datalabels: {
    //                     anchor: 'end',
    //                     align: 'top',
    //                     formatter: function(value, context) {
    //                             return Math.round(value) + '%';
    //                     },
    //                     font: {
    //                         weight: 'bold'
    //                     }
    //                 },
    //                 tooltip: {
    //             callbacks: {
    //                 label: function(context) {
    //                     let label = context.dataset.label || '';

    //                     if (label) {
    //                         label += ': ';
    //                     }
    //                     if (context.parsed.y !== null) {
    //                         label += context.parsed.y + "%";
    //                     }
    //                     return label;
    //                 }
    //             }
    //         },
    //             },
    //             scales: {
    //                 x: {
    //                     ticks: {
    //                         font: {
    //                             size: 12,
    //                         },
    //                         color: '#35495e',
    //                     },
    //                     grid: {
    //                         display: false,
    //                         drawBorder: false,
    //                     },
    //                 },
    //                 y: {
    //                     ticks: {
    //                         font: {
    //                             size: "12",
    //                         },
    //                         color: '#35495e',
    //                         callback: function (value, index, values) {
    //                             return value + "%";
    //                         },
    //                     },
    //                     grid: {
    //                         color: '#35495e',
    //                         borderDash: [2, 2],
    //                         drawBorder: false,
    //                     },
    //                 },
    //             },
    //         },
    //     });
    // }

    if ($("#grafico-2").length) {
        let ctx = $("#grafico-2")[0].getContext("2d");
        var myChart2 = new Chart(ctx, {
            type: "doughnut",
            plugins: [ChartDataLabels],
            data: {
                labels:  @json($data['grafico2_labels']),
                datasets: [
                    {
                        data: @json($data['grafico2_dataset']),
                        borderWidth: 0,
                        hoverBackgroundColor:@json($data['grafico1_colors']),
                        backgroundColor: @json($data['grafico1_colors']),
                        borderColor:@json($data['grafico1_colors']),
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    responsive: true,
                    legend: {
                        position:"left",
                        align:"start",
                        labels: {
                            color: '#35495e',
                        },
                    },
                    datalabels: {
                        clamp: true,
                        anchor: 'end',
                        align: 'start',
                        offset: 30,
                        color:"#FFF",
                        
                        formatter: function(value, context) {
                                return value.toFixed(1) + '%';
                        },
                        font: {
                            weight: 'bold'
                        }
                    },
                },
                cutout: "0%",
                layout: {
            margin: {
                top: 50
            }
        },
        animation: {
            onComplete: function() {
       
    updateLegendPosition();
  }
        }
            },
        });
    }



    if ($("#grafico-1").length) {
        let ctx = $("#grafico-1")[0].getContext("2d");
        var myChart1 = new Chart(ctx, {
            type: "doughnut",
            plugins: [ChartDataLabels],
            data: {
                labels:  @json($data['grafico1_labels']),
                datasets: [
                    {
                        data: @json($data['grafico1_dataset']),
                        borderWidth: 0,
                        hoverBackgroundColor:@json($data['grafico1_colors']),
                        backgroundColor: @json($data['grafico1_colors']),
                        borderColor:@json($data['grafico1_colors']),
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position:"left",
                        align:"start",
                        labels: {
                            color: '#35495e',
                        },
                    },
                    datalabels: {
                        clamp: true,
                        anchor: 'end',
                        align: 'start',
                        offset: 30,
                        color:"#FFF",
                        
                        formatter: function(value, context) {
                                return value.toFixed(1) + '%';
                        },
                        font: {
                            weight: 'bold'
                        }
                    },
                },
                cutout: "0%",
                layout: {
            margin: {
                top: 50
            }
        },
        animation: {
            onComplete: function() {
       
    updateLegendPosition();
  }
        }
            },
        });
    }
    $(document).ready( function () {
    jQuery.noConflict();
    jQuery('#table-informes').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });

    jQuery('#table-total-consumo-masivo').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });

    jQuery('#table-categorias-mercado').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });



    console.log("Ancho Pantalla")
    console.log(jQuery(window).width());

    var width = jQuery(window).width();

    if(width <= 500){

        myChart1.options.plugins.legend.position="top";
        myChart1.update();

    }else{



    }


} );

function updateLegendPosition(){
var width = jQuery(window).width();
if(width <= 500){ 
    
    
    myChart1.options.plugins.legend.position="top" ; myChart1.update(); 

    myChart2.options.plugins.legend.position="top" ; myChart2.update(); 

}else{ 

    myChart1.options.plugins.legend.position="left" ; myChart1.update(); 

    myChart2.options.plugins.legend.position="left" ; myChart2.update(); 


} }


$(window).resize(updateLegendPosition);

</script>


@endsection