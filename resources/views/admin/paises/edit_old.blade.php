@extends('../layout/' . $layout)

@section('subhead')
<title>Paises - Admin - SIMEP</title>
@endsection

@section('subcontent')

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Editar País</h2>
    </div>
                            @if (session('update'))

<div class="alert alert-primary alert-dismissible show flex items-center mb-2" role="alert">
    <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> {{ session('update') }}
    <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
        <i data-lucide="x" class="w-4 h-4"></i>
    </button>
</div>
                           
                           @endif

                           @if (count($errors) > 0)
                           @if($errors->any())
                           <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
    <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{$errors->first()}}
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
            <div class="">
            <label for="crud-form-1" class="form-label">Icono País (100x100px)</label>
                <div class="dropzone" action="{{ route('file.store') }}" id="file-dropzone"></div>
                <input type="hidden" id="image" name="image" value="{{$data['data']->image}}">
                                     </div>
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Nombre País</label>
                    <input id="crud-form-1" name="name" type="text" class="form-control w-full" value="{{$data['data']->name}}" placeholder="País" required>
                    <input type="hidden" id="id" name="id" value="{{$data['data']->id}}">
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
      acceptedFiles: ".jpeg,.jpg,.png,.gif, .svg",
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
        
        var name = $("#image").val();
        $.ajax({
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
        $("#image").val(response.success)
      },

      init: function(){
        let myDropzone = this;

        let mockFile = { name: "{{$data['data']->image}}", size: 12345 };
        myDropzone.displayExistingFile(mockFile, 'https://sigaim.aeriousport.com/storage/uploads/{{$data['data']->image}}');

        

       
      }
    }
  </script>

@endsection