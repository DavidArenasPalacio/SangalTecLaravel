@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Modificar Producto</h1>
<form action="/producto/guardar" method="POST" class="mb-5 py-5" id="form">
    @csrf

    <div class="w-full">
        <label for="Nombre_Producto">Nombre:</label>

        <input type="text" id="Nombre_Producto" name="Nombre_Producto" class="input w-full border mt-2 @error('Nombre_Producto') border-theme-6 @enderror" placeholder="Ingrese el nombre del producto" value="{{$producto->Nombre_Producto}}" minlength="2">
        @error('Nombre_Producto')
        <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
        @enderror
    </div>
    <div class="w-full mt-2">
        <label for="categoria_id">Categoría: </label>
        <select name="categoria_id" class="input w-full sm:mt-2 border mr-2 @error('categoria_id') border-theme-6 @enderror" id="categoria_id">
            <option>------ Seleccione -----</option>
            @foreach($categorias as $key => $value)
            <option {{$value->id == $producto->categoria_id ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->Nombre_Categoria }}</option>
            @endforeach
        </select>
        @error('categoria_id')
        <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
        @enderror
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="Precio">Precio:</label>

            <input type="number" id="Precio" name="Precio" class="input w-full border mt-2 @error('Precio') border-theme-6 @enderror" placeholder="Ingrese el precio del producto" min="1" value="{{$producto->Precio}}">
            @error('Precio')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="Cantidad">Cantidad:</label>

            <input type="number" id="Cantidad" name="Cantidad" class="input w-full border mt-2 @error('Cantidad') border-theme-6 @enderror" placeholder="Ingrese la cantidad del producto" min="1" value="{{$producto->Cantidad}}">
            @error('Cantidad')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

    </div>
    <div class="flex justify-between">
        <a href="/producto" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 ">Modificar Produto</button>
    </div>
</form>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        $.validator.addMethod("formAlphanumeric", function(value, element) {
            var pattern = /^[\w]+$/i;
            return this.optional(element) || pattern.test(value);
        }, "El campo debe tener un valor alfanumérico (azAZ09)");



        /* $.validator.addMethod("espacios", function(value, element) {
            return value.trim().length > 0
        }, "No debe tener espacios"); */

        $('#form').validate({ // initialize the plugin
            rules: {
                Nombre_Producto: {
                    required: true,
                    minlength: 5,

                },
                categoria_id: {
                    required: true,
                    number: true
                },
                Precio: {
                    required: true,
                    number: true,
                    min: 1,
                },
                Cantidad: {
                    required: true,
                    number: true,
                    min: 1,
                    maxlength: 15,

                }
            },
            messages: {
                categoria_id: "Seleccione una opción",
            },
            errorElement: 'span'


        });
    });
</script>
@endsection