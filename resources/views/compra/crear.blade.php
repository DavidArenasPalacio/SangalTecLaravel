@extends('layouts.app')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-4">
        <h2 class="text-3xl text-center font-medium leading-none mt-3">Agregar Compra</h2>
        <form action="/compra/guardar" method="POST" class="mb-5 py-5" id="form">
            @csrf
            <div class="preview mt-5">
                <div class="">
                    <label for="proveedor_id">Proveedor:</label>

                    <div class="mt-2">
                        <select class="select2   w-full " name="proveedor_id" id="proveedor_id">

                            <option selected="true" disabled="disabled">------ Seleccione -----</option>
                            @foreach($proveedores as $value)
                            <option value="{{$value->id}}">{{$value->Nombre_Proveedor}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="preview mt-5">
                    <div>
                        <label for="producto">Producto:</label>
                        <div class="mt-2">
                            <select class="select2  w-full  mr-2 " onchange="obtener_precio()" id="producto">

                                <option selected="true" disabled="disabled">------ Seleccione -----</option>
                                @foreach($productos as $value)
                                <option value="{{$value->id}}">{{$value->Nombre_Producto}} - {{$value->Cantidad}}
                                </option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                </div>
                <div class="mt-5">
                <input type="hidden" name="total" id="precioTotal">

                    <label for="precio">Precio:</label>

                    <input type="text" id="precio" readonly name="Precio" class="input w-full border bg-gray-200 mt-2 cursor-not-allowed @error('Precio') border-theme-6 @enderror" min="1" value="{{old('Precio')}}">
                    @error('Precio')
                    <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <div class="mt-5">
                    <label for="cantidad">Cantidad:</label>

                    <input type="number" id="cantidad" name="Cantidad" class="input w-full border mt-2 @error('Cantidad') border-theme-6 @enderror" placeholder="Ingrese la cantidad del producto" min="1" value="{{old('Cantidad')}}">
                    @error('Cantidad')
                    <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <div class="flex justify-between">
                    <a href="/compra" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
                    <button type="button" class="button bg-theme-1 text-white mt-5 " onclick="agregar()">Agregar Compra</button>
                </div>
            </div>


        
    </div>

    <div class="intro-y col-span-12 lg:col-span-8">

        <div class="mt-5">
            <h2 class="text-3xl text-center font-medium leading-none mt-3">Productos agregados</h2>
            <table class="table mt-5">

                <thead>
                    <tr class="bg-gray-700 text-white">
                        <th class="border-b-2 whitespace-no-wrap">Producto</th>
                        <th class="border-b-2 whitespace-no-wrap">Cantidad</th>
                        <th class="border-b-2 whitespace-no-wrap">Precio</th>
                        <th class="border-b-2 whitespace-no-wrap">Subtotal</th>
                        <th class="border-b-2 whitespace-no-wrap">Eliminar</th>
                    </tr>
                </thead>
                <tbody id="tbl_productos">

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-center">
                            Total: <b id="total">0</b>
                        </th>
                    </tr>
                </tfoot>
            </table>
            <button type="button" id="btnGuardar" class="button w-full mr-1 mb-2 bg-theme-1 text-white ">Guardar</button>
        </div>
    </div>
</form>
</div>
@endsection

@section('script')
<script>
    function obtener_precio() {
        let id = $("#producto option:selected").val();
        console.log(id);
        $.ajax({
            url: `/compra/obtenerPrecio/${id}`,
            type: 'GET',
            success: function(respu) {
                console.log(respu.Precio_Compra);
                $("#precio").val(respu.Precio_Compra);
            }
        })
        /* .done(function(respuesta) {
                console.log(respuesta);
                if (respuesta != 0) {
                    $("#precio").val(respuesta);
                }
                
            }).fail(function(error) {

            }); */
    }

    let cont = 0;

    function agregar() {
        let proveedor = $("#proveedor option:selected").val();
        let id = $("#producto option:selected").val();
        let nombre = $("#producto option:selected").text();
        let precio = $("#precio").val();
        let cantidad = $("#cantidad").val();

        let subtotal = parseInt(precio) * parseInt(cantidad);
        let separar = nombre.split("-");

        if (parseInt(cantidad) <= parseInt($.trim(separar[1]))) {
            if (parseInt(cantidad) > 0) {
                let nuevaCantidad = parseInt($.trim(separar[1])) - parseInt(cantidad);
                console.log(nuevaCantidad);
                $("#producto option:selected").text($.trim(separar[0]) + " - " + nuevaCantidad);


                $("#tbl_productos").append(`
        <tr id="datos${id}" >
        <input type="hidden" name="proveedor_id" value="${proveedor}">
                <input type="hidden" name="nombreProducto[]" value="${$.trim(separar[0])}">
                <input type="hidden" name="precio[]" value="${precio}">
                <input type="hidden" name="cantidad[]" value="${cantidad}">
                
           <td class="productos" id="${id}">${$.trim(separar[0])}</td>
           <td class="cantidades">${cantidad}</td>
           <td>${precio}</td>
            <td class="subtotal">${subtotal}</td>

           <td>
                <button type="button" class="button w-24 mr-1 mb-2 bg-theme-6 text-white" onclick="eliminar(${id}, ${parseInt(subtotal)})">  <i data-feather="trash-2" class="mx-auto"></i></button>
           </td>
        </tr>
    `);

            } else {

            }

        } else {
            alert("La cantidad debe ser mayor a cero actual!!");
        }
        _subtotal();
        
    }

    function limpiar() {


        document.getElementById("precio").value = "";
        document.getElementById("cantidad").value = "";
    }


    function _subtotal() {
        let total = 0;
        $(".subtotal").each(function(i, e) {
            total += parseInt(e.innerHTML);
        })

        $("#total").text(total);
        $("#precioTotal").val(parseInt(total));
    }

    function eliminar(pos, subtotal) {


        let id = $(`#datos${pos}`);

        id.remove();
        let total = $("#total").text();
        console.log(total);
        $("#total").text(parseInt(total) - subtotal);
    }

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
</script>

<script>
    $('select').select2({
        language: {

            noResults: function() {

                return "No hay resultado";
            },
            searching: function() {

                return "Buscando..";
            }
        }
    });
</script>
@endsection