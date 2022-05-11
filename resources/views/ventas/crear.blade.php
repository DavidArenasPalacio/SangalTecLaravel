@extends('layouts.app') @section('titulo')
<h1 style="text-align: center">Registrar Una Venta</h1>
@endsection @section('content')

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

<div class="container">
    <form id="formVe" action="/ventas/guardar" method="POST">
        @csrf 
    
        {{-- @foreach ($ventasdetalle as $value) --}}
        <div class="row">
            <div class="col-6">
                <div class="row card">
                    <div class="card-header">
                        <h4 class="text-center">Informacion Del Cliente</h4>
                    </div>
                    <div class="row text-center card-body d-flex justify-content-center ">
                        <div class="form-group col-6">
                            <label for="">Documento Del Cliente</label>

                            <select name="DocumentoC"  id="DocumentoC" class="form-control" onchange="colocar_nombre()">
                                <option value="">--Seleccionar Documento--</option>
                                @foreach($clientes as $value)
                            <option nombre="{{$value->Nombre_Cliente}}" value="{{ $value->idCliente }} " {{old('DocumentoC')==$value->idCliente ? 'selected' : ''}}>{{ $value->Documento }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Nombre Del Cliente</label>
                            <input type="text" name="nombreC" id="nombre" value="{{old('nombreC')}}" readonly />
                        </div>
                        <div class="form-group col-6">
                            <label for="">Precio Total De La Venta</label>
                            <input id="precio_venta" type="number" name="precio_venta" value="{{old('precio_venta')}}" readonly>
                        </div>   
                        <div style="margin-top: 4%" class="form-group col-6">
                            <button type="submit" class="btn btn-success">Registrar Venta</button>
                            
                            <a href="/ventas" class="btn btn-danger float-right"  >Volver</a>
                            
                        </div>                                           
                    </div>                    
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Informacion De La Venta</h4>
                    </div>
                    <div class="row text-center card-body d-flex justify-content-center">
                        <div class="form-group col-6">
                            <label for="">Nombre Del Producto</label>
                            {{-- <input style="width: 80%" type="text" name="" value="{{$value->NombreP}}" disabled> --}}
                            <select name="ProductoN" id="ProductoN" class="form-control" onchange="colocar_precio()"> 
                                <option value="">--Seleccione Producto--</option>
                                @foreach($productos as $value)
                            <option precio="{{$value->Precio}}" value="{{ $value->idProducto }} " {{old('ProductoN')==$value->idProducto  ? 'selected' : ''}}>{{ $value->Nombre_Producto }}</option>
                            @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group col-3">
                            <label for="">Cantidad</label>
                            <input id="cantidad" style="width: 80%" type="number" name="cantidad" value="{{old('cantidad')}}" />
                        </div>
                        <div class="form-group col-3">
                            <label for="">Precio</label>
                            <input id="precio" style="width: 80%" type="text" name="precio" value="{{old('precio')}}" readonly>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-success float-right" onclick="agregar_producto()" >Agregar Producto</button>
                        </div>
                    </div>    
                        <table id="table" class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nombre</th>                      
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Sub Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="#tbl_productos">
                                
                            </tbody>
                        </table>    
                </div>
            </div>
        </div>

        {{-- @endforeach --}}
    </form>
</div>

@endsection
@section('script')


    <script>
        
        function colocar_precio(e){

            let precio = $("#ProductoN option:selected").attr("precio");           
            $("#precio").val(precio);
        }

        function colocar_nombre(e){

        let nombre = $("#DocumentoC option:selected").attr("nombre");           
        $("#nombre").val(nombre);
}

    function agregar_producto(){

    let producto_id = $("#ProductoN option:selected").val();
    let producto_text = $("#ProductoN option:selected").text();
    let cantidad =  $("#cantidad").val();
    let precio = $("#precio").val();

    // console.log(producto_id);
    // console.log(producto_text);
    // console.log(cantidad);
    // console.log(precio);

    if (cantidad > 0 && precio >0) {

        
        $("tbl_productos").append(` 

            <tr id="tr-${producto_id}">                        
                <td>
                    <input type="hidden" name="ProductoN[]" value="${producto_id}" />
                    <input type="hidden" name="cantidades[]" value="${cantidad}" />
                    <input type="hidden" name="precios[]" value="${precio}" />
                    ${producto_text}
                </td>
                <td>${cantidad}</td>
                <td>${precio}</td>
                <td>${parseInt(cantidad) * parseInt(precio)}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="cancelar_producto(${producto_id}, ${parseInt(cantidad) * parseInt(precio)})">Eliminar</button>    
                </td>
            </tr>
        `)

        let precio_venta = $("#precio_venta").val() || 0;
        $("#precio_venta").val(parseInt(precio_venta) + parseInt(cantidad) * parseInt(precio));
        
    }else
        alert("Ingrese cantidad y/o precio");


}

function cancelar_producto(producto_id, subtotal){

    $("#tr-" + producto_id).remove();

    let precio_venta = $("#precio_venta").val();
    $("#precio_venta").val(parseInt(precio_venta) - subtotal);

    console.log(precio_venta);
}
    </script>


{{-- Sweetalert2 --}}

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    $('#formVe').submit(function(e){
    
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        })
    
        swalWithBootstrapButtons.fire({
            title: '¿Desea Registrar La Venta?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                'Se Registró La Venta Correctamente',
                '',
                'success'
                )
                this.submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'La Venta No Fue Registrada',
                '',
                'error'
                )
            }
        })
    
    });
    
    </script>
@endsection
