@extends('layouts.app')


@section('content')
<div class="w-full">

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Gestión de usuarios
        </h2>

        @if (auth()->user()->rol_id == 1)
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="/usuario/crear" class="button flex  text-white bg-theme-1 shadow-md mr-2 tooltip" title="Presione el boton izquierdo del mouse aqui para ingresar al formulario de registro de usuario"><i data-feather="plus" class="mx-auto"></i> Registrar un nuevo usuario</a>
        </div>
        @endif

    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">

        <table id="tbl_usuarios" class="table 
        w-full display  dtr-inline dt-responsive mb-2 mt-5">

            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">Nombre</th>
                    <th class="border-b-2 whitespace-no-wrap">Rol</th>
                    <th class="border-b-2 whitespace-no-wrap">Documento</th>
                    <th class="border-b-2 whitespace-no-wrap">Teléfono</th>
                    <th class="border-b-2 whitespace-no-wrap">Dirección</th>
                    <th class="border-b-2 whitespace-no-wrap">Correo</th>
                    <th class="border-b-2 whitespace-no-wrap">Estado</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Acciones</th>

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
    $('#tbl_usuarios').DataTable({
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
        ajax: '/usuario/listar',
        columns: [{
                data: 'nombre',
                name: 'nombre',
            },
            {
                data: 'rol',
                name: 'rol',
            },
            {
                data: 'documento',
                name: 'documento',
            },
            {
                data: 'telefono',
                name: 'telefono',
            },
            {
                data: 'direccion',
                name: 'direccion',
            },
            {
                data: 'email',
                name: 'email',
            },
            {
                data: 'estado',
                name: 'estado',

            },
            {
                data: 'acciones',
                name: 'acciones',
                orderable: false,
                serachable: false,
                sClass: 'text-center'
            }
        ]
    });

</script>
@endsection