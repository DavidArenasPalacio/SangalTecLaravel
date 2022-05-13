@extends('layouts.app')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Gestion De Clientes
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="/clientes/crear" class="button text-white bg-theme-1 shadow-md mr-2"> Registrar Cliente</a>
    </div>
</div> 
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="clientes" class="table table-report table-report--bordered display  ">
                <thead>
                    <tr class="bg-gray-700 text-white">
                      
                        <th class="border-b-2 whitespace-no-wrap">Nombre Del Cliente</th>
                        <th class="border-b-2 whitespace-no-wrap">Documento</th>
                        <th class="border-b-2 whitespace-no-wrap">Telefono Del Cliente</th>
                        <th class="border-b-2 whitespace-no-wrap">Direccion Del Cliente</th>
                        <th class="border-b-2 whitespace-no-wrap">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <thead>

</div>

@endsection

@section('script')
    <script>


$('#clientes').DataTable({
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
        ajax: '/clientes/listar',
        columns: [{
                data: 'Nombre_Cliente',
                name: 'Nombre_Cliente'
            },
            {
                data: 'Documento_Cliente',
                name: 'Documento_Cliente'
            },
            {
                data: 'Telefono_Cliente',
                name: 'Telefono_Cliente'
            },
            {
                data: 'Direccion_Cliente',
                name: 'Direccion_Cliente'
            },
            {
                data: 'acciones',
                name: 'acciones'
            },
        ]
    });


    //     $(document).ready(function(){--
    //         $('#clientes').DataTable({
    //             processing: true,
    //             serverSide: true,
    //             ajax: "{{ route('clientes.datatable') }}",
    //         columns: [
    //             {data: 'id', name: 'id'},
    //             {data: 'Nombre_Cliente', name: 'Nombre_Cliente'},
    //             {data: 'Documento_Cliente', name: 'Documento_Cliente'},
    //             {data: 'Telefono_Cliente', name: 'Telefono_Cliente'},
    //             {data: 'Direccion_Cliente', name: 'Direccion_Cliente'},
    //             {data: 'editar', name: 'editar', orderable: false, searchable: false},
    //             {data: 'detalle', name: 'detalle', orderable: false, searchable: false},
    //     ],
    //     "language": idioma_español
    // });
    //     });
    </script>

@endsection