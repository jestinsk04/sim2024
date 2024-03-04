@extends('../layout/' . $layout)

@section('subhead')
<title>Data - Admin - SIMEP</title>
@endsection

@section('subcontent')

<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Importar Data</h2>
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
<form method="POST" action="data-import" enctype="multipart/form-data" accept-charset="UTF-8">
    @csrf
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">

            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div
                    class="flex flex-col sm:flex-row items-center  border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Importar Data</h2>
                </div>
    
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Seleccionar Archivo</label>
                    <input name="select_file" type="file" required>
                </div>

                <div class="text-right mt-5">

                    <button type="submit" class="btn btn-primary w-24">Guardar</button>
                </div>

            </div>
            <!-- END: Form Layout -->

        </div>
</form>
@endsection
@section('script')


@endsection