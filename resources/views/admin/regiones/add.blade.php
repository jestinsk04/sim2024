@extends('../layout/' . $layout)

@section('subhead')
<title>Regiones - Admin - SIMEP</title>
@endsection

@section('subcontent')

<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Añadir Region</h2>
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
        <form method="POST" action="regiones-insert">
            @csrf
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Seleccionar País</label>

                    <select name="country" class="form-control" id="">

                    @if(count($data['paises'])>0)
                        @foreach($data['paises'] as $value)

                        <option value="{{$value->id}}">{{$value->name}}</option>

                        @endforeach


                    @endif


                    </select>
                </div>
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Nombre Region</label>
                    <input id="crud-form-1" name="name" type="text" class="form-control w-full" placeholder="Nombre Region"
                        required>
                </div>
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Color Hexadecimal (#FFFFFF)</label>
                    <input id="crud-form-1" name="color" type="text" class="form-control w-full" placeholder="#FFFFFF"
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


@endsection
