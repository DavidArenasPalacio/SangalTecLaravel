@extends('layouts.app')


@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Gestión Productos
    </h2>

    @if (auth()->user()->rol_id == 1)
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="/producto/crear" class="button text-white bg-theme-1 shadow-md mr-2"> Crear Producto</a>
    </div>
    @endif

</div>
<div class="intro-y datatable-wrapper box p-5 mt-5">
        <table id="tbl_productos" class="table table-report table-report--bordered display">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">Nombre</th>
                    <th class="border-b-2 whitespace-no-wrap">Categoría</th>
                    <th class="border-b-2 whitespace-no-wrap">Precio Compra</th>
                    <th class="border-b-2 whitespace-no-wrap">Precio Venta</th>
                    <th class="border-b-2 whitespace-no-wrap">Cantidad</th>
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
    $('#tbl_productos').DataTable({
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
        ajax: '/producto/listar',
        columns: [{
                data: 'Nombre_Producto',
                name: 'Nombre_Producto'
            },
            {
                data: 'categoria',
                name: 'categoria'
            },
            {
                data: 'Precio_Compra',
                name: 'Precio_Compra'
            },
            {
                data: 'Precio_Venta',
                name: 'Precio_Venta'
            },
            {
                data: 'Cantidad',
                name: 'Cantidad'
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
    });

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