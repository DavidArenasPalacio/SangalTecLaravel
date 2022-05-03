@extends('layouts.app')

@section('content')

<div class="container">
    <form action="/compra/guardar" method="post" id="form">
        @csrf
        
<div class="card">
    <div class="card-header text-center">
        <h4>Registrar Compra</h4>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-6">
                <div class="row card">
                    <div class="card-header">
                        <h4 class="text-center">Informacion Del Proveedor</h4>
                    </div>
                    <div class="row text-center card-body d-flex justify-content-center ">
                        <div class="form-group col-12">
                            <label for="">Nombre Del Proveedor</label>

                            <select name="proveedor"  id="proveedor" class="js-example-basic-single form-control @error('proveedor') is-invalid @enderror">
                                <option value="">Seleccionar Proveedor</option>
                                @foreach($proveedor as $value)
                            <option nombre="{{$value->Nombre_Proveedor}}" value="{{ $value->id }} " {{old('proveedor')==$value->id ? 'selected' : ''}}>{{ $value->Nombre_Proveedor }}</option>
                            @endforeach
                            </select>
                            @error('proveedor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-5">
                            <label for="">Precio Total De La Venta</label>
                            <input id="precioTotal" type="text" name="precioTotal" class="form-control @error('precioTotal') is-invalid @enderror" value="{{old('')}}" readonly>
                            @error('precioTotal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div style="margin-top: 4%" class="form-group col-4">
                            <button type="submit" class="btn btn-success" id="btnGuardar">Registrar Compra</button>     
                        </div> 
                        <div style="margin-top: 4%" class="form-group col-3">
                            <a href="/compra" class="btn btn-primary float-right"  >Volver</a>     
                        </div>
                        
                        @if (auth()->user()->rol_id == 3)
                        <div class="">
                            <a href="/proveedor/crear" style="color:#1b0ed1;">¡Registra Un Proveedor Aqui!</a>
                        </div> 
                        @endif
                        
                    </div>                    
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Informacion De La Compra</h4>
                    </div>
                    <div class="row text-center card-body d-flex justify-content-center">
                        <div class="form-group col-6">
                            <label for="">Nombre Del Producto</label>
                
                            <select name="nombreProducto" id="nombreProducto" class="@error('nombreProducto') is-invalid @enderror form-control" onchange="precioProducto()" style=""> 
                                <option value="">Seleccionar Producto</option>
                                @foreach($productos as $value)
                            <option precio="{{$value->Precio}}" value="{{ $value->id }} " {{old('nombreProducto')==$value->id  ? 'selected' : ''}}>{{ $value->Nombre_Producto }}</option>
                            @endforeach
                            </select>
                            @error('nombreProducto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> 
                        
                        <div class="form-group col-3">
                            <label for="">Cantidad</label>
                            <input type="number" style="width: 80%" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" value="{{old('cantidad')}}">
                            @error('cantidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-3">

                            <input type="hidden" name="total" id="precioTotalDb">

                            <label for="">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" value="{{old('precio')}}" readonly>
                            {{-- @error('precio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror --}}
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-success float-right" onclick="agregarCompra()" >Agregar Producto</button>
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

                        <tbody id="tblCompra">

                        </tbody>

                    </table>
                    
                </div>  
            </div>
        </div>
    </form>
</div>
    </div>
</div>

        
@endsection 

@section('script')

<script>
        

    function precioProducto(){
        let precio = $("#nombreProducto option:selected").attr("precio");
        $("#precio").val(precio);
    }


    function agregarCompra() {

        let proveedor = $("#proveedor option:selected").val();
        let proveedorNombre = $("#proveedor option:selected").text();
        let nombreProducto = $("#nombreProducto option:selected").text()
        let precio = $("#precio").val();
        let cantidad = $("#cantidad").val();

        console.log(precio);
        console.log(cantidad);
        let cont = 0;
        if (cantidad >= 0 && precio >= 0) {


                $("#tblCompra").append(`
                <tr id="tr-${cont}">
                <input type="hidden" name="proveedor_id" value="${proveedor}">
                <input type="hidden" name="nombreProducto[]" value="${nombreProducto}">
                <input type="hidden" name="precios[]" value="${precio}">
                <input type="hidden" name="cantidades[]" value="${cantidad}">
            

                <td class="nombreProducto">${nombreProducto}</td>
                <td id="cantidad-${cont}">${cantidad}</td>
                <td>${precio}</td>
                <td id="subtotal-${cont}">${cantidad * precio}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="eliminarCompra(${cont}, ${parseInt(cantidad) * parseInt(precio)})">Eliminar</button>
                </td>
                </tr>
            `);
            
            /* let subtotal = parseInt($("#subtotal-"+cont).text()); */

            cont++;



        // let precio_venta = $("#precio_venta").val() || 0;
        // $("#precio_venta").val(parseInt(precio_venta) + parseInt(cantidad) * parseInt(precio));

            let precioTotal = $("#precioTotal").val() || "0";
        
            $("#precioTotal").val(parseInt(precioTotal) + parseInt(cantidad) * parseInt(precio));
            $("#precioTotalDb").val(parseInt(precioTotal) + parseInt(cantidad) * parseInt(precio));

            console.log(precioTotal);
        } else {
            swal.fire('La cantidad y el precio del producto no pueden estar vacios o ser menor o igual a cero');
        }
        // $('#form')[0].reset();
        console.log($(".nombreProducto").text());
    }

    function eliminarCompra(proveedor, subtotal) {
        $('#tr-' + proveedor).remove();
        let precioTotal = $("#precioTotal").text() || "0";

        
        $("#precioTotal").val(parseInt(precioTotal) - subtotal);

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
