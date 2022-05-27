@extends('layouts.app')

@section('content')
    <div class="box p-5">
        <form action="/ventas/guardar" method="POST" class="mb-5 py-5" id="form">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 lg:col-span-4">
                    <h2 class="text-3xl text-center font-medium leading-none mt-3">Registrar una venta</h2>

                    @csrf
                    <div class="preview mt-5">
                        <div class="">
                            <input type="hidden" name="Documento" id="Documentodb">
                            <label for="">Documento Del Cliente:</label>

                            <div class="mt-2">
                                <select class="input border  w-full " name="Documento" id="Documento"
                                    onchange="colocar_nombre()">

                                    <option selected="true" disabled="disabled">------ Seleccione -----</option>
                                    @foreach ($clientes as $value)
                                        <option nombre="{{ $value->Nombre_Cliente }}" value="{{ $value->id }} "
                                            {{ old('Documento') == $value->id ? 'selected' : '' }}>
                                            {{ $value->Documento_Cliente }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mt-5">
                                <label for="">Nombre Del Cliente:</label>

                                <input type="text" id="nombre" readonly name="nombreC"
                                    class="input w-full border bg-gray-200 mt-2 cursor-not-allowed @error('nombreC') border-theme-6 @enderror"
                                    min="1" value="{{ old('nombreC') }}">
                                @error('nombreC')
                                    <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>
                            @if (auth()->user()->rol_id == 1)
                                <div class="mt-5">
                                    <a href="/clientes/crear">¿No tienes al cliente registrado? ¡Registralo aqui!</a>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="preview mt-5">
                        <div>
                            <label for="">Producto:</label>
                            <div class="mt-2">
                                <select name="" id="Producto" class="input  border w-full  mr-2 "
                                    onchange="obtener_precio()">

                                    <option selected="true" disabled="disabled">------ Seleccione -----</option>
                                    @foreach ($productos as $value)
                                        <option precio="{{ $value->Precio_Venta }}"
                                            cantidadExistencia="{{ $value->Cantidad }}" value="{{ $value->id }}">
                                            {{ $value->Nombre_Producto }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="mt-5">
                        <input type="hidden" name="total" id="precioTotal">

                        <label for="precio">Precio:</label>

                        <input type="text" id="precio" readonly name=""
                            class="input w-full border bg-gray-200 mt-2 cursor-not-allowed @error('precio') border-theme-6 @enderror"
                            min="1" value="{{ old('precio') }}">
                        @error('precio')
                            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <label for="">Cantidad:</label>

                        <input type="number" onkeyup="ValidadExistencia()" id="cantidad" name="cantidad"
                            class="input w-full border mt-2 @error('cantidad') border-theme-6 @enderror"
                            placeholder="Ingrese la cantidad del producto" min="1" value="{{ old('cantidad') }}">
                        @error('cantidad')
                            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="flex justify-between">
                        <a href="/ventas" class="button  border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
                        <button type="button" class="button bg-theme-1 text-white mt-5 " onclick="agregar()">Agregar
                            Producto</button>
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
                        <button type="submit" id="btnGuardar"
                            class="button w-full mr-1 mb-2 bg-theme-1 text-white ">Guardar</button>
                    </div>
                </div>
            </div>


        </form>
    </div>
@endsection

@section('script')
    <script>
        function obtener_precio() {
            let Precio_Compra = $("#Producto option:selected").attr("precio");
            $("#precio").val(Precio_Compra);
        }

        function colocar_nombre(e) {
            let nombre = $("#Documento option:selected").attr("nombre");
            $("#nombre").val(nombre);

            document.querySelector("#Documento").setAttribute("disabled", "true");
            document.querySelector("#Documentodb").value = $("#Documento option:selected").val();
        }


        const ValidadExistencia = () => {

            let cantidadExistencia = $("#Producto option:selected").attr("cantidadExistencia");
            let cantidadSeleccionada = $("#cantidad").val();

            if (parseInt(cantidadExistencia) < parseInt(cantidadSeleccionada)) {
                alert("La cantidad seleccionada es mayor a la existencia");
                $("#cantidad").val(1);
            }
        }


        let cont = 0;

        function agregar() {
            let producto_id = $("#Producto option:selected").val();
            let producto_text = $("#Producto option:selected").text();
            let cantidad = $("#cantidad").val();
            let precio = $("#precio").val();
            let subtotal = parseInt(precio) * parseInt(cantidad);
            let cantidades = document.querySelectorAll(".cantidades");
            let subTotal = document.querySelectorAll(".subtotal");
            let cantidadesDb = document.querySelectorAll(".cantidadesDb");
            let nombreProductos = document.querySelectorAll(".nombreProductos");
            let encontrado = true;


            let cantidadExistencia = $("#Producto option:selected").attr("cantidadExistencia");

            nombreProductos.forEach((element, index) => {



                if (element.textContent.trim() === producto_text.trim()) {
                    let cantidadFinal = parseInt($("#cantidad").val()) + parseInt(cantidades[index].textContent);

                    if (cantidadFinal > cantidadExistencia) {
                        alert("error no se puede agregar mas este producto, la cantidad es insuficiente.");
                    } else {
                        let nuevaCantidad = parseInt(cantidades[index].textContent) + parseInt(cantidad);
                        cantidades[index].textContent = nuevaCantidad;
                        cantidadesDb[index].value = nuevaCantidad;
                        subtotal = parseInt(precio) * nuevaCantidad;
                        subTotal[index].textContent = subtotal;
                    }
                    encontrado = false;
                }
            });
            if (encontrado) {
                if (cantidad >= 0 && precio >= 0) {
                    $("#tbl_productos").append(`
                        <tr id="tr-${producto_id}">
                        <td class="nombreProductos">
                        <input type="hidden" name="Producto[]" value="${producto_id}" />
                        <input type="hidden" name="cantidades[]" value="${cantidad}" class="cantidadesDb"  />
                        <input type="hidden" name="precios[]" value="${precio}" /> 
                        ${producto_text}
                        </td>
                        <td class="cantidades">${cantidad}</td>
                        <td>${precio}</td>
                        <td class="subtotal">${subtotal}</td>

                        <td>
                            <button type="button" class="button w-24 mr-1 mb-2 bg-theme-6 text-white" onclick="eliminar(${producto_id}, ${parseInt(subtotal)})">x</button>
                        </td>
                        </tr>
                    `);

                } else {
                    swal.fire('La cantidad y el precio del producto no pueden estar vacios o ser menor o igual a cero');
                }
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

            console.log(total);
        }

        function eliminar(id, subtotal) {

            $("#tr-" + id).remove();

            let total = $("#total").text();
            console.log(total);
            $("#total").text(parseInt(total) - subtotal);
        }
    </script>
@endsection
