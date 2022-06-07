@extends('layouts.app')


@section('content')
<div class="m-auto" style="width: 80% !important">
    <div class="intro-y flex flex-col sm:flex-row items-center  mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Gestión de categorías
        </h2>

        @if (auth()->user()->rol_id == 1)
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="/categoria/crear" class="button flex text-white bg-theme-1 shadow-md mr-2 tooltip" title="Click aqui para ingresar al formulario de registro de categoria"><i data-feather="plus" class="mx-auto"></i> Registrar una nueva categoría </a>
        </div>
        @endif
    </div>

    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table id="tbl_categoria" class="table display dtr-inline dt-responsive   mt-5 mb-2">

            <thead>
                <tr class="border-t-2 ">

                    <th class="whitespace-no-wrap">Nombre</th>
                    <th class="whitespace-no-wrap">Estado</th>
                    
                    @if(auth()->user()->rol_id == 1)
                    <th class="text-center whitespace-no-wrap">Acciones</th>

                    @endif
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
</div>
@endsection



@section('script')

<script>
    $('#tbl_categoria').DataTable({
        processing: false,
        serverSide: true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        ajax: '/categoria/listar',
        columns: [{
                data: 'Nombre_Categoria',
                name: 'Nombre_Categoria'
            },
            {
                data: 'estado',
                name: 'estado',
                orderable: false,
                serachable: false,
            },
            @if(auth()->user()->rol_id == 1) {
                data: 'acciones',
                name: 'acciones',
                orderable: false,
                serachable: false,
                sClass: 'text-center'
            }
            @endif
        ]
    });

</script>
@endsection