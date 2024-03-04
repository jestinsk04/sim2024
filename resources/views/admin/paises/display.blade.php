@extends('../layout/' . $layout)

@section('subhead')
<title>Paises - Admin - SIMEP</title>
@endsection

@section('subcontent')
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
<h2 class="intro-y text-lg font-medium mt-10">Paises</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="paises-add" class="btn btn-primary shadow-md mr-2">Añadir nuevo</a>
            <!-- <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div> -->
            <!-- <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div> -->
            <!-- <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div> -->
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap"></th>
                        <th class="whitespace-nowrap">Pais</th>
                        <th class="text-center whitespace-nowrap">Opciones</th>
                    </tr>
                </thead>
                <tbody>
              
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <!-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div> -->
        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form method="post" action="/admin/paises-delete">
            @csrf
                <input type="hidden" id="id" name="id" value="">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Importante</div>
                        <div class="text-slate-500 mt-2">¿Esta seguro de eliminar este registro?. Esta accción no se puede deshacer.</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancelar</button>
                        <button type="submit" class="btn btn-danger w-24">Eliminar</button>
                    </div>
                </div>
            </form> 
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
    @endsection
    @section('script')
    <script type="text/javascript">
    jQuery(function () {
      var table = jQuery('.table-report').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('admin/paises-list') }}",
          columns: [
              {data: 'imagen', name: 'imagen'},
              {data: 'name', name: 'name'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          'createdRow': function( row, data, dataIndex ) {
            jQuery(row).addClass( 'intro-x' );
            }
      });
    });

    jQuery(document).on("click", ".delete-register", function(){
        var id = jQuery(this).attr("data-id");
        jQuery("#id").val(id);
        console.log(id);
        


    });

  </script>
@endsection