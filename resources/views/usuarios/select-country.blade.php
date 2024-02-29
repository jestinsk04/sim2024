@extends('../layout/' . $layout)

@section('head')
    <title>Seleccionar Pais - SIMEP</title>

    <link href="https://sim-ep.com/build/assets/jquery-jvectormap-2.0.5.css" rel="stylesheet">


@endsection

@section('content')
    <div class="loader" style="visibility:hidden;width: 100vw; height: 100vh; position: absolute; background-color: rgba(255,255,255,0.8); z-index: 9999; display: flex; align-items: center; text-align: center;">
    <svg width="25" viewBox="-2 -2 42 42" xmlns="http://www.w3.org/2000/svg" stroke="rgb(30, 41, 59)" class="w-32 h-32" style="margin: 0px auto;">
                        <g fill="none" fill-rule="evenodd">
                            <g transform="translate(1 1)" stroke-width="4">
                                <circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle>
                                <path d="M36 18c0-9.94-8.06-18-18-18">
                                    <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform>
                                </path>
                            </g>
                        </g>
                    </svg>
    </div>
    <div class="container sm:px-10" style="min-height: 100vh;">
        <div class="block xl:grid grid-cols-12 gap-4 ">
            
            <div class="xl:col-span-12 col-span-12  select-country-section" style="min-height:160px;">
                <a href="" class="-intro-x flex items-center pt-5 float-left" style="background-color: #FFF; padding: 1.25rem; border-radius: 100px; margin-top: 1.25rem;">
                    <img alt="" class="logo" src="{{ asset('build/assets/images/logo_polar.png') }}">  
                </a>

                <a href="{{ route('logout') }}" id="btn-login" style="width:100px;" class="btn btn-primary mt-5 py-3 px-4 xl:mr-3 align-top float-right">Salir</a>
                
            </div>
            <div class="xl:col-span-4 col-span-12  select-country-section">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-center font-montserrat" style="text-align:left !important;margin-top:2rem; color:#FFFFFF!important">SIMEP</h2>
                <h4 class="mt-4 font-montserrat" style="font-size:40px;text-align:left !important;text-transform:uppercase;color:#FFFFFF;padding-right: px !important;"><span style="color:#ED6C1C;font-size:60px;font-weight:bolder;">Sistema</span><br>de Información<br>de Mercado EP</h4>
                <p style="font-size:18px !important;line-height:22px;color:#FFFFFF;" class="mt-4">Sistema centralizado de diseminación de información. Que comprende distintas fuentes y resultados de análisis e investigaciones de mercados de la organización</p>
                <ul>
                    <li style="font-size:18px !important;color:#FFCC80;font-weight:bold;" class="mt-2">KPI Por País.</li>
                    <li style="font-size:18px !important;color:#FFCC80;font-weight:bold;" class="">Información Demográfica.</li>
                    <li style="font-size:18px !important;color:#FFCC80;font-weight:bold;" class="">Reportes de Análisis e Investigación de mercado.</li>
                    <li style="font-size:18px !important;color:#FFCC80;font-weight:bold;" class="">Tendencias de mercado.</li>
                    <li style="font-size:18px !important;color:#FFCC80;font-weight:bold;" class="">BackDatas sindicadas.</li>
                    <li style="font-size:18px !important;color:#FFCC80;font-weight:bold;" class="">Ventas Locales.</li>
                </ul>
                @if($data['paises'] != 0)

<form action="/usuario/selected-country" method="post">
@csrf
<div class="intro-x mt-8">
    
        <select class="intro-x login__input form-control py-3 px-4 block" style="margint-right:0px;margin-left:0px;max-width:320px;min-width:320px;" name="pais" id="">
            @foreach($data['paises'] as $value)

                <option value="{{$value}}">{{$value}}</option>
            @endforeach

</select>
        
   
</div>

<div class="intro-x mt-5 xl:mt-8 text-left xl:text-left">
    <button type="submit" id="btn-login" style="max-width:320px;min-width:320px;" class="btn btn-primary py-3 px-4  xl:mr-3 align-top">Ver Información</a>

</div>
</form>
@else

<p class="intro-x mt-5 xl:mt-8 text-center xl:text-left">No tienes autorización para acceder a la información</p>

@endif
            </div>
            <div class=" xl:h-auto xl:col-span-8 col-span-12 py-5 xl:py-0 my-10 xl:my-0 select-country-section-2">
                <div class="dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md xl:shadow-none w-full">
                    <div class="intro-x" style="margin-top:1rem">
                        <div id="world-map" class="w-full" style="height: 80vh"></div>
                      
                    </div>

            
                    
                    
                </div>
            </div>

           
         
        </div>
    </div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
<script src="https://sim-ep.com/build/assets/jquery-jvectormap-2.0.5.min.js"></script>
<script src="https://sim-ep.com/build/assets/jquery-jvectormap-world-mill.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>



    $(document).ready( function () {


        jQuery.noConflict();

        var map;

        var palette = ['#66C2A5', '#FC8D62', '#8DA0CB', '#E78AC3', '#A6D854'];


        generateColors = function(){
        var colors = {},
            key;

        for (key in map.regions) {
          colors[key] = palette[Math.floor(Math.random()*palette.length)];
        }
        return colors;
      },
      map;


        map = jQuery('#world-map').vectorMap({map: 'world_merc_en',
            
            backgroundColor:'#025091',
        
            regionStyle:{
  initial: {
    fill: 'grey',
    "fill-opacity": 1,
    stroke: 'none',
    "stroke-width": 0,
    "stroke-opacity": 1
  },
  hover: {
    "fill-opacity": 0.8,
    cursor: 'pointer'
  },
  selected: {
    fill: 'yellow'
  },
  selectedHover: {
  }
},
series:{
      regions: [{
        values: @json($data['paises_autorizados'])
      }]
    },

    onRegionClick: function(e,code){
        let loader = document.querySelector('.loader')
        console.log(code);
        loader.style.visibility = 'visible';
        jQuery.ajax({
            url: "{{ url('usuario/check-country') }}",
            method:'post',
            data:{'country':code,"_token": "{{ csrf_token() }}"},
            success: function(result){
                loader.style.visibility = 'hidden';
                if(result == 1){

                    location.href = 'https://sim-ep.com/usuario/dashboard-usuario'


                }else if(result == 0){

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No tienes acceso a este país'
                    })

                }
            
        }});

        


    }

        });

    });

  </script>
    
@endsection
