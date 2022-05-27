@extends('layouts.app') @section('content')
<div class="box p-5">
    <form action="/compra/guardar" method="POST" class="mb-5 py-5" id="form">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-4">
                <h2 class="text-3xl text-center font-medium leading-none mt-3">
                    Registrar una compra
                </h2>

                @csrf
                <div class="preview mt-5">
                    <div class="">
                        <input type="hidden" name="proveedor_id" id="proveedorDb">
                        <label for="proveedor_id">Proveedor:</label>

                        <div class="mt-2">
                            <select class="input  border w-full" onchange="deshabilitar_proveedor()" id="proveedor">
                                <option selected="true" disabled="disabled">
                                    ------ Seleccione -----
                                </option>
                                @foreach($proveedores as $value)
                                <option value="{{$value->id}}">
                                    {{$value->Nombre_Proveedor}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @if (auth()->user()->rol_id == 1)
                        <div class="mt-5">
                            <a href="/proveedor/crear">¿No tienes al proveedor registrado? ¡Registralo aqui!</a>
                        </div>
                        @endif

                    </div>
                </div>
                <div class="preview mt-5">
                    <div>
                        <label for="">Producto:</label>
                        <div class="mt-2">
                            <select class="input  border w-full mr-2" onchange="obtener_precio()" id="nombreProducto">
                                <option selected="true" disabled="disabled">
                                    ------ Seleccione -----
                                </option>
                                @foreach($productos as $value)
                                <option precio="{{$value->Precio_Compra}}" value="{{$value->id}}">
                                    {{ $value->Nombre_Producto }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <input type="hidden" name="total" id="precioTotal" />

                    <label for="precio">Precio:</label>

                    <input type="text" id="precio" readonly class="input w-full border bg-gray-200 mt-2 cursor-not-allowed @error('Precio') border-theme-6 @enderror" min="1" value="{{ old('Precio') }}" />
                    @error('Precio')
                    <div class="text-theme-6 mt-2">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="mt-5">
                    <label for="cantidad">Cantidad:</label>

                    <input type="number" id="cantidad" class="input w-full border mt-2 @error('Cantidad') border-theme-6 @enderror" placeholder="Ingrese la cantidad del producto" min="1" value="{{ old('Cantidad') }}"  onkeyup="validarCantidad()"/>
                    @error('Cantidad')
                    <div class="text-theme-6 mt-2">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="flex justify-between">
                    <a href="/compra" class="button border bg-gray-600 text-white mr-2 mt-5">Volver</a>
                    <button type="button" class="button bg-theme-1 text-white mt-5" onclick="agregar()">
                        Agregar Producto
                    </button>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-8">
                <div class="mt-5">
                    <h2 class="text-3xl text-center font-medium leading-none mt-3">
                        Productos agregados
                    </h2>
                    <div class="overflow-x-auto">
                    <table class="table mt-5  dtr-inline  dt-responsive">
                        <thead>
                            <tr class="bg-gray-700 text-white">
                                <th class="border-b-2 whitespace-no-wrap">
                                    Producto
                                </th>
                                <th class="border-b-2 whitespace-no-wrap">
                                    Cantidad
                                </th>
                                <th class="border-b-2 whitespace-no-wrap">
                                    Precio
                                </th>
                                <th class="border-b-2 whitespace-no-wrap">
                                    Subtotal
                                </th>
                                <th class="border-b-2 whitespace-no-wrap">
                                    Eliminar
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tblCompra"></tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-center">
                                    Total: <b id="total">0</b>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                    <button type="submit" class="button w-full mr-1 mb-2 bg-theme-1 text-white">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection @section('script')
<script>
    $(document).ready(function() {
        $('#form').validate({ // initialize the plugin
            rules: {
                proveedor: {
                    required: true,
                    number: true
                },
                nombreProducto: {
                    required: true,
                    number: true
                },
                cantidad: {
                    required: true,
                    number: true,
                    minlength: 1,
                }

            },
            errorElement: 'span'


        });
    });
</script>
<script>
    function deshabilitar_proveedor() {
        document.querySelector("#proveedor").setAttribute("disabled", "true");
        document.querySelector("#proveedorDb").value = $("#proveedor option:selected").val();
    }

    function obtener_precio() {
        let Precio_Compra = $("#nombreProducto option:selected").attr("precio");
        $("#precio").val(Precio_Compra);
    }


    const validarCantidad  = () => {
        let cantidad = $("#cantidad").val();

        let cantidadCadena = cantidad.split('');

        if(parseInt(cantidadCadena[0]) === 0){
            swal.fire("No se puede comenzar con un 0");
        }

    }
    function agregar() {
        let proveedor_id = $("#proveedor option:selected").val();
        let id = $("#nombreProducto option:selected").val();
        let nombreProducto = $("#nombreProducto option:selected").text();
        let precio = $("#precio").val();
        let cantidad = $("#cantidad").val();
        let subtotal = parseInt(precio) * parseInt(cantidad);
        let cantidades = document.querySelectorAll(".cantidades");
        let cantidadesDb = document.querySelectorAll(".cantidadesDb");
        let subTotal = document.querySelectorAll(".subtotal");
        let nombreProductos = document.querySelectorAll(".nombreProductos");
        let encontrado = true;
    
        if (parseInt(proveedor_id) > 0 && parseInt(id) > 0 && cantidad >= 0 && precio >= 0) {
            nombreProductos.forEach((element, index) => {
                if (element.textContent.trim() === nombreProducto.trim()) {
                    let nuevaCantidad = parseInt(cantidades[index].textContent) + parseInt(cantidad);
                    cantidades[index].textContent = nuevaCantidad;
                    cantidadesDb[index].value = nuevaCantidad;
                    subtotal = parseInt(precio) * nuevaCantidad;
                    subTotal[index].textContent = subtotal;
                    encontrado = false;

                }
            });


            if (encontrado) {
                if (cantidad >= 0 && precio >= 0) {
                    $("#tblCompra").append(`
            
                <tr id="tr-${id}">
                
                <td class="nombreProductos">
                <input type="hidden" name="idP[]" value="${id}">
                    <input type="hidden" name="precios[]" value="${precio}">
                    <input type="hidden" name="cantidades[]" class="cantidadesDb"  value="${cantidad}">
                    ${nombreProducto}
                </td>
                <td class="cantidades">${cantidad}</td>
                <td>${precio}</td>
                <td class="subtotal">${subtotal}</td>

                <td>
                    <button type="button" class="button w-24 mr-1 mb-2 bg-theme-6 text-white" onclick="eliminar(${id})">x</button>
                </td>
                </tr>
            `);
                } else {
                    swal.fire(
                        "La cantidad y el precio del producto no pueden estar vacios o ser menor o igual a cero"
                    );
                }
            }
            _subtotal();
        } else {

            swal.fire(
                "La cantidad y el precio del producto no pueden estar vacios o ser menor o igual a cero"
            );
        }


    }


    function limpiar() {
        document.getElementById("precio").value = "";
        document.getElementById("cantidad").value = "";
    }

    function _subtotal() {
        let total = 0;
        $(".subtotal").each(function(i, e) {
            total += parseInt(e.innerHTML);
        });

        $("#total").text(total);
        $("#precioTotal").val(parseInt(total));
    }

    function eliminar(id) {
        $("#tr-" + id).remove();
        let total = 0;
        $(".subtotal").each(function(i, e) {
            total -= total - parseInt(e.innerHTML);
        })

        $("#total").text(total);
    }
</script>


@endsection