@extends('../layout/' . $layout)

@section('subhead')
<title>Paises - Admin - SIMEP</title>
@endsection

@section('subcontent')

<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Editar País</h2>
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
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <form method="POST" action="/admin/paises-update">
            @csrf
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">

            <div class="col-span-12">
                    <label for="crud-form-1" class="form-label">Imagen Regiones</label>
                    <div class="dropzone" action="{{ route('file.store') }}" id="file-dropzone"></div>
                    <input type="hidden" id="mapa" name="mapa" value="{{$data['data']->mapa}}" required>
                </div>

                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Seleccionar País</label>

                    <select name="pais" class="form-control" id="">

                    @if(count($data['countries'])>0)
                        @foreach($data['countries'] as $value)

                        <option @if($data['data']->iso == $value->countries_iso_code_2) selected @endif value="{{$value->countries_id}}">{{$value->countries_name}}</option>

                        @endforeach


                    @endif


                    </select>
                </div>
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Seleccionar Tipo Data</label>
                    <input type="hidden" id="id" name="id" value="{{$data['data']->id}}">
                    <select name="tipo" name="" class="form-control" id="">

                    <option @if($data['data']->tipo == 0) selected @endif value="0">Completa</option>
                    <option @if($data['data']->tipo == 1) selected @endif value="1">Incompleta</option>


                    </select>
                </div>
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Email Solicitudes</label>
                    <input id="crud-form-1" value="{{$data['data']->email}}" name="email" type="text" class="form-control w-full" placeholder="Email"
                        required>
                </div>
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Moneda</label>
                    <input id="crud-form-1" name="moneda" value="{{$data['data']->simbolo_moneda}}" type="text" class="form-control w-full" placeholder="Moneda"
                        required>
                </div>
                <div class="text-right mt-5">

                    <button type="submit" class="btn btn-primary w-24">Guardar</button>
                </div>
            </div>
            <!-- END: Form Layout -->
        </form>
    </div>
</div>
@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
<script>
   var myDropzone = Dropzone.options.fileDropzone = {
      url: '{{ route('file.store') }}',
      method:"post",
      acceptedFiles: ".jpeg,.jpg,.png,.gif,.svg",
      addRemoveLinks: true,
      maxFiles:1,
      maxFilesize: 2,
      resizeWidth: 100,
      resizeHeight: 100,
      headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      removedfile: function(file)
      {
        
        var name = $("#mapa").val();
        jQuery.ajax({
          type: 'POST',
          url: '{{ route('file.remove') }}',
          data: { "_token": "{{ csrf_token() }}", name: name},
          success: function (data){
              console.log("File has been successfully removed!!");
          },
          error: function(e) {
              console.log(e);
          }});
          var fileRef;
          return (fileRef = file.previewElement) != null ?
          fileRef.parentNode.removeChild(file.previewElement) : void 0;
      },
      success: function (file, response) {
        console.log(file);
        jQuery("#mapa").val(response.success)
      },

      init: function(){
        let myDropzone = this;

        let mockFile = { name: "{{$data['data']->mapa}}", size: 12345 };
        myDropzone.displayExistingFile(mockFile, 'https://sigaim.aeriousport.com/storage/uploads/{{$data['data']->mapa}}');

        

       
      }
    }
  </script>
@endsection
