@extends('../layout/' . $layout)

@section('subhead')
<title>Reportes AdHoc - Usuario - SIMEP</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 md:col-span-12 mt-8">
                <div class="intro-y items-center ">
                    <h2 class="text-xl font-bold truncate mr-5 w-full title-section">Reportes AdHoc</h2>


                    <div class=" mt-8">
                    <div class="px-2">
                        <div class="h-full  rounded-md">
                          
                            <p>Informes con resultados de estudios de mercado cualitativos y cuantitativos, que responden a necesidades de información específicas solicitadas por cada uno de los Negocios de Empresas Polar.</p>
                        </div>
                    </div>
                    
                   
                </div>

                </div>



                <ul class="nav nav-boxed-tabs mt-8 overflow-auto" role="tablist">
                    <li id="example-3-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2 active" data-tw-toggle="pill"
                            data-tw-target="#example-tab-3" type="button" role="tab" aria-controls="example-tab-3"
                            aria-selected="true">
                            Categoria - Marca
                        </button>
                    </li>
                    <li id="example-5-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-5"
                            type="button" role="tab" aria-controls="example-tab-5" aria-selected="false">
                            Cliente - Canal
                        </button>
                    </li>
                   
                </ul>
                <div class="tab-content mt-5">
                    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel"
                        aria-labelledby="example-3-tab">
                        <div class="col-span-12 box p-5 md:col-span-12 mt-8">

                            <div class="col-span-12 lg:col-span-12">
                                <div class="intro-y block sm:flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">Informes año en curso más últimos 2 años </h2>
                                </div>
                            </div>
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                                <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
                                    <select id="filter-categoria" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-3 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option value="">Categoria</option>
                                        @if(count($data['list_data_categorias']) > 0)
                            @foreach($data['list_data_categorias'] as $key => $value)

                            <option  value="{{$value->nombre_tipo}}">{{ucfirst($value->nombre_tipo)}}</option>
                            @endforeach
                            @endif
                                    </select>
                                    <select id="filter-marca" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-3 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option value="">Marca</option>
                                        @if(count($data['list_data_marcas']) > 0)
                            @foreach($data['list_data_marcas'] as $key => $value)
                            @if($value->nombre_tipo_2 != "")

                            <option  value="{{$value->nombre_tipo_2}}">{{ucfirst($value->nombre_tipo_2)}}</option>
                            @endif
                            @endforeach
                            @endif
                                    </select>
                                    <select id="year-filter-categoria" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-3 xl:col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option value="">Año</option>
                                        @if(count($data['year_list_categorias']) > 0)
                            @foreach($data['year_list_categorias'] as $key => $value)

                            <option  value="{{$value->ano}}">{{$value->ano}}</option>
                            @endforeach
                            @endif
                                    </select>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="table table-report mt-4 col-span-6" id="table-categoria">
                                        <thead>
                                            <tr>
                                                <th class="text-center whitespace-nowrap">Año</th>
                                                <th class="text-center whitespace-nowrap">Categoria</th>
                                                <th class="text-center whitespace-nowrap">Marca</th>
                                                <th class="text-center whitespace-nowrap">Nombre</th>
                                                <th class="text-center whitespace-nowrap">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="categoria-content-1">
    
                            @if(count($data['data_categorias']) > 0)
                                @foreach($data['data_categorias'] as $key => $value)
                                <tr class="intro-x">
                                    <td class="text-center">{{$value->ano}}</td>
                                    <td class="text-center">{{$value->nombre_tipo}}</td>
                                    <td class="text-center">@if($value->nombre_tipo_2 != ""){{$value->nombre_tipo_2}}@endif</td>
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

                                <div class="intro-y block sm:flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">Historico Estudios de Investigación de
                                        Mercado</h2>
                                </div>
                                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                                    <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
                                        <select id="filter-categoria-old" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-3 xl:col-span-3"
                                            aria-label=".form-select-lg example">
                                            <option value="">Categoria</option>
                                            @if(count($data['list_data_categorias_old']) > 0)
                            @foreach($data['list_data_categorias_old'] as $key => $value)

                            <option  value="{{$value->nombre_tipo}}">{{ucfirst($value->nombre_tipo)}}</option>
                            @endforeach
                            @endif
                                        </select>
                                        <select id="filter-marca-old" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-3 xl:col-span-3"
                                            aria-label=".form-select-lg example">
                                            <option value="">Marca</option>
                                            @if(count($data['list_data_marcas_old']) > 0)
                            @foreach($data['list_data_marcas_old'] as $key => $value)
                            @if($value->nombre_tipo_2 != "")
                            <option  value="{{$value->nombre_tipo_2}}">{{ucfirst($value->nombre_tipo_2)}}</option>
                            @endif
                            @endforeach
                            @endif
                                        </select>
                                        <select id="filter-year-old" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-6 sm:col-span-3 xl:col-span-3"
                                            aria-label=".form-select-lg example">
                                            <option value="">Año</option>
                                            @if(count($data['year_list_categorias_old']) > 0)
                            @foreach($data['year_list_categorias_old'] as $key => $value)

                            <option  value="{{$value->ano}}">{{$value->ano}}</option>
                            @endforeach
                            @endif
                                        </select>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="table table-report mt-4 col-span-6" id="table-categorias-old">
                                            <thead>
                                                <tr>
                                                    <th class="text-center whitespace-nowrap">Año</th>
                                                    <th class="text-center whitespace-nowrap">Categoria</th>
                                                    <th class="text-center whitespace-nowrap">Marca</th>
                                                    <th class="text-center whitespace-nowrap">Nombre</th>
                                                    <th class="text-center whitespace-nowrap">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                            @if(count($data['data_categorias_old']) > 0)
                                @foreach($data['data_categorias_old'] as $key => $value)
                                <tr class="intro-x">
                                    <td class="text-center">{{$value->ano}}</td>
                                    <td class="text-center">{{$value->nombre_tipo}}</td>
                                    <td class="text-center">@if($value->nombre_tipo_2 != ""){{$value->nombre_tipo_2}}@endif</td>
                                    <td class="text-center">{{$value->name}}</td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                            <a class="btn btn-primary py-3 px-4 h-8 xl:w-32 xl:mr-3 mr-3r mr-3 pdf-solicitud" data-ano="{{$value->ano}}" data-name="{{$value->name}}" data-categoria="{{$value->nombre_tipo}}" data-file="{{$value->archivo}}" href="javascript:;">
                                                Solicitar
                                            </a>
    
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

                    <div id="example-tab-5" class="tab-pane leading-relaxed " role="tabpanel"
                        aria-labelledby="example-3-tab">
                        <div class="col-span-12 box p-5 md:col-span-12 mt-8">

                            <div class="col-span-12 lg:col-span-12 ">
                                <div class="intro-y block sm:flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">Informes año en curso más últimos 2 años </h2>
                                </div>
                            </div>
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                                <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
                                    <select id="filter-cliente" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option value="">Cliente</option>
                                        @if(count($data['list_data_cliente']) > 0)
                            @foreach($data['list_data_cliente'] as $key => $value)

                            <option  value="{{$value->nombre_tipo}}">{{ucfirst($value->nombre_tipo)}}</option>
                            @endforeach
                            @endif
                                    </select>
                                    <select id="filter-canal" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-3 "
                                        aria-label=".form-select-lg example">
                                        <option value="">Canal</option>
                                        @if(count($data['list_data_canal']) > 0)
                            @foreach($data['list_data_canal'] as $key => $value)

                            <option  value="{{$value->nombre_tipo}}">{{ucfirst($value->nombre_tipo)}}</option>
                            @endforeach
                            @endif
                                    </select>
                                    <select id="year-filter-cliente" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-3"
                                        aria-label=".form-select-lg example">
                                        <option value="">Año</option>
                                        @if(count($data['year_list_cliente']) > 0)
                            @foreach($data['year_list_cliente'] as $key => $value)

                            <option  value="{{$value->ano}}">{{$value->ano}}</option>
                            @endforeach
                            @endif
                                    </select>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="table table-report mt-4 col-span-6" id="table-cliente">
                                        <thead>
                                            <tr>
                                                <th class="text-center whitespace-nowrap">Año</th>
                                                <th class="text-center whitespace-nowrap">Cliente/Canal</th>
                                                <th class="text-center whitespace-nowrap">Nombre</th>
                                                <th class="text-center whitespace-nowrap">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    
                            @if(count($data['data_cliente']) > 0)
                                @foreach($data['data_cliente'] as $key => $value)
                                <tr class="intro-x">
                                    <td class="text-center">{{$value->ano}}</td>
                                    <td class="text-center">{{$value->nombre_tipo}}</td>
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

                                <div class="intro-y block sm:flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">Historico Estudios de Investigación de
                                        Mercado</h2>
                                </div>
                                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                                    <div class="grid grid-cols-12 gap-2 mt-4 mb-4">
                                        <select id="filter-cliente-old" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-3"
                                            aria-label=".form-select-lg example">
                                            <option value="">Cliente</option>
                                            @if(count($data['list_data_cliente_old']) > 0)
                            @foreach($data['list_data_cliente_old'] as $key => $value)

                            <option  value="{{$value->nombre_tipo}}">{{ucfirst($value->nombre_tipo)}}</option>
                            @endforeach
                            @endif
                                        </select>
                                        <select   id="filter-canal-old" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-3"
                                            aria-label=".form-select-lg example">
                                            <option value="">Canal</option>
                                            @if(count($data['list_data_canal_old']) > 0)
                            @foreach($data['list_data_canal_old'] as $key => $value)

                            <option  value="{{$value->nombre_tipo}}">{{ucfirst($value->nombre_tipo)}}</option>
                            @endforeach
                            @endif
                                        </select>
                                        <select id="year-filter-cliente-old" class="form-select form-select-lg sm:mt-2 sm:mr-2 col-span-3"
                                            aria-label=".form-select-lg example">
                                            <option value="">Año</option>
                                            @if(count($data['year_list_cliente_old']) > 0)
                            @foreach($data['year_list_cliente_old'] as $key => $value)

                            <option  value="{{$value->ano}}">{{$value->ano}}</option>
                            @endforeach
                            @endif
                                        </select>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="table table-report mt-4 col-span-6" id="table-cliente-old">
                                            <thead>
                                                <tr>
                                                    <th class="text-center whitespace-nowrap">Año</th>
                                                    <th class="text-center whitespace-nowrap">Cliente/Canal</th>
                                                    
                                                    <th class="text-center whitespace-nowrap">Nombre</th>
                                                    <th class="text-center whitespace-nowrap">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                            @if(count($data['data_cliente_old']) > 0)
                                @foreach($data['data_cliente_old'] as $key => $value)
                                <tr class="intro-x">
                                    <td class="text-center">{{$value->ano}}</td>
                                    <td class="text-center">{{$value->nombre_tipo}}</td>
                                    <td class="text-center">{{$value->name}}</td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                            <a class="btn btn-primary py-3 px-4  h-8 xl:w-32 xl:mr-3 mr-3r mr-3 pdf-solicitud" data-ano="{{$value->ano}}" data-name="{{$value->name}}" data-categoria="{{$value->nombre_tipo}}" data-file="{{$value->archivo}}" href="javascript:;">
                                                Solicitar
                                            </a>
    
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



            </div>
        </div>
    </div>
</div>


<div id="pdf-viewer-modal" class="modal pdf-viewer-modal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
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



<div id="pdf-solicitud" class="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="solicitud-form">
            @csrf
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Solicitud de Información</h2>

            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 sm:col-span-12">
                    <label for="modal-form-1" class="form-label">De</label>
                    <input type="text" name="from" class="form-control" readonly
                        value="{{ Auth::user()->name }} {{ Auth::user()->lname }}">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="modal-form-2" class="form-label">Pais</label>
                    <input  type="text" name="pais" class="form-control" readonly
                        value="{{ $data['pais']->name }}">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="modal-form-3" class="form-label">Categoria</label>
                    <input type="text" name="categoria" id="categoria-input" class="form-control"
                        value="Estudios Ad Hoc" readonly placeholder="Categoria">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="modal-form-4" class="form-label">Año</label>
                    <input  type="text" name="ano" id="ano-input" class="form-control" value="2022" readonly
                        placeholder="Año">
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <label for="modal-form-5" class="form-label">Nombre Estudio</label>
                    <input  type="text" name="name" id="name-input" class="form-control" value="Nombre Estudio"
                        readonly placeholder="Nombre Estudio">
                </div>
                <div class="col-span-12 sm:col-span-21">
                    <label for="modal-form-5" class="form-label">Correo Solicitante</label>
                    <input  type="text" name="email" class="form-control" readonly
                        value="{{ Auth::user()->email }}">
                </div>
                <div class="col-span-12 sm:col-span-21">
                    <label for="modal-form-5" class="form-label">Observaciones</label>
                    <textarea class="form-control" name="observaciones" id="" cols="30" rows="10"
                        placeholder="Observaciones"></textarea>

                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal"
                    class="btn btn-outline-secondary w-20 mr-1">Cancelar</button>
                <button type="submit" class="btn btn-primary w-20">Enviar</button>
            </div>
            <!-- END: Modal Footer -->
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

function encodeURLNFD(str) {
    // Normalize the string to NFD
    let normalizedStr = str.normalize('NFC');

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
function encodeURL2(str) {
     return encodeURIComponent(str).replace(/%2F/g, '/').replace(/%20/g, ' ');
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
        console.log("test")
        var file = jQuery(this).attr("data-file");
        var url = encodeURL2(file);
       
        //var url = "/storage/pdfs/Adhoc/Proy. Donald. Evaluación de precio de HPM P.A.N. mezcla maíz-arroz (Conjoint).pdf";
        console.log(url);
        if(file != undefined){

            $("#file-url").val(url);

        }else{

            url = $("#file-url").val();


        }
        
        // jQuery("#iframe-file").attr("src", url);



        console.log(url);
        loadPDF(url);
        
       
        
        var isChrome = navigator.userAgent.toLowerCase().indexOf("chrome") >= 0 ? true : false;

        if(isChrome){
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
  





        const myModal = tailwind.Modal.getInstance(document.querySelector("#pdf-viewer-modal"));
        myModal.show();

    });

    function loadPDF(url){

        let loader = document.querySelector('.loader-pdf')
        loader.style.visibility = 'visible';
        pageNum = 1
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






            pdfjsLib.getDocument(url).promise
            .then(function (pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page_count').textContent = pdfDoc.numPages;

            loader.style.visibility = 'hidden';
            console.log("Termino de Cargar")
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

        $(document).on("click", "#prev", function () {

            onPrevPage();

        });

        $(document).on("click", "#next", function () {

            onNextPage();

        });




    $(document).on("click", ".pdf-solicitud", function () {

        console.log("Abrir Modal");

        var estudio = $(this).attr("data-name");
        var ano = $(this).attr("data-ano");
        var categoria = $(this).attr("data-categoria");

        console.log(estudio)


        $("#categoria-input").val(categoria);
        $("#ano-input").val(ano);
        $("#name-input").val(estudio);

        const myModal = tailwind.Modal.getInstance(document.querySelector("#pdf-solicitud"));
        myModal.show();
        var isChrome = navigator.userAgent.toLowerCase().indexOf("chrome") >= 0 ? true : false;

        if(isChrome){
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

    });

var table_categoria;
$(document).ready( function () {
    jQuery.noConflict();
    table_categoria = jQuery('#table-categoria').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });

    jQuery('#table-categorias-old').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });


    jQuery('#table-marcas').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });

    jQuery('#table-marcas-old').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });

    jQuery('#table-cliente').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });

    jQuery('#table-cliente-old').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });

    jQuery('#table-canal').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });

    jQuery('#table-canal-old').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    });
} );



$(document).on("change", "#filter-categoria, #filter-marca, #year-filter-categoria", function () {

jQuery.noConflict();
console.log("Cambio Año")
var ano = jQuery("#year-filter-categoria").val();
var categoria = jQuery("#filter-categoria").val();
var marca = jQuery("#filter-marca").val();

console.log(categoria)

    let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-adhoc-marca-categoria-1') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   ano: ano,
                   categoria: categoria,
                   marca: marca,
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var element = "";
                   jQuery.each(response, function(i, item) {
                           console.log(response[i].id);
                           var isPowerBiLink = response[i].url && response[i].url.includes('app.powerbi.com');
                            var fileUrl = response[i].url ? (isPowerBiLink ? response[i].url : response[i].url.replace('https://sim-ep.com', '').trim()) : '';
                           var nombre_tipo_2 = "";
                           if(response[i].nombre_tipo_2 != null){

                            nombre_tipo_2 = response[i].nombre_tipo_2;

                           }


                          element += '<tr class="intro-x">'+
                               '<td class="text-center">'+response[i].ano+'</td>'+
                               '<td class="text-center">'+response[i].nombre_tipo+'</td>'+
                               '<td class="text-center">'+nombre_tipo_2+'</td>'+
                               '<td class="text-center">'+response[i].name+'</td>'+
                               '<td class="table-report__action w-56">'+
                                   '<div class="flex justify-center items-center">'+
                                   '<a class="btn btn-primary py-3 px-4  h-8 xl:w-32 xl:mr-3 mr-3r mr-3 ' + (isPowerBiLink ? 'power-viewer' : 'pdf-viewer') + '" data-file="' + fileUrl + '" href="javascript:;">'+
                            'Ver'+
                        '</a>'+
                                   '</div>'+
                               '</td>'+
                          ' </tr>';
                   });

             
     
                    jQuery('#table-categoria').DataTable().destroy();
                    jQuery('#table-categoria').find('tbody').html("");
                    jQuery('#table-categoria').find('tbody').append(element);
                    jQuery('#table-categoria').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    }).draw();
           
                   


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });





});


$(document).on("change", "#filter-categoria-old, #filter-marca-old, #filter-year-old", function () {

jQuery.noConflict();
console.log("Cambio Año")
var ano = jQuery("#filter-year-old").val();
var categoria = jQuery("#filter-categoria-old").val();
var marca = jQuery("#filter-marca-old").val();

console.log(categoria)

let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-adhoc-marca-categoria-2') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   ano: ano,
                   categoria: categoria,
                   marca: marca,
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var element = "";
                   jQuery.each(response, function(i, item) {
                           console.log(response[i].id);

                           var nombre_tipo_2 = "";
                           if(response[i].nombre_tipo_2 != null){

                            nombre_tipo_2 = response[i].nombre_tipo_2;

                           }


                          element += '<tr class="intro-x">'+
                               '<td class="text-center">'+response[i].ano+'</td>'+
                               '<td class="text-center">'+response[i].nombre_tipo+'</td>'+
                               '<td class="text-center">'+nombre_tipo_2+'</td>'+
                               '<td class="text-center">'+response[i].name+'</td>'+
                               '<td class="table-report__action w-56">'+
                                   '<div class="flex justify-center items-center">'+
                                   '<a class="btn btn-primary py-3 px-4  h-8 xl:w-32 xl:mr-3 mr-3r mr-3 pdf-solicitud" data-ano="'+response[i].ano+'" data-name="'+response[i].name+'" data-categoria="'+response[i].nombre_tipo+'" data-file="'+response[i].archivo+'" href="javascript:;">'+
                                           'Solicitar'+
                                       '</a>'+
                                   '</div>'+
                               '</td>'+
                          ' </tr>';
                   });

             
     
                    jQuery('#table-categorias-old').DataTable().destroy();
                    jQuery('#table-categorias-old').find('tbody').html("");
                    jQuery('#table-categorias-old').find('tbody').append(element);
                    jQuery('#table-categorias-old').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    }).draw();
           
                   


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });





});





$(document).on("change", "#filter-cliente, #filter-canal, #year-filter-cliente", function () {

jQuery.noConflict();
console.log("Cambio Año")
var ano = jQuery("#year-filter-cliente").val();
var cliente = jQuery("#filter-cliente").val();
var canal = jQuery("#filter-canal").val();

console.log(categoria)

let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-adhoc-cliente-1') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   ano: ano,
                   cliente: cliente,
                   canal: canal,
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
                               '<td class="text-center">'+response[i].ano+'</td>'+
                               '<td class="text-center">'+response[i].nombre_tipo+'</td>'+
                               '<td class="text-center">'+response[i].name+'</td>'+
                               '<td class="table-report__action w-56">'+
                                   '<div class="flex justify-center items-center">'+
                                   '<a class="btn btn-primary py-3 px-4  h-8 xl:w-32 xl:mr-3 mr-3r mr-3 ' + (isPowerBiLink ? 'power-viewer' : 'pdf-viewer') + '" data-file="' + fileUrl + '" href="javascript:;">'+
                            'Ver'+
                        '</a>'+
                                   '</div>'+
                               '</td>'+
                          ' </tr>';
                   });

             
     
                    jQuery('#table-cliente').DataTable().destroy();
                    jQuery('#table-cliente').find('tbody').html("");
                    jQuery('#table-cliente').find('tbody').append(element);
                    jQuery('#table-cliente').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    }).draw();
           
                   


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });





});


$(document).on("change", "#filter-cliente-old, #filter-canal-old, #year-filter-cliente-old", function () {

jQuery.noConflict();
console.log("Cambio Año")
var ano = jQuery("#year-filter-cliente-old").val();
var cliente = jQuery("#filter-cliente-old").val();
var canal = jQuery("#filter-canal-old").val();

console.log(categoria)

let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-adhoc-cliente-2') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   ano: ano,
                   cliente: cliente,
                   canal: canal,
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   var element = "";
                   jQuery.each(response, function(i, item) {
                           console.log(response[i].id);
                          element += '<tr class="intro-x">'+
                               '<td class="text-center">'+response[i].ano+'</td>'+
                               '<td class="text-center">'+response[i].nombre_tipo+'</td>'+
                               '<td class="text-center">'+response[i].name+'</td>'+
                               '<td class="table-report__action w-56">'+
                                   '<div class="flex justify-center items-center">'+
                                       '<a class="btn btn-primary py-3 px-4  h-8 xl:w-32 xl:mr-3 mr-3r mr-3 pdf-solicitud" data-ano="'+response[i].ano+'" data-name="'+response[i].name+'" data-categoria="'+response[i].nombre_tipo+'" data-file="'+response[i].archivo+'" href="javascript:;">'+
                                           'Solicitar'+
                                       '</a>'+
                                   '</div>'+
                               '</td>'+
                          ' </tr>';
                   });

             
     
                    jQuery('#table-cliente-old').DataTable().destroy();
                    jQuery('#table-cliente-old').find('tbody').html("");
                    jQuery('#table-cliente-old').find('tbody').append(element);
                    jQuery('#table-cliente-old').DataTable({
    "aaSorting": [[ 0, "asc" ]],
    "pageLength": 25
    }).draw();
           
                   


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });





});






















            $(document).on("submit", "#solicitud-form", function(e){

                e.preventDefault();
               
            
            jQuery.noConflict();
            jQuery.ajax({
            url: "{{ url('usuario/send-request') }}",
            method:'post',
            data:jQuery( this ).serialize(),
            success: function(result){

                const myModal = tailwind.Modal.getInstance(document.querySelector("#pdf-solicitud"));
                myModal.hide();
                
                if(result == 1){

                    Swal.fire({
                        icon: 'success',
                        title: 'Procesado',
                        text: 'Su Solicitud esta siendo procesada, en un máximo de 24hrs recibirá la información.'
                    })


                }else if(result == 0){

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo procesar la solicitud'
                    })

                }
            
        }});







            })

</script>


@endsection
