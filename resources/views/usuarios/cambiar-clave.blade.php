@extends('../layout/' . $layout)

@section('subhead')
<title>Cambiar Clave - Usuario - SIMEP</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 xl:mt-8">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">

            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 md:col-span-12 mt-8">
                <div class="intro-y items-center ">
                    <h2 class="text-3xl font-bold truncate mr-5 w-full title-section">Cambiar clave</h2>
                </div>

                @if(session('update'))

                    <div class="alert alert-primary alert-dismissible show flex items-center mb-2" role="alert">
                        <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i>
                        {{ session('update') }}
                        <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>

                @endif

                @if(count($errors) > 0)
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
                            <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ $errors->first() }}
                            <button type="button" class="btn-close text-white" data-tw-dismiss="alert"
                                aria-label="Close">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                        </div>

                    @endif
                @endif

                <form method="POST" action="clave-change">
                    @csrf
                    <!-- BEGIN: Form Layout -->
                    <div class="intro-y box p-5 grid grid-cols-12 gap-6">
                        <div class="mt-3 xl:col-span-6">
                            <label for="crud-form-1" class="form-label">Nueva Clave</label>
                            <input id="crud-form-1" name="clave" type="password" class="form-control w-full"
                                placeholder="Nueva Clave" required>
                        </div>
                        <div class="mt-3 xl:col-span-6">
                            <label for="crud-form-1" class="form-label">Confirmar nueva Clave</label>
                            <input id="crud-form-1" name="clavec" type="password" class="form-control w-full"
                                placeholder="Confirmar nueva Clave" required>
                        </div>
                        <div class="text-right mt-5 xl:col-span-12">

                            <button type="submit" class="btn btn-primary w-24">Guardar</button>
                        </div>
                    </div>
                    <!-- END: Form Layout -->
                </form>



            </div>





















        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
