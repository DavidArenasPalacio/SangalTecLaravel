@extends('layouts.app')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-4">
        <h2 class="text-3xl text-center font-medium leading-none mt-3">Registrar Venta</h2>
        <form action="/ventas/guardar" method="POST" class="mb-5 py-5" id="form">
            @csrf
            <div class="preview mt-5">
                <div class="">
                    <label for="">Documento Del Cliente:</label>

                    <div class="mt-2">
                        <select class="select2   w-full " name="Documento"  id="Documento" onchange="colocar_nombre()">

                            <option selected="true" disabled="disabled">------ Seleccione -----</option>
                            @foreach($clientes as $value)
                            <option nombre="{{$value->Nombre_Cliente}}" value="{{ $value->id }} " {{old('Documento')==$value->id ? 'selected' : ''}}>{{ $value->Documento_Cliente }}</option>
                            @endforeach

                        </select>
                    </div>
<<<<<<< HEAD
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
=======
                    <div class="mt-5">        
                            <label for="">Nombre Del Cliente:</label>
>>>>>>> 4c3e74f9a70be13fb7adcc54497969261f8749d9
        
                            <input type="text" id="nombre" readonly name="nombreC" class="input w-full border bg-gray-200 mt-2 cursor-not-allowed @error('nombreC') border-theme-6 @enderror" min="1" value="{{old('nombreC')}}">
                            @error('nombreC')
                            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>
                </div>
                <div class="preview mt-5">
                    <div>
                        <label for="">Producto:</label>
                        <div class="mt-2">
                            <select name="Producto" id="Producto" class="select2  w-full  mr-2 " onchange="obtener_precio()" >

                                <option selected="true" disabled="disabled">------ Seleccione -----</option>
                                @foreach($productos as $value)
                                <option precio="{{$value->Precio_Venta}}" value="{{$value->id}}" {{old('Producto')==$value->id  ? 'selected' : ''}}>{{ $value->Nombre_Producto }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                </div>
                <div class="mt-5">
                <input type="hidden" name="total" id="precioTotal">

                    <label for="precio">Precio:</label>

                    <input type="text" id="precio" readonly name="precio" class="input w-full border bg-gray-200 mt-2 cursor-not-allowed @error('precio') border-theme-6 @enderror" min="1" value="{{old('precio')}}">
                    @error('precio')
                    <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <div class="mt-5">
                    <label for="">Cantidad:</label>

                    <input type="number" id="cantidad" name="cantidad" class="input w-full border mt-2 @error('cantidad') border-theme-6 @enderror" placeholder="Ingrese la cantidad del producto" min="1" value="{{old('cantidad')}}">
                    @error('cantidad')
                    <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <div class="flex justify-between">
                    <a href="/ventas" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
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

        let Precio_Compra = $("#Producto option:selected").attr("precio");
        $("#precio").val(Precio_Compra);

        // let id = $("#producto option:selected").val();

        // $.ajax({
        //     url: `/compra/obtenerPrecio/${id}`,
        //     type: 'GET',
        //     success: function(respu) {
        //         console.log(respu.Precio_Compra);
        //         // $("#precio").val(respu.Precio);
        //     }
        // })
        /* .done(function(respuesta) {
                console.log(respuesta);
                if (respuesta != 0) {
                    $("#precio").val(respuesta);
                }
                
            }).fail(function(error) {

            }); */
    }

function colocar_nombre(e){

    let nombre = $("#Documento option:selected").attr("nombre");           
    $("#nombre").val(nombre);
}

    let cont = 0;

    function agregar() {
        let producto_id = $("#Producto option:selected").val();
        let producto_text = $("#Producto option:selected").text();
        let cantidad =  $("#cantidad").val();
        let precio = $("#precio").val();

        let subtotal = parseInt(precio) * parseInt(cantidad);
        
<<<<<<< HEAD
        $("tbl_productos").append(` 
=======
        // let separar = nombre.split("-");
>>>>>>> 4c3e74f9a70be13fb7adcc54497969261f8749d9

        // if (parseInt(cantidad) <= parseInt($.trim(separar[1]))) {
            if ( cantidad >= 0 && precio >= 0) {

            // if (parseInt(cantidad) > 0) {
            //     let nuevaCantidad = parseInt($.trim(separar[1])) - parseInt(cantidad);
            //     console.log(nuevaCantidad);
            //     $("#producto option:selected").text($.trim(separar[0]) + " - " + nuevaCantidad);


                $("#tbl_productos").append(`
                <tr id="tr-${producto_id}">
                <input type="hidden" name="Producto[]" value="${producto_id}" />
                <input type="hidden" name="cantidades[]" value="${cantidad}" />
                <input type="hidden" name="precios[]" value="${precio}" /> 
            

                <td>${producto_text}</td>
                <td>${cantidad}</td>
                <td>${precio}</td>
                <td class="subtotal">${subtotal}</td>

                <td>
                    <button type="button" class="button w-24 mr-1 mb-2 bg-theme-6 text-white" onclick="eliminar(${producto_id}, ${parseInt(subtotal)})">x</button>
                </td>
<<<<<<< HEAD
            </tr>
        `)
=======
                </tr>
            `);
            console.log(id);
        console.log(nombreProducto);
        console.log(precio);
        console.log(cantidad);
        console.log(subtotal);
            // } else {
>>>>>>> 4c3e74f9a70be13fb7adcc54497969261f8749d9

            // }

        } else {
            swal.fire('La cantidad y el precio del producto no pueden estar vacios o ser menor o igual a cero');
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

    function eliminar(id, subtotal) {

        $("#tr-"+id).remove();

        let total = $("#total").text();
        console.log(total);
        $("#total").text(parseInt(total) - subtotal);
    }

    $('#btnGuardar').click((e) => {
        let form = $('#form');
        e.preventDefault();
        Swal.fire({
            title: '¿Desea crear la venta?',
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