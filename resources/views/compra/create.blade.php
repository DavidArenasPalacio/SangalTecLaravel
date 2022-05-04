@extends('layouts.app')

@section('content')
<h1 class="text-center text-4xl font-medium">Crear Compra</h1>

<form action="/compra/guardar" method="POST" class="mb-5 py-5" id="form">
    @csrf
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-3">
            <div>
                <label for="proveedor_id">Proveedor:</label>

                <select class="select2 w-full " name="proveedor_id" id="proveedor_id">

                    <option selected="true" disabled="disabled">------ Seleccione -----</option>
                    @foreach($proveedores as $value)
                    <option value="{{$value->id}}">{{$value->Nombre_Proveedor}}</option>
                    @endforeach

                </select>
            </div>
            <div class="mt-5">
                <label for="producto">Producto:</label>

                <select class="select2 w-full " onchange="obtener_precio()" id="producto">

                    <option selected="true" disabled="disabled">------ Seleccione -----</option>
                    @foreach($productos as $value)
                    <option value="{{$value->id}}">{{$value->Nombre_Producto}}</option>
                    @endforeach

                </select>
            </div>
            <div class="mt-5">
                <label for="precio">Precio:</label>

                <input type="text" id="precio" disabled name="Precio"
                    class="input w-full border bg-gray-200 mt-2 @error('Precio') border-theme-6 @enderror" min="1"
                    value="{{old('Precio')}}">
                @error('Precio')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="mt-5">
                <label for="cantidad">Cantidad:</label>

                <input type="number" id="cantidad" name="Cantidad"
                    class="input w-full border mt-2 @error('Cantidad') border-theme-6 @enderror"
                    placeholder="Ingrese la cantidad del producto" min="1" value="{{old('Cantidad')}}">
                @error('Cantidad')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="flex justify-between">
                <a href="/compra" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
                <button type="submit" class="button bg-theme-1 text-white mt-5 ">Agregar Compra</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script>
function obtener_precio() {
    let id = $("#producto option:selected").val();
    
    $.ajax({
        url: `/compra/obtenerPrecio/${id}`,
        type: 'GET',
        success: function(respu){
            console.log(respu.Precio);
            $("#precio").val(respu.Precio);
    }
    })/* .done(function(respuesta) {
        console.log(respuesta);
        if (respuesta != 0) {
            $("#precio").val(respuesta);
        }
        
    }).fail(function(error) {

    }); */
}
</script>
@endsection