@extends('layouts.app')


@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between p-2">
            <h3>Control de existencia</h3>
          
        </div>
       
            
        </div>
    </div>



    <div class="card-body">

        <table id="tbl_controlExistencia" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
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
    $('#tbl_controlExistencia').DataTable({
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
        ajax: '/controlExistencia/listar',
        columns: [{
                data: 'producto',
                name: 'producto'
            },
            {
                data: 'cantidad',
                name: 'cantidad'
            }
        ]
    }
    );

</script>
@endsection