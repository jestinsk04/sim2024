@extends('../layout/base-yellow')

@section('body')
    <body class="p-5" style="background:url(https://sigaim.aeriousport.com/build/assets/images/img_maiz_bck.jpg)!important">
        @yield('content')


        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        @vite('resources/js/app.js')
        <script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <!-- END: JS Assets-->
        <style>
           body{
            font-family: 'Montserrat', sans-serif;
            background-color: #025091;
        }
            html .btn-primary {
background: #ED6C1C!important;
border-radius:26px !important;
color:#025091;
font-family: 'Montserrat', sans-serif;
border: none;

}
.content {
background-color:#fff!important;
}
        .title-section{
    font-weight:900 !important;
    font-size:2rem !important;
    line-height: 2.5rem;

    }
.font-montserrat{
        font-family: 'Montserrat', sans-serif !important;
      }
      p{
        font-family: 'Montserrat', sans-serif !important;
      }
      span{
        font-family: 'Montserrat', sans-serif !important;
      }
      a{
        font-family: 'Montserrat', sans-serif !important;
      }
      li{
        font-family: 'Montserrat', sans-serif !important;
      }
      .top-bar .breadcrumb {
        font-weight:bold;
      }
      h1,h2,h3,h4,h5,h6{
        font-family: 'Montserrat', sans-serif !important;
      }
            .clear-layout {
                background-color: #025091 !important;

            }
            .md\:col-span-8 {
                grid-column:span 8 / span 8
        }
        .sm\:col-span-8 {
                grid-column:span 8 / span 8
        }
  
        div.dataTables_wrapper div.dataTables_paginate {
width: 100%;
}
            .side-nav .logo-container:after {
                margin-top: 65px !important;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='259.51' height='259.52' viewBox='0 0 259.51 259.52'%3E%3Cpath id='Path_143' data-name='Path 143' d='M8659.507,423.965c-.167-2.608.05-5.319-.19-8.211-.084-1.012-.031-2.15-.118-3.12-.113-1.25-.1-2.682-.236-4.061-.172-1.722-.179-3.757-.365-5.394-.328-2.889-.478-5.857-.854-8.61-.509-3.714-.825-7.252-1.38-10.543-.934-5.535-2.009-11.312-3.189-16.692-.855-3.9-1.772-7.416-2.752-11.2-1.1-4.256-2.394-8.149-3.687-12.381-1.1-3.615-2.366-6.893-3.623-10.493-1.3-3.739-2.917-7.26-4.284-10.7-1.708-4.295-3.674-8.078-5.485-12.023-1.145-2.493-2.5-4.932-3.727-7.387-1.318-2.646-2.9-5.214-4.152-7.518-1.716-3.16-3.517-5.946-5.274-8.873-1.692-2.818-3.589-5.645-5.355-8.334-2.326-3.542-4.637-6.581-7.039-9.848-2.064-2.809-4.017-5.255-6.088-7.828-2.394-2.974-4.937-5.936-7.292-8.589-3.027-3.411-6.049-6.744-9.055-9.763-2.4-2.412-4.776-4.822-7.108-6.975-3-2.767-5.836-5.471-8.692-7.854-3.332-2.779-6.657-5.663-9.815-8.028-2.958-2.216-5.784-4.613-8.7-6.6-3.161-2.159-6.251-4.414-9.219-6.254-3.814-2.365-7.533-4.882-11.168-6.89-4.213-2.327-8.513-4.909-12.478-6.834-4.61-2.239-9.234-4.619-13.51-6.416-4.1-1.725-8.11-3.505-11.874-4.888-4.5-1.652-8.506-3.191-12.584-4.47-6.045-1.9-12.071-3.678-17.431-5-9.228-2.284-17.608-3.757-24.951-4.9-7.123-1.112-13.437-1.64-18.271-2.035l-2.405-.2c-1.638-.136-3.508-.237-4.633-.3a115.051,115.051,0,0,0-12.526-.227h259.51Z' transform='translate(-8399.997 -164.445)' fill='%23FFFFFF'/%3E%3C/svg%3E%0A") !important;
            }
            .side-nav>ul>li>.side-menu.side-menu--active .side-menu__icon:before {

                background-color:#ED6C1C !important;

            }
            .side-nav>ul>li>.side-menu.side-menu--active {

                background-color:#ED6C1C !important;
            }
            .side-nav>ul>li>.side-menu.side-menu--active:before {

                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='259.51' height='259.52' viewBox='0 0 259.51 259.52'%3E%3Cpath id='Path_143' data-name='Path 143' d='M8659.507,423.965c-.167-2.608.05-5.319-.19-8.211-.084-1.012-.031-2.15-.118-3.12-.113-1.25-.1-2.682-.236-4.061-.172-1.722-.179-3.757-.365-5.394-.328-2.889-.478-5.857-.854-8.61-.509-3.714-.825-7.252-1.38-10.543-.934-5.535-2.009-11.312-3.189-16.692-.855-3.9-1.772-7.416-2.752-11.2-1.1-4.256-2.394-8.149-3.687-12.381-1.1-3.615-2.366-6.893-3.623-10.493-1.3-3.739-2.917-7.26-4.284-10.7-1.708-4.295-3.674-8.078-5.485-12.023-1.145-2.493-2.5-4.932-3.727-7.387-1.318-2.646-2.9-5.214-4.152-7.518-1.716-3.16-3.517-5.946-5.274-8.873-1.692-2.818-3.589-5.645-5.355-8.334-2.326-3.542-4.637-6.581-7.039-9.848-2.064-2.809-4.017-5.255-6.088-7.828-2.394-2.974-4.937-5.936-7.292-8.589-3.027-3.411-6.049-6.744-9.055-9.763-2.4-2.412-4.776-4.822-7.108-6.975-3-2.767-5.836-5.471-8.692-7.854-3.332-2.779-6.657-5.663-9.815-8.028-2.958-2.216-5.784-4.613-8.7-6.6-3.161-2.159-6.251-4.414-9.219-6.254-3.814-2.365-7.533-4.882-11.168-6.89-4.213-2.327-8.513-4.909-12.478-6.834-4.61-2.239-9.234-4.619-13.51-6.416-4.1-1.725-8.11-3.505-11.874-4.888-4.5-1.652-8.506-3.191-12.584-4.47-6.045-1.9-12.071-3.678-17.431-5-9.228-2.284-17.608-3.757-24.951-4.9-7.123-1.112-13.437-1.64-18.271-2.035l-2.405-.2c-1.638-.136-3.508-.237-4.633-.3a115.051,115.051,0,0,0-12.526-.227h259.51Z' transform='translate(-8399.997 -164.445)' fill='%23ED6C1C'/%3E%3C/svg%3E%0A") !important;

            }
            .side-nav>ul>li>.side-menu.side-menu--active:after {

                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='259.51' height='259.52' viewBox='0 0 259.51 259.52'%3E%3Cpath id='Path_143' data-name='Path 143' d='M8659.507,423.965c-.167-2.608.05-5.319-.19-8.211-.084-1.012-.031-2.15-.118-3.12-.113-1.25-.1-2.682-.236-4.061-.172-1.722-.179-3.757-.365-5.394-.328-2.889-.478-5.857-.854-8.61-.509-3.714-.825-7.252-1.38-10.543-.934-5.535-2.009-11.312-3.189-16.692-.855-3.9-1.772-7.416-2.752-11.2-1.1-4.256-2.394-8.149-3.687-12.381-1.1-3.615-2.366-6.893-3.623-10.493-1.3-3.739-2.917-7.26-4.284-10.7-1.708-4.295-3.674-8.078-5.485-12.023-1.145-2.493-2.5-4.932-3.727-7.387-1.318-2.646-2.9-5.214-4.152-7.518-1.716-3.16-3.517-5.946-5.274-8.873-1.692-2.818-3.589-5.645-5.355-8.334-2.326-3.542-4.637-6.581-7.039-9.848-2.064-2.809-4.017-5.255-6.088-7.828-2.394-2.974-4.937-5.936-7.292-8.589-3.027-3.411-6.049-6.744-9.055-9.763-2.4-2.412-4.776-4.822-7.108-6.975-3-2.767-5.836-5.471-8.692-7.854-3.332-2.779-6.657-5.663-9.815-8.028-2.958-2.216-5.784-4.613-8.7-6.6-3.161-2.159-6.251-4.414-9.219-6.254-3.814-2.365-7.533-4.882-11.168-6.89-4.213-2.327-8.513-4.909-12.478-6.834-4.61-2.239-9.234-4.619-13.51-6.416-4.1-1.725-8.11-3.505-11.874-4.888-4.5-1.652-8.506-3.191-12.584-4.47-6.045-1.9-12.071-3.678-17.431-5-9.228-2.284-17.608-3.757-24.951-4.9-7.123-1.112-13.437-1.64-18.271-2.035l-2.405-.2c-1.638-.136-3.508-.237-4.633-.3a115.051,115.051,0,0,0-12.526-.227h259.51Z' transform='translate(-8399.997 -164.445)' fill='%23ED6C1C'/%3E%3C/svg%3E%0A") !important;

            }
            .side-nav>ul>li>.side-menu.side-menu--active .side-menu__title {
            font-weight: bold !important;
            color: #FFF
            }
            .side-nav .side-menu .side-menu__title {
            font-weight: bold;
            font-size: 18px;
            }
            .side-nav>ul ul li a:not(.side-menu--active) {
            color: #ffffff;
            }
            .side-menu__sub-open .side-menu__title{
                font-weight:normal !important;
            }
            .side-nav .logo-container:before {

            background-color: #FFFFFF;


            }
            .side-nav {

            background-color: #025091 !important;

            }
            .box{
                background-color:#EDEFF5;
                box-shadow: 0 0px 0px #0000000b !important;
            }
            .side-nav .logo-container {
            border-top-left-radius: 45px !important;
            border-bottom-left-radius: 45px !important;
            background-color:#FFF !important;
            }
            .mobile-menu {
background: #F9F9FF!important;
border-radius: 70px;
margin-left: 0rem!important;
margin-right: 0rem!important;
width: 100%!important;
position: unset;
z-index: 60;
margin-bottom: 0pc;
padding-right: 0px;
}
.mobile-menu .scrollable {
    z-index: 99999 !important;

}
table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_desc_disabled:before {
content: "" !important;
}
table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after {
    content: "" !important;
}

.side-menu-hide{
    width: 0px !important;
    padding-right:0px !important;
}

.pdf-viewer .pagination{
    background: #ffffff;
    width: 100%;
    float: left;
}
.pdf-viewer .pagination .wrap{
    float:right;
    width: 300px;
} 
#the-canvas {
    border: 1px solid black;
    direction: ltr;
    margin: 0 auto;
    display: block;
    width: 100%;
}

.modal-xl{

    width: 70% !important;

}
.modal-content .pagination .wrap #prev{
    width: 24px;
    float: left;
    padding-right: 24px;
    margin-right: 24px;
}
.modal-content .pagination .wrap #next{
    width: 24px;
    float: left;
    
}
.modal-content .pagination .wrap span{
    line-height: 32px;
    font-size: 20px;
    color: #35495e;
 
    margin-left: 24px;
    
}
.modal-content .pagination .wrap{
    height: 40px;
    
}
.modal-content .pagination{
    position: fixed;
    width: auto;
    
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    border: none;
background: transparent !important;
}
div.dataTables_wrapper div.dataTables_length select {
width: 70px;
display: inline-block;
}
.highcharts-credits{
    display:none !important;
}
.text-3xl{
    font-size: 1.5vw !important;
}
.md\:text-3xl {
    font-size: 1.5vw !important;
}
.md\:text-base {
    font-size: 1vw !important;
}
.clear-layout .select-country-section h4 {
padding-right: 0rem !important;
}
.report-box .report-box__indicator {
    display: inline-flex;
    position: absolute;

}
.nav.nav-boxed-tabs .nav-item .nav-link {
box-shadow: 0 3px 20px #0000000b;
border-radius: .375rem;
border: 1px solid #025091;
width: 90%;
}
.sub-menu-selected .side-menu__title{

    color:#ffffff;
    text-decoration:underline;
}
.piramide-poblacional{


height:500px;
}
@media (max-width: 500px) {
  .side-nav-fixed {
    display: none !important;
  }
  .clear-layout .select-country-section h2 {
    padding-top: 10rem;
  }
  .md\:text-3xl {
font-size: 4vw !important;
}

.md\:text-base {
font-size: 3vw !important;
}
.sm\:col-span-8 {
                grid-column:span 12 / span 12
        }

.piramide-poblacional{


    height:500px;
}
}
.side-nav>ul>li>.side-menu:hover:not(.side-menu--active):not(.side-menu--open) .side-menu__icon:before {
width: 100%;
}
@media (max-width: 1279px){
    .side-nav-fixed .side-nav {
        width: 360px !important;
  }
  .side-nav-fixed.side-menu-hide .side-nav {
        width: 0 !important;
  }
  .side-nav .side-menu .side-menu__title .side-menu__sub-icon, .side-nav .side-menu .side-menu__title {
display: inline-flex;
}


}





        </style>

        <script>

            $("#search-input").on("keyup", function () {

                var value = $(this).val();
                console.log(value);
                if(value != undefined && value != "" && value != null){

                    $("#list-results")
                    .find("a")
                    .each(function(){

                        var search = $(this).attr("data-valor");

                        var busqueda = search.toLowerCase().indexOf(value);

                        if(busqueda >= 0){

                            $(this).removeClass("hidden");


                        }else{
                            $(this).addClass("hidden");
                        }



                    })
                    

          



                }else{


                    $("#list-results")
                    .find("a")
                    .each(function(){

                        
                    $(this).addClass("hidden");
                        



                    })


                }
              
            });

            $(".compress-menu").on("click", function(){


                if($(".side-nav").hasClass("side-menu-hide")){

                    $(".side-nav").removeClass("side-menu-hide");


                }else{


                    $(".side-nav").addClass("side-menu-hide");

                }

                if($(".side-nav-fixed").hasClass("side-menu-hide")){

$(".side-nav-fixed").removeClass("side-menu-hide");


}else{


$(".side-nav-fixed").addClass("side-menu-hide");

}



            })

            $(document).on("change", ".change-country", function(){

                var pais = $(this).val();

                location.href="/usuario/change-country/"+pais;


            });



            document.addEventListener('contextmenu', event => event.preventDefault());

            $(document).on("click", ".power-viewer", function () {

jQuery.noConflict();
console.log("Abrir Modal")
var file = jQuery(this).attr("data-file");
var url = file;
jQuery("#iframe-file").attr("src", url);
const myModal = tailwind.Modal.getInstance(document.querySelector("#power-viewer-modal"));
myModal.show();
var isChrome = navigator.userAgent.toLowerCase().indexOf("chrome") >= 0 ? true : false;

if(isChrome){
window.scrollTo({ top: 0, behavior: 'smooth' });
}


});


        </script>


<div id="power-viewer-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body p-10 text-center">
            <iframe class="w-full" 
               id="iframe-file"
               src="https://app.powerbi.com/view?r=eyJrIjoiOGViM2E1YzAtMjE5MC00YzAwLTg0M2YtMzIwZWQxODk4YjFhIiwidCI6IjlmZTNjYjk0LWFiNWYtNDFjNi1hYjU4LWIwZGMzYTI1M2E4OSJ9&pageName=ReportSection216d741c435372664ef0" 
               frameborder="0" 
               height="800"
               allowFullScreen="true"> 
               </iframe> 
                
            </div>
        </div>
    </div>
</div>
        @yield('script')
    </body>
@endsection
