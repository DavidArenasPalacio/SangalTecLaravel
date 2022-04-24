@extends('layouts.app')


@section('titulo')
    Gestion De Clientes
@endsection   


@section('content')
<div class="card">

    <div class="card-header">
        <div >
        <!-- Button trigger modal -->
            <button style="position: relative; left: 87%;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                Registrar Cliente
            </button>
        </div>
            
        
    </div>
    <div class="card-body">
            {{-- <div>
                <a style="position: relative; left: 90%;" href="/clientes/crear" class="btn btn-success"> Registrar Cliente </a>
            </div> --}}
            <br>
            <table id="clientes" class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                      
                        <th>Nombre Del Cliente</th>
                        <th>Documento</th>
                        <th>Telefono Del Cliente</th>
                        <th>Direccion Del Cliente</th>
                        <th>Editar</th>
                        <th>Ver Detalle</th>
                    </tr>
                </thead>
            </table>
    </div>
</div>

{{-- modal de registrar cliente --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Registrar Un Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
                    
            <div class="modal-body"> 
                <form id="formCl" action="{{ route('clientes.store') }}" method="POST"  enctype="multipart/form-data" autocomplete="on">
                    @csrf
                    <div class="form-group">        
                        <input  class="form-control" placeholder="Ingrese el nombre del cliente" name="nombre_cliente" value="{{old('nombre_cliente')}}"/>
                        {{-- @error('nombre_cliente')    
                            <small>{{ $message }}</small>            
                        @enderror  --}}
                    </div>
                    <br>
                    <div class="form-group">        
                        <input class="form-control" placeholder="Ingrese el numero de documento del cliente" name="documento" value="{{old('documento')}}"/>
                        {{-- @error('documento')    
                            <small>{{ $message }}</small>            
                        @enderror  --}}
                    </div>
                    <br>
                    <div class="form-group">        
                        <input  class="form-control" placeholder="Ingrese el numero de telefono del cliente" name="telefono_cliente" value="{{old('telefono_cliente')}}"/>
                        {{-- @error('telefono_cliente')    
                            <small>{{ $message }}</small>            
                        @enderror  --}}
                    </div>
                    <br>
                    <div class="form-group">        
                        <input  class="form-control" placeholder="Ingrese la direccion del cliente" name="direccion_cliente" value="{{old('direccion_cliente')}}"/>
                        {{-- @error('direccion_cliente')    
                            <small>{{ $message }}</small>            
                        @enderror  --}}
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-success form-control"> Crear</button>
                            </div>
                            <div class="col-6">
                                <a href="/clientes" class="btn btn-primary form-control"> Volver</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- fin modal registrar cliente     --}}

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
                data: 'editar',
                name: 'editar'
            },
            {
                data: 'detalle',
                name: 'detalle'
            }
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