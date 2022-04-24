@extends('layouts.app')


@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
    Gestión Usuario
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="/rol/create" class="button text-white bg-theme-1 shadow-md mr-2">    Crear Usuario</a>
    </div>

</div>
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="tbl_usuarios" class="table table-report table-report--bordered display  ">

        <thead>
            <tr>
            <th>Nombre</th>
                    <th>Rol</th>
                    <th>Documento</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Acciones</th>

            </tr>
        </thead>
        <tbody>
        </tbody>
        <thead>
</div>

@endsection


@section('script')

<script>
    $('#tbl_usuarios').DataTable({
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
        ajax: '/usuario/listar',
        columns: [{
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'rol',
                name: 'rol'
            },
            {
                data: 'documento',
                name: 'documento'
            },
            {
                data: 'telefono',
                name: 'telefono'
            },
            {
                data: 'direccion',
                name: 'direccion'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'estado',
                name: 'estado',
                orderable: false,
                serachable: false
            },
            {
                data: 'acciones',
                name: 'acciones',
                orderable: false,
                serachable: false,
                sClass: 'text-center'
            }
        ]
    }
    );
    $('#btnGuardar').click((e) => {
    let form = $('#form');
        e.preventDefault();
        Swal.fire({
            title: '¿Desea Crear El Usuario?',
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