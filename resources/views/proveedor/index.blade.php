@extends('layouts.app')


@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Gestión De Proveedores
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="/proveedor/crear" class="button text-white bg-theme-1 shadow-md mr-2"> Registrar Proveedor</a>
    </div>

</div>
<div class="intro-y datatable-wrapper  box p-5 mt-5">
        <table id="tbl_proveedor" class="table table-report table-report--bordered display nowrap">
            <thead>
                <tr class="bg-gray-700 text-white">
                    <th class="border-b-2 whitespace-no-wrap">Nombre</th>
                    <th class="border-b-2 whitespace-no-wrap">Correo</th>
                    <th class="border-b-2 whitespace-no-wrap">Teléfono</th>
                    <th class="border-b-2 whitespace-no-wrap">Dirección</th>
                    <th class="border-b-2 whitespace-no-wrap">Estado</th>
                    <th class="border-b-2 whitespace-no-wrap">Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
</div>

@endsection



@section('script')

<script>
    $('#tbl_proveedor').DataTable({
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
        ajax: '/proveedor/listar',
        columns: [{
                data: 'Nombre_Proveedor',
                name: 'Nombre_Proveedor'
            },
            {
                data: 'Correo_Proveedor',
                name: 'Correo_Proveedor'
            },
            {
                data: 'Telefono_Proveedor',
                name: 'Telefono_Proveedor'
            },
            {
                data: 'Direccion_Proveedor',
                name: 'Direccion_Proveedor'
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
            title: '¿Desea crear el producto?',
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