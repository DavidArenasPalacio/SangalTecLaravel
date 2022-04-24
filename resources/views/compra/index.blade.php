@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between p-2">
            <h3>Gestión Compras</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Crear Compra
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Crear compra</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">

                        <form action="/compra/guardar" method="post" id="form">
                            <div class="row">
                                <div class="col-4">
                                    
                                    @csrf
                                    <h2>Proveedor:</h2>
                                    <div class="mb-3">
                                        <label for="">proveedor:</label>
                                        <select class="form-control @error('proveedor_id') is-invalid @enderror" id="proveedor">
                                            <option value="">------Seleccione-----</option>
                                            @foreach($proveedor as $value)
                                            <option value="{{ $value->id }}">{{ $value->Nombre_Proveedor }}</option>
                                            @endforeach
                                        </select>
                                        @error('proveedor_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <h2>Producto:</h2>
                                    <div class="mb3">
                                        <label for="">Producto: </label>
                                        <select class="form-control @error('idProducto') is-invalid @enderror" id="nombreProducto" onchange="precioProducto()">
                                            <option value="">------Seleccione-----</option>
                                            @foreach($productos as $value)
                                            <option value="{{ $value->id }}"  precio="{{ $value->Precio }}" >{{ $value->Nombre_Producto }}</option>
                                            @endforeach
                                        </select>
                                        @error('idProducto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">

                                        <input type="hidden" name="total" id="precioTotalDb">

                                        <label for="">Precio: </label>
                                        <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio"  readonly>
                                        @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Cantidad: </label>
                                        <input type="number" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad">
                                        @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-primary w-100" onclick="agregarCompra()" >Agregar</button>
                                </div>
                                <div class="col-8">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Proveedor</th>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Sub Total</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tblCompra">

                                        </tbody>

                                    </table>
                                    <h2 class="text-center">Total: $<strong id="precioTotal">0</strong></h2>

                                    <button type="button" class="btn btn-success w-100" id="btnGuardar">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>



                </div>

            </div>
        </div>
    </div>




    <div class="card-body">

        <table class="table table-bordered w-100" id="tbl_compras">
            <thead>
                <tr>
                    <th>Usuario Que Realizo La Compra</th>
                    <th>Nombre Del Proveedor</th> 
                    <th>Precio Total</th>                      
                    <th>Fecha De La Compra</th>
                    <th>Anular Compra</th>
                    <th>Detalle</th>
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
    $('#tbl_compras').DataTable({
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
        ajax: '/compra/listar',
        columns: [{
                data: 'users',
                name: 'users'
            },
            {
                data: 'proveedor',
                name: 'proveedor'
            },
            {
                data: 'Precio_total',
                name: 'Precio_total'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'estado',
                name: 'estado'
            },
            {
                data: 'acciones',
                name: 'acciones'
            }
        ]
    });

    $('#btnGuardar').click((e) => {
        let form = $('#form');
        e.preventDefault();
        Swal.fire({
            title: '¿Desea crear la compra?',
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


    function precioProducto(){
        let precio = $("#nombreProducto option:selected").attr("precio");
        console.log(precio);
        $("#precio").val(precio);
    }


    function agregarCompra() {

        let proveedor = $("#proveedor option:selected").val();
        let proveedorNombre = $("#proveedor option:selected").text();
        let nombreProducto = $("#nombreProducto option:selected").text()
        let precio = $("#precio").val();
        let cantidad = $("#cantidad").val();

        let cont = 0;
        if (cantidad >= 0 && precio >= 0) {


           
                $("#tblCompra").append(`
                <tr id="tr-${cont}">
                <input type="hidden" name="proveedor_id" value="${proveedor}">
                <input type="hidden" name="nombreProducto[]" value="${nombreProducto}">
                <input type="hidden" name="precio[]" value="${precio}">
                <input type="hidden" name="cantidad[]" value="${cantidad}">
                
                <td >${proveedorNombre}</td>

                <td class="nombreProducto">${nombreProducto}</td>
                <td>${precio}</td>
                <td id="cantidad-${cont}">${cantidad}</td>
                <td id="subtotal-${cont}">${cantidad * precio}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="eliminarCompra(${cont}, ${parseInt(cantidad) * parseInt(precio)})">Eliminar</button>
                </td>
                </tr>
            `);
            
            /* let subtotal = parseInt($("#subtotal-"+cont).text()); */

            cont++;




            let precioTotal = $("#precioTotal").text() || "0";
           
         
            $("#precioTotal").text(parseInt(precioTotal) + parseInt(cantidad) * parseInt(precio));
            $("#precioTotalDb").val(parseInt(precioTotal) + parseInt(cantidad) * parseInt(precio));

        } else {
            swal.fire('La cantidad y el producto no deben ser menor o igaual a cero');
        }
        $('#form')[0].reset();
        console.log($(".nombreProducto").text());
    }

    function eliminarCompra(proveedor, subtotal) {
        $('#tr-' + proveedor).remove();
        let precioTotal = $("#precioTotal").text() || "0";

        $("#precioTotal").text(parseInt(precioTotal) - subtotal);
    }

   /*  function actualizarCantidad(id, cantidad) {
        let cantidadTable = $("#cantidad-" + id).text(parseInt(cantidad) + parseInt($("#cantidad-" + id).text()));
        let subtotal = $("#subtotal-"+id).text();
        $("#subtotal-"+id).text(parseInt(subtotal)*parseInt(cantidad) + parseInt($("#cantidad-" + id).text()));
        let precioTotal = $("#precioTotal").text() || "0";
        $("#precioTotal").text(parseInt(precioTotal) +  parseInt(subtotal)*parseInt(cantidad) + parseInt($("#cantidad-" + id).text()));
        console.log(cantidadTable);
      
    } */
</script>
@endsection