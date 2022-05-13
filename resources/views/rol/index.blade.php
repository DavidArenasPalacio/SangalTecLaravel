@extends('layouts.app')


@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Gestión De Roles
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="/rol/crear" class="button text-white bg-theme-1 shadow-md mr-2">Registrar Rol </a>
        </div>

    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5 m-auto" style="width: 80% !important">
        <table id="tbl_rol" class="table table-report table-report--bordered display">

            <thead>
                <tr class="bg-gray-700 text-white">
                    <th class="border-b-2 whitespace-no-wrap">Nombre</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Acciones</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
            <thead>

    </div>
@endsection



@section('script')
    <script>
        $('#tbl_rol').DataTable({
            processing: true,
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
            ajax: '/rol/listar',
            columns: [{
                    data: 'Nombre_Rol',
                    name: 'Nombre_Rol',
                    sClass: 'border-b'
                },
                {
                    data: 'acciones',
                    name: 'acciones',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center border-b'
                }
            ]

        });

        $('#btnGuardar').click((e) => {
            let form = $('#form');
            e.preventDefault();
            Swal.fire({
                title: '¿Desea crear la categoría?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@endsection
