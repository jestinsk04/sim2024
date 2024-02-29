@extends('../layout/' . $layout)

@section('subhead')
<title>Análisis Global - Usuario - SIMEP</title>

@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 md:col-span-12 mt-8">
                <div class="intro-y items-center ">
                    <h2 class="text-xl font-bold truncate mr-5 w-full title-section">Análisis Global</h2>

                    <div class=" mt-8">
                    <div class="px-2">
                        <div class="h-full  rounded-md">
                          
                            <p>Sección que contiene los Análisis de mercado e informes que son trasversales; es decir que involucra a diferentes países.</p>
                        </div>
                    </div>
                    
                   
                </div>
                </div>



            </div>

            <div class="col-span-12 md:col-span-12">

               
                <div class="intro-y box p-5 col-span-12 overflow-auto lg:overflow-visible">

                    <div class="grid grid-cols-12 gap-2 mb-4">

                        <select id="year-filter" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-12 sm:col-span-3 xl:col-span-3"
                            aria-label=".form-select-lg example">
                            <option value="">Año</option>
                            @if(count($data['year_list']) > 0)
                            @foreach($data['year_list'] as $key => $value)

                            <option value="{{$value->year}}">{{$value->year}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <table class="table table-report mt-4 col-span-6" id="datatable">
                        <thead>
                            <tr>
                                <th class="text-center whitespace-nowrap">Nombre</th>
                                <th class="text-center whitespace-nowrap">Año</th>
                                <th class="text-center whitespace-nowrap">Descripcion</th>
                                <th class="text-center whitespace-nowrap">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="datatable-elements">

                        @if(count($data['data']) > 0)
                            @foreach($data['data'] as $key => $value)
                            <tr class="intro-x">
                                <td class="text-center">{{$value->name}}</td>
                                <td class="text-center">{{$value->year}}</td>
                                <td class="text-center">{{$value->description}}</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js" integrity="sha512-j+F4W//4Pu39at5I8HC8q2l1BNz4OF3ju39HyWeqKQagW6ww3ZF9gFcu8rzUbyTDY7gEo/vqqzGte0UPpo65QQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
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
        window.scrollTo({ top: 0, behavior: 'smooth' });
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

    $(document).ready( function () {
    jQuery.noConflict();
    jQuery('#datatable').DataTable({
    "aaSorting": [[ 1, "asc" ]],
    "pageLength": 25
    });
} );

$(document).on("change", "#year-filter", function () {

jQuery.noConflict();
console.log("Cambio Año")
var ano = jQuery(this).val();
if(ano != ""){

    let loader = document.querySelector('.loader')
   
    loader.style.visibility = 'visible';
    jQuery.ajax({
                type: 'POST',
                url: "{{ url('usuario/filtro-analisis-global') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    ano: ano
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
                                '<td class="text-center">'+response[i].year+'</td>'+
                                '<td class="text-center">'+response[i].description+'</td>'+
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
                                    jQuery('#datatable').DataTable({
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

</script>


@endsection
