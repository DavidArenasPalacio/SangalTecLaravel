@extends('layouts.app')


@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between p-2">
            <h3>Gestión Categorías</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Crear Categoría
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Crear Categría</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <form action="/categoria/guardar" method="post" id="form">
                            @csrf
                            <div class="mb-3">
                                <label for="">Nombre:</label>
                                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror">
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                          
                            <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="card-body">

        <table id="tbl_categoria" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>

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
        ajax: '/categoria/listar',
        columns: [
            {
                data: 'Nombre_Categoria',
                name: 'Nombre_Categoria'
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