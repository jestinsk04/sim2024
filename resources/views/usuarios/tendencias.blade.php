@extends('../layout/' . $layout)

@section('subhead')
<title>Tendencias - Usuario - SIMEP</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 md:col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                <h2 class="text-xl font-bold truncate mr-5 title-section">Tendencias</h2>

                </div>
            </div>


            <div class="col-span-12 ">
                <div class=" mt-8">
                    <div class=" px-2">
                        <div class="h-full  rounded-md">
                            
                            <p>Información generalizada de las tendencias actuales en el mercado. </p>
                        </div>
                    </div>
                    
                   
                </div>
            </div>

            @if(count($data['tendencias']) > 0)
                            @foreach($data['tendencias'] as $key => $value)

               <div class="col-span-12 sm:col-span-4 xl:col-span-3  temario " style="position:relative;">
                <span style="display: block; line-height: 50px; text-align: center; color: #fff; position: absolute; right: 10px; z-index: 999;width: 50px; height: 50px; background-color: #F21636; border-radius: 50px;">Nuevo</span>
                <div class="grid grid-cols-3 intro-y box p-5 mt-12 sm:mt-5 h-auto">
                    <div class="col-span-6 flex flex-col md:flex-row border-temario">
                        <div class="flex w-full">
                            <div class="intro-y block  items-center h-auto w-full">
                                <h2 class="text-lg font-medium truncate mr-5 w-full mt-4">{{$value->name}}</h2>
                                <h2 class="text-lg font-light truncate mr-5 w-full mt-2">{{$value->categoria}} - {{$value->fuente}} <small class="float-right">{{$value->ano}}</small></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-12">
                    
                        <div class="intro-y block  items-center h-auto w-full mt-4">
                                {{$value->descripcion_detallada}}
                        
                        </div>
                        
                    </div>
                </div>
                <div class="intro-y block  items-center h-auto mt-6">
                    <button class="btn btn-primary py-3 px-4 w-full xl:w-full xl:mr-3 align-top pdf-viewer" data-file="{{trim(str_replace('https://sim-ep.com', '', $value->url))}}">Leer más</button>
                </div>
            </div>


                            @endforeach
            @endif





      

            <div class="col-span-12 md:col-span-12 box p-5 mt-8">
                <div class="intro-y block items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5 w-full">Informes</h2>
                    <h2 class="text-base font-light truncate mr-5 w-full mt-2">Tendencias de mercado</h2>

                </div>
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-8">
                    <div class="overflow-x-auto">
                        <table class="table table-report mt-4" id="table-data">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">Informe</th>
                                    <th class="whitespace-nowrap">Descripcion</th>
                                    <th class="text-center whitespace-nowrap">Fecha</th>
                                    <th class="text-center whitespace-nowrap">Fuente</th>
                                    <th class="text-center whitespace-nowrap">Categoria</th>
                                    
                                    <th class="text-center whitespace-nowrap">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
    
                            @if(count($data['tendencias_full']) > 0)
                                @foreach($data['tendencias_full'] as $key => $value)
                                <tr class="intro-x">
                                    <td class="text-center">{{$value->name}}</td>
                                    <td class="text-center">{{$value->descripcion}}</td>
                                    <td class="text-center">{{$value->fecha}}</td>
                                    <td class="text-center">{{$value->fuente}}</td>
                                    <td class="text-center">{{$value->categoria}}</td>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"
    integrity="sha512-j+F4W//4Pu39at5I8HC8q2l1BNz4OF3ju39HyWeqKQagW6ww3ZF9gFcu8rzUbyTDY7gEo/vqqzGte0UPpo65QQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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


    $(document).ready( function () {
    jQuery.noConflict();
    jQuery('#table-data').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });


} );
</script>
@endsection
