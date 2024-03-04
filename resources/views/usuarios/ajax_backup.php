let loader = document.querySelector('.loader')
   
   loader.style.visibility = 'visible';
   jQuery.ajax({
               type: 'POST',
               url: "{{ url('usuario/filtro-ventas') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   ano: marca,
                   tipo: 2
               },
               success: function (data) {
                   loader.style.visibility = 'hidden';
                   response = JSON.parse(data);

                   console.log(response);

                   var content = "";

                   jQuery.each(response, function(i, item) {

                    content += '<div class="accordion-item" style="padding: 0px;min-height: 54px;">'+
    '<div id="faq-accordion-content-'+i+'" data-color="'+response.ventas_2_regiones_data[i].color+'" class="accordion-header">'+
        '<button style="background-color:'+response.ventas_2_regiones_data[i].color+';padding: 1rem;" class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-'+i+'" aria-expanded="false" aria-controls="faq-accordion-collapse-'+i+'"> '+i+' </button> </div>'+
    '<div id="faq-accordion-collapse-'+i+'" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-'+i+'" data-tw-parent="#faq-accordion-2">'+
        '<div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">'+

            '<div id="faq-accordion-'+i+'" class="accordion accordion-boxed">'+
                if(Array.isArray(item)){
                    if(item.lenght > 0){
                    jQuery.each(item, function(j, item2) {
                            if($j != 'color'){




                                '<div class="accordion-item">'+
                                    '<div id="inside-accordion-content-'+j+'" class="accordion-header">'+
                                        '<button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#inside-accordion-collapse-'+j+'"  aria-expanded="false" aria-controls="inside-accordion-collapse-'+j+'"> '+j+' </button>'+
                                    '</div>'+
                                   ' <div id="inside-accordion-collapse-'+j+'" class="accordion-collapse collapse" aria-labelledby="inside-accordion-content-'+j+'">'+
                                        '<div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">'+
                                           ' <table class="table table-report mt-4 col-span-12 tabla-regiones" id="table-total-regiones" style="width:100% !important">'+
                                               ' <thead>'+
                                                    '<tr>'+

                                                        '<th class="text-center whitespace-nowrap">Marca</th>'+

                                                        '<th class="text-center whitespace-nowrap">Volumen (Ton)</th>'
                                                       ' <th class="text-center whitespace-nowrap">Valor</th>'+
                                                    '</tr>'+
                                               ' </thead>'+
                                                '<tbody>'+
                                                    if(item2.lenght > 0){
                                                        jQuery.each(item2, function(k, item3) {
                                                            '<tr class="intro-x">'+

                                                                '<td class="text-center">'+item3.marca+'</td>'+
                                                                '<td class="text-center">'+item3.toneladas_netas+' </td>'+
                                                                '<td class="text-center">'+item3.total_ventas+' </td>'+
                                                            '</tr>'+
                                                        }
                                                    }







                                                '</tbody>'
                                            '</table>'+







                                        '</div>'+
                                    '</div>'+
                               ' </div>'+



                            }
                            }

                            }

                            }



            '</div>'+



        '</div>'+
    '</div>'+
'</div>';

//$("#regiones-content").html(content);


                   });


               },
               error: function (e) {
                   loader.style.visibility = 'hidden';
                   console.log(e);
               }
           });