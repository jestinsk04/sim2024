@extends('../layout/' . $layout)

@section('subhead')
<title>Usuarios - Admin - SIMEP</title>
@endsection

@section('subcontent')

<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Añadir Usuario</h2>
</div>
@if(session('update'))

    <div class="alert alert-primary alert-dismissible show flex items-center mb-2" role="alert">
        <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> {{ session('update') }}
        <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>

@endif

@if(count($errors) > 0)
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
            <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ $errors->first() }}
            <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

    @endif
@endif
<form method="POST" action="usuarios-insert">
    <!-- <form method="POST" action="usuarios-insert"> -->
    @csrf
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">

            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5 grid grid-cols-12 gap-6">
                <div
                    class="flex flex-col sm:flex-row items-center  border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Datos Personales</h2>
                </div>
                <div class="col-span-12">
                    <label for="crud-form-1" class="form-label">Imagen Usuario (100x100px)</label>
                    <div class="dropzone" action="{{ route('file.store') }}" id="file-dropzone"></div>
                    <input type="hidden" id="image" name="image" required>
                </div>
                <div class="mt-3 col-span-12 xl:col-span-4">
                    <label for="crud-form-1" class="form-label">Nombre</label>
                    <input id="crud-form-1" name="name" type="text" class="form-control w-full" placeholder="Nombre"
                        required>
                </div>
                <div class="mt-3 col-span-12 xl:col-span-4">
                    <label for="crud-form-1" class="form-label">Apellido</label>
                    <input id="crud-form-1" name="lname" type="text" class="form-control w-full" placeholder="Apellido"
                        required>

                </div>
                <div class="mt-3 col-span-12 xl:col-span-4">
                    <label for="crud-form-1" class="form-label">Email</label>
                    <input id="crud-form-1" name="email" type="text" class="form-control w-full" placeholder="Email"
                        required>

                </div>

            </div>
            <!-- END: Form Layout -->



        </div>
        
        <div class="intro-y col-span-12 lg:col-span-12">


            <div class="intro-y box p-5">
                <div
                    class="flex flex-col sm:flex-row items-center  border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Niveles de Acceso</h2>
                </div>


                                    
                <div id="faq-accordion-2" class="accordion accordion-boxed">
                    <div class="accordion-item">
                        <div id="faq-accordion-content-admin" class="accordion-header">
                            <button class="accordion-button" type="button" data-tw-toggle="collapse"
                                data-tw-target="#faq-accordion-collapse-admin" aria-expanded="true"
                                aria-controls="faq-accordion-collapse-admin">
                                Administrador General
                            </button>
                        </div>
                        <div id="faq-accordion-collapse-admin" class="accordion-collapse collapse"
                            aria-labelledby="faq-accordion-content-admin" data-tw-parent="#faq-accordion-2">
                            <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                <div class="form-check mt-2"
                                    style="padding-bottom: 10px;">

                                    <label class="form-check-label font-xl font-bold"
                                        for="checkbox-switch-1">Acceso administrador General</label>

                                    <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                        class="form-check-input" name="accesos[Admin]" type="checkbox"
                                        value="admin_general">
                                </div>
                            </div>
                        </div>
                        </div>

                        @foreach($data['paises'] as $value)
                        <div class="accordion-item">
                            <div id="faq-accordion-content-{{ $value->id }}" class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse"
                                    data-tw-target="#faq-accordion-collapse-{{ $value->id }}" aria-expanded="false"
                                    aria-controls="faq-accordion-collapse-{{ $value->id }}">
                                    {{ $value->name }}
                                </button>
                            </div>
                            <div id="faq-accordion-collapse-{{ $value->id }}" class="accordion-collapse collapse"
                                aria-labelledby="faq-accordion-content-{{ $value->id }}" data-tw-parent="#faq-accordion-2">
                                <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                    <div class="form-check mt-2"
                                        style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                        <label class="form-check-label font-xl font-bold"
                                            for="checkbox-switch-1">Acceso a {{ $value->name }}</label>

                                        <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                            class="form-check-input" name="accesos[{{ $value->name }}]"
                                            type="checkbox" value="{{ $value->name }}">
                                    </div>


                                    <div class="mt-3" style="padding-left:50px;">

                                        <div
                                            class="flex flex-col sm:flex-row items-center border-b border-slate-200/60 dark:border-darkmode-400">
                                            <h2 class="font-light text-base mr-auto">Secciones</h2>
                                        </div>



                                        <div class="form-check mt-2"
                                            style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                            <label class="form-check-label" for="checkbox-switch-1">KPI`s País</label>

                                            <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                class="form-check-input" name="accesos[{{ $value->name }}][kpi]"
                                                type="checkbox" value="kpi">
                                        </div>
                                    


                                        <div class="form-check mt-2"
                                            style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                            <label class="form-check-label" for="checkbox-switch-1">Investigacion de
                                                mercado</label>

                                            <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                class="form-check-input"
                                                name="accesos[{{ $value->name }}][investigacion]" type="checkbox"
                                                value="investigacion">
                                        </div>
                                        <div class="mt-3" style="padding-left:100px;">

                                            <div
                                                class="flex flex-col sm:flex-row items-center border-b border-slate-200/60 dark:border-darkmode-400">
                                                <h2 class="font-light text-base mr-auto">Sub Secciones</h2>
                                            </div>


                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">Investigacion Global</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][investigacion][global]"
                                                    type="checkbox" value="global">
                                            </div>



                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">Estudios Ad
                                                    Hoc</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][investigacion][adhoc]"
                                                    type="checkbox" value="adhoc">
                                            </div>



                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">Comunidad
                                                    Online</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][investigacion][online]"
                                                    type="checkbox" value="online">
                                            </div>

                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">Panel
                                                    Hogares</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][investigacion][hogares]"
                                                    type="checkbox" value="hogares">
                                            </div>

                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">Investigación Sindicada</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][investigacion][sindicada]"
                                                    type="checkbox" value="otros">
                                            </div>

                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">Otros</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][investigacion][otros]"
                                                    type="checkbox" value="otros">
                                            </div>

                                        </div>


                                        <div class="form-check mt-2"
                                            style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                            <label class="form-check-label" for="checkbox-switch-1">Analisis de
                                                mercado</label>

                                            <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                class="form-check-input" name="accesos[{{ $value->name }}][analisis]"
                                                type="checkbox" value="analisis">
                                        </div>

                                        <div class="mt-3" style="padding-left:100px;">

                                            <div
                                                class="flex flex-col sm:flex-row items-center border-b border-slate-200/60 dark:border-darkmode-400">
                                                <h2 class="font-light text-base mr-auto">Sub Secciones</h2>
                                            </div>


                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">Analisis Global</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][analisis][global]"
                                                    type="checkbox" value="global">
                                            </div>



                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">Valoración de
                                                    Mercado</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][analisis][valoracion_mercado]"
                                                    type="checkbox" value="valoracion_mercado">
                                            </div>



                                           
                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">RRSS</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][analisis][rrss]" type="checkbox"
                                                    value="rrss">
                                            </div>

                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">Clientes</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][analisis][clientes]"
                                                    type="checkbox" value="clientes">
                                            </div>

                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label"
                                                    for="checkbox-switch-1">Segmentaciones</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][analisis][segmentaciones]"
                                                    type="checkbox" value="segmentaciones">
                                            </div>

                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label"
                                                    for="checkbox-switch-1">Continuos - Bebidas</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][analisis][continuos]"
                                                    type="checkbox" value="continuos">
                                            </div>

                                            <div class="form-check mt-2"
                                                style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                                <label class="form-check-label" for="checkbox-switch-1">Otros</label>

                                                <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                    class="form-check-input"
                                                    name="accesos[{{ $value->name }}][analisis][otros]"
                                                    type="checkbox" value="otros">
                                            </div>

                                        </div>



                                        <div class="form-check mt-2"
                                            style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                            <label class="form-check-label" for="checkbox-switch-1">Tendencias</label>

                                            <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                class="form-check-input"
                                                name="accesos[{{ $value->name }}][tendencias]" type="checkbox"
                                                value="tendencias">
                                        </div>

                                        <div class="form-check mt-2"
                                            style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                            <label class="form-check-label" for="checkbox-switch-1">Precios</label>

                                            <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                class="form-check-input"
                                                name="accesos[{{ $value->name }}][precios]" type="checkbox"
                                                value="precios">
                                        </div>


                                        <div class="form-check mt-2"
                                            style="padding-bottom: 10px; border-bottom: 1px solid #ccc;">

                                            <label class="form-check-label" for="checkbox-switch-1">Ventas</label>

                                            <input id="checkbox-switch-1" style="position: absolute; left: 400px;"
                                                class="form-check-input" name="accesos[{{ $value->name }}][ventas]"
                                                type="checkbox" value="ventas">
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

            
               
                </div>
                                    
                                

                

               

                <div class="mt-3">

                    

                    @foreach($data['paises'] as $value)

                        





                    @endforeach



                </div>


            </div>


            <!-- BEGIN: Form Layout -->

            <!-- END: Form Layout -->


            <!-- END: Form Layout -->

        </div>
        <div class="intro-y col-span-12 lg:col-span-12">

            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">

                <div class="text-right mt-5">

                    <button type="submit" class="btn btn-primary w-24">Guardar</button>
                </div>
            </div>
            <!-- END: Form Layout -->

        </div>
    </div>
</form>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
<script>
    Dropzone.options.fileDropzone = {
        url: '{{ route('file.store') }}',
        method: "post",
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        maxFiles: 1,
        maxFilesize: 2,
        resizeWidth: 100,
        resizeHeight: 100,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        removedfile: function (file) {

            var name = $("#image").val();
            jQuery.ajax({
                type: 'POST',
                url: '{{ route('file.remove') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name
                },
                success: function (data) {
                    console.log("File has been successfully removed!!");
                },
                error: function (e) {
                    console.log(e);
                }
            });
            var fileRef;
            return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function (file, response) {
            console.log(file);
            jQuery("#image").val(response.success)
        },
    }

</script>

@endsection
