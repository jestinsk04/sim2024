@extends('../layout/' . $layout)

@section('subhead')
<title>RRSS - Redes Sociales - SIMEP</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 md:col-span-12 mt-8">
                <div class="intro-y items-center">
                    <h2 class="text-xl font-bold truncate mr-5 w-full title-section">RRSS - Redes Sociales</h2>
                    <div class=" mt-8">
                    <div class="px-2">
                        <div class="h-full  rounded-md">
                          
                            <p>Se muestra tanto el comportamiento/ interacción de las marcas de harina de maíz en las regiones: LATAM, España, USA y Venezuela a través de los principales indicadores de Social Media; como también, el perfil de las personas que interactúan con la plataforma de RRSS de la marca P.A.N (IG y FB) en el país a través de Profiler Audience Analysis.</p>
                        </div>
                    </div>
                    
                   
                </div>
                   
                </div>
            </div>

            <div class="col-span-12 md:col-span-12">

               
<div class="intro-y box p-5 mt-8 col-span-12 overflow-auto lg:overflow-visible">

<div class="col-span-12 lg:col-span-12">
                                <div class="intro-y block sm:flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">Informes - Profiles</h2>
                                </div>
                            </div>

    <div class="grid grid-cols-12 gap-2 mb-4">
        <select id="informes-filtro-year" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-12 sm:col-span-3 xl:col-span-3"
            aria-label=".form-select-lg example">
            <option>Año</option>
            @if(count($data['anos']) > 0)
            @foreach($data['anos'] as $key => $value)

            <option @if($data['current_year_informes'] == $value->ano) selected @endif  value="{{$value->ano}}">{{$value->ano}}</option>
            @endforeach
            @endif
        </select>
    </div>

    <table class="table table-report mt-4 col-span-6" id="table-data">
        <thead>
            <tr>
                <th class="text-center whitespace-nowrap">Nombre</th>
                <th class="text-center whitespace-nowrap">Periodo</th>
                <th class="text-center whitespace-nowrap">Descripcion</th>
                <th class="text-center whitespace-nowrap">Frecuencia</th>
                <th class="text-center whitespace-nowrap">Opciones</th>
            </tr>
        </thead>
        <tbody id="datatable-elements">

        @if(count($data['data']) > 0)
            @foreach($data['data'] as $key => $value)
            <tr class="intro-x">
                <td class="text-center">{{$value->name}}</td>
                <td class="text-center">{{$value->periodo}}</td>
                <td class="text-center">{{$value->descripcion}}</td>
                <td class="text-center">{{$value->frecuencia}}</td>
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

            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-6 md:flex-row">
                        <div class="col-span-12">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Volumen - Menciones Totales</h2>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
                                
                                    <select id="marca-filter-seccion3" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-6 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option>Marca</option>
                                        @if(count($data['marca_seccion3']) > 0)
                            @foreach($data['marca_seccion3'] as $key => $value)

                            <option @if($data['current_marca3'] == $value->marca) selected @endif value="{{$value->marca}}">{{$value->marca}}</option>
                            @endforeach
                            @endif
                                    </select>
                                </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[275px]">
                            <canvas id="menciones-totales-chart" class="mt-6 -mb-6"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-12 md:flex-row">
                        <div class="col-span-12">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Interacciones Totales</h2>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
                        <select id="marca-filter-seccion4" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-6 xl:col-span-3"
                                    aria-label=".form-select-lg example">
                                    <option>Marca</option>
                                    @if(count($data['marca_seccion4']) > 0)
                        @foreach($data['marca_seccion4'] as $key => $value)

                        <option @if($data['current_marca4'] == $value->marca) selected @endif value="{{$value->marca}}">{{$value->marca}}</option>
                        @endforeach
                        @endif
                                </select>
                            </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[275px]">
                            <canvas id="interacciones-totales-chart" class="mt-6 -mb-6"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-6  md:flex-row">
                        <div class="col-span-12">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Análisis de sentimientos</h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
                                
                                    <select id="marca-filter-seccion1" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-6 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option>Marca</option>
                                        @if(count($data['marca_seccion1']) > 0)
                            @foreach($data['marca_seccion1'] as $key => $value)

                            <option @if($data['current_marca1'] == $value->marca) selected @endif value="{{$value->marca}}">{{$value->marca}}</option>
                            @endforeach
                            @endif
                                    </select>
                                </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[400px]">
                            <canvas id="analisis-sentimiento-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-full">
                    <div class="col-span-6 md:flex-row">
                        <div class="col-span-12">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Share of media</h2>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
                                
                                <select id="marca-filter-seccion2" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-6 xl:col-span-3"
                                    aria-label=".form-select-lg example">
                                    <option>Marca</option>
                                    @if(count($data['marca_seccion2']) > 0)
                        @foreach($data['marca_seccion2'] as $key => $value)

                        <option @if($data['current_marca2'] == $value->marca) selected @endif value="{{$value->marca}}">{{$value->marca}}</option>
                        @endforeach
                        @endif
                                </select>
                            </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 report-chart ">
                        <div class="h-[400px]">
                            <canvas id="share-of-media-chart"></canvas>
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
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0" ></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

if ($("#menciones-totales-chart").length) {
        var ctx1 = $("#menciones-totales-chart")[0].getContext("2d");
        var myChart1 = new Chart(ctx1, {
            type: "line",
            plugins: [ChartDataLabels],
            data: {
                labels: @json($data['grafico3_labels']),
                datasets: [
                    @if(count($data['grafico3_data']) > 0)
                            @foreach($data['grafico3_data'] as $key => $value)
                            {
                        label: "{{$value->marca}}",
                        data: @json($data['grafico3_dataset'][$value->marca]),
                        borderWidth: 2,
                        borderColor: '{{$data['colores'][$key]}}',
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
                    datalabels: {
                        color: '#000',
                        formatter: function(value, context) {
                            return jQuery.number(value, 0, ',', '.' );
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
    if ($("#interacciones-totales-chart").length) {
        var ctx2 = $("#interacciones-totales-chart")[0].getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: "line",
            plugins: [ChartDataLabels],
            data: {
                labels: @json($data['grafico4_labels']),
                datasets: [
                    @if(count($data['grafico4_data']) > 0)
                            @foreach($data['grafico4_data'] as $key => $value)
                            {
                        label: "{{$value->marca}}",
                        data: @json($data['grafico4_dataset'][$value->marca]),
                        borderWidth: 2,
                        borderColor: '{{$data['colores'][$key]}}',
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
                    datalabels: {
                        color: '#000',
                        formatter: function(value, context) {
                            return jQuery.number(value, 0, ',', '.' );
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
    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';



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
$(document).ready( function () {
    jQuery.noConflict();
    jQuery('#table-data').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });


} );



if ($("#analisis-sentimiento-chart").length) {
        var ctx3 = $("#analisis-sentimiento-chart")[0].getContext("2d");
        var myChart3 = new Chart(ctx3, {
            type: "bar",
            plugins: [ChartDataLabels],
            data: {
                labels: @json($data['labels_seccion1']),
                datasets: [
                    @if(count($data['sentimiento_data_seccion1']) > 0)
                            @foreach($data['sentimiento_data_seccion1'] as $key => $value)
                            {
                        label: "{{$value->name}}",
                        barPercentage: 1,
                        barThickness: 10,
                        backgroundColor: "{{$data['coloresSentimiento'][$key]}}",
                        data: @json($data['dataset_seccion1'][$value->name]),
                        datalabels: {
                        color: '#000',
                        anchor: 'left',
                        align: 'end',
                        font: {
                            size: 10
                        }
                    }

                            },
                            @endforeach
                    @endif
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#35495e',
                        },
                    },
                    datalabels: {
                        color: '#000',
                        formatter: function(value, context) {
                            return jQuery.number(value, 0, ',', '.' )+" %";
                        },
                        font: {
                            size: 10
                        }
                    },
                },
                scales: {
                    x: {
                        stacked: true,
                        ticks: {
                            font: {
                                size: "12",
                            },
                            color: '#35495e',
                        },
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                    },
                    y: {
                        stacked: true,
                        ticks: {
                            font: {
                                size: "12",
                            },
                            color: '#35495e',
                            callback: function (value, index, values) {
                                return value;
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


    if ($("#share-of-media-chart").length) {
        var ctx4 = $("#share-of-media-chart")[0].getContext("2d");
        var myChart4 = new Chart(ctx4, {
            type: "bar",
            plugins: [ChartDataLabels],
            data: {
                labels: @json($data['labels_seccion2']),
                datasets: [
                    @if(count($data['sentimiento_data_seccion2']) > 0)
                            @foreach($data['sentimiento_data_seccion2'] as $key => $value)
                            {
                        label: "{{$value->name}}",
                        barPercentage: 1,
                        barThickness: 10,
                        backgroundColor: "{{$data['colores2'][$key]}}",
                        data: @json($data['dataset_seccion2'][$value->name]),
                        datalabels: {
                        color: '#000',
                        anchor: 'left',
                        align: 'end',
                        font: {
                            size: 10
                        }
                    }

                            },
                            @endforeach
                    @endif
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#35495e',
                        },
                    },
                    datalabels: {
                        color: '#000',
                        formatter: function(value, context) {
                            return jQuery.number(value, 0, ',', '.' )+" %";;
                        },
                        font: {
                            size: 10
                        }
                    },
                },
                scales: {
                    x: {
                        stacked: true,
                        ticks: {
                            font: {
                                size: "12",
                            },
                            color: '#35495e',
                        },
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                    },
                    y: {
                        stacked: true,
                        ticks: {
                            font: {
                                size: "12",
                            },
                            color: '#35495e',
                            callback: function (value, index, values) {
                                return value;
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






$(document).on("change", "#marca-filter-seccion1", function () {

jQuery.noConflict();
console.log("Cambio MARCA SECCION 1")
var marca = jQuery(this).val();
if(marca != ""){

    let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-redes-sociales') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   tipo: 2,
                   marca: marca,
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var data_set = [];

                   var cnt = 0;

        
                    jQuery.each(response.sentimiento_data_seccion1, function(i, item) {

                        <?php $cnt = 0; ?>
                        data_set += '{'+
                        'label: '+response.sentimiento_data_seccion1[i].name+','+
                        'barPercentage: 0.5,'+
                        'barThickness: 6,'+
                        'maxBarThickness: 8,'+
                        'minBarLength: 2,'+
                        'backgroundColor: {{$data["coloresSentimiento"][$cnt]}},'+
                        'data: '+response.dataset_seccion1[response.sentimiento_data_seccion1[i].name]+'},'+
                    '}'

                            <?php $cnt++; ?>
                        });
                


                        //console.log(data_set)
                   if ($("#analisis-sentimiento-chart").length) {

                    myChart3.data.labels = response.labels_seccion1;
                 
                    myChart3.data.datasets.forEach((dataset) => {
                        dataset = data_set;
                    });
                    

                    myChart3.update();

                    }

          

           


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });

}



});

$(document).on("change", "#marca-filter-seccion2", function () {

jQuery.noConflict();
console.log("Cambio MARCA SECCION 1")
var marca = jQuery(this).val();
if(marca != ""){

   let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-redes-sociales') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   tipo: 3,
                   marca: marca,
               },
               success: function (data) {
                loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var data_set = [];

                   var cnt = 0;

        
                    jQuery.each(response.sentimiento_data_seccion2, function(i, item) {

                        <?php $cnt = 0; ?>
                        data_set += '{'+
                        'label: '+response.sentimiento_data_seccion2[i].name+','+
                        'barPercentage: 0.5,'+
                        'barThickness: 6,'+
                        'maxBarThickness: 8,'+
                        'minBarLength: 2,'+
                        'backgroundColor: {{$data["colores2"][$cnt]}},'+
                        'data: '+response.dataset_seccion2[response.sentimiento_data_seccion2[i].name]+'},'+
                    '}'

                            <?php $cnt++; ?>
                        });
                


                        //console.log(data_set)
                   if ($("#analisis-sentimiento-chart").length) {

                    myChart4.data.labels = response.labels_seccion2;
                 
                    myChart4.data.datasets.forEach((dataset) => {
                        dataset = data_set;
                    });
                    

                    myChart4.update();

                    }

          

           

               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });



}



});
$(document).on("change", "#marca-filter-seccion3", function () {

jQuery.noConflict();
console.log("Cambio MARCA SECCION 3")
var marca = jQuery(this).val();
if(marca != ""){

    let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-redes-sociales') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   tipo: 4,
                   marca: marca,
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var data_set = [];
               
            
                   jQuery.each(response.grafico3_data, function(i, item) {


                        data_set += '{'+
                        'label: "'+item.marca+'",'+
                        'data: ['+response.grafico3_dataset[item.marca]+'],'+
                        'borderWidth: 2,'+
                        'borderColor: "{{$data['colores'][$key ?? 0]}}",'+
                        'backgroundColor: "transparent",'+
                        'pointBorderColor: "transparent",'+
                        'tension: 0.4'+
                        '},';


                        });
                   
                     
                    
                   if (jQuery("#menciones-totales-chart").length) {

                    myChart1.data.labels = response.grafico3_labels;
                    myChart1.data.datasets[0].label = marca;
                 
                    myChart1.data.datasets.forEach((dataset) => {

                        
                        dataset = [data_set];
                    });

                   
                    // myChart4.data.datasets.forEach((dataset) => {
                    //     dataset = data_set;
                    // });
                    

                    myChart1.update();

               

                    }

          

           


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });

//location.href = "https://sim-ep.com/usuario/redes-sociales?marca_seccion3="+marca;

}



});
$(document).on("change", "#informes-filtro-year", function () {

jQuery.noConflict();
console.log("Cambio MARCA SECCION 3")
var ano = jQuery(this).val();
if(ano != ""){

    let loader = document.querySelector('.loader')
   
    loader.style.visibility = 'visible';
    jQuery.ajax({
                type: 'POST',
                url: "{{ url('usuario/filtro-redes-sociales') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    tipo: 1,
                    ano: ano,
                },
                success: function (data) {
                    loader.style.visibility = 'hidden';
                    response = JSON.parse(data);

                    var element = "";
                    jQuery.each(response, function(i, item) {
                            console.log(response[i].id);
                            var isPowerBiLink = response[i].url && response[i].url.includes('app.powerbi.com');
                            var fileUrl = response[i].url ? (isPowerBiLink ? response[i].url : response[i].url.replace('https://sim-ep.com', '').trim()) : '';
                           element += '<tr class="intro-x">'+
                                '<td class="text-center">'+response[i].name+'</td>'+
                                '<td class="text-center">'+response[i].periodo+'</td>'+
                                '<td class="text-center">'+response[i].descripcion+'</td>'+
                                '<td class="text-center">'+response[i].frecuencia+'</td>'+
                                '<td class="table-report__action w-56">'+
                                    '<div class="flex justify-center items-center">'+
                                    '<a class="btn btn-primary py-3 px-4  h-8 xl:w-32 xl:mr-3 mr-3r mr-3 ' + (isPowerBiLink ? 'power-viewer' : 'pdf-viewer') + '" data-file="' + fileUrl + '" href="javascript:;">'+
                            'Ver'+
                        '</a>'+
                                    '</div>'+
                                '</td>'+
                           ' </tr>';
                    });


                    jQuery("#datatable-elements").html(element, function(){
                                    jQuery('#table-data').DataTable({
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
$(document).on("change", "#marca-filter-seccion4", function () {

jQuery.noConflict();
console.log("Cambio MARCA SECCION 4")
var marca = jQuery(this).val();
if(marca != ""){

    let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-redes-sociales') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   tipo: 5,
                   marca: marca,
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var data_set = [];
               
            
                   jQuery.each(response.grafico4_data, function(i, item) {


                        data_set += '{'+
                        'label: "'+item.marca+'",'+
                        'data: ['+response.grafico4_dataset[item.marca]+'],'+
                        'borderWidth: 2,'+
                        'borderColor: "{{$data['colores'][$key ?? 0]}}",'+
                        'backgroundColor: "transparent",'+
                        'pointBorderColor: "transparent",'+
                        'tension: 0.4'+
                        '},';


                        });
                   
                     
                    
                   if (jQuery("#menciones-totales-chart").length) {

                    myChart2.data.labels = response.grafico4_labels;
                    myChart2.data.datasets[0].label = marca;
                 
                    myChart2.data.datasets.forEach((dataset) => {

                        
                        dataset = [data_set];
                    });

                   
                    // myChart4.data.datasets.forEach((dataset) => {
                    //     dataset = data_set;
                    // });
                    

                    myChart2.update();

               

                    }

          

           


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });

//location.href = "https://sim-ep.com/usuario/redes-sociales?marca_seccion3="+marca;

}



});


</script>
@endsection