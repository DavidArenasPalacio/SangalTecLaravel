@extends('layouts.app')


@section('content')
<div class="box p-5">
<div class="border-b border-gray-200">
<h1 class="text-center text-4xl font-medium">Editar un producto</h1>
</div>
    <form action="{{ route('producto.actualizar', $producto->id) }}" method="POST" class="mb-5 py-5" id="form">
        @csrf

        <div class="flex flex-col sm:flex-row items-center sm:mt-2">
            <div class="w-full mr-2">
                <label for="Nombre_Producto">Nombre:</label>

                <input type="text" id="Nombre_Producto" name="nombre"
                    class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror"
                    placeholder="Ingrese el nombre del producto" value="{{ $producto->Nombre_Producto }}" minlength="2">
                @error('nombre')
                    <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="w-full mr-2">
                <label for="categoria_id">Categoría: </label>
                <select name="categoria_id"
                    class="input w-full sm:mt-2 border mr-2 @error('categoria_id') border-theme-6 @enderror"
                    id="categoria_id">
                    <option>------ Seleccione -----</option>
                    @foreach ($categorias as $key => $value)
                        <option {{ $value->id == $producto->categoria_id ? 'selected' : '' }} value="{{ $value->id }}">
                            {{ $value->Nombre_Categoria }}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center sm:mt-2">
            {{-- <div class="w-full mr-2">
            <label for="Precio">Precio:</label>

            <input type="number" id="Precio" name="Precio" class="input w-full border mt-2 @error('Precio') border-theme-6 @enderror" placeholder="Ingrese el precio del producto" min="1" value="{{$producto->Precio}}">
            @error('Precio')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div> --}}
            <div class="w-full mr-2">
                <label for="precio">Precio Compra:</label>

                <input type="number" id="precio" name="precio_compra"
                    class="input w-full border mt-2 @error('precio_compra') border-theme-6 @enderror"
                    placeholder="Ingrese el precio unitario en el que se comprará el producto" min="1"
                    value="{{ $producto->Precio_Compra }}">
                @error('precio_compra')
                    <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="w-full mr-2">
                <label for="precio">Precio Venta:</label>

                <input type="number" id="precio" name="precio_venta"
                    class="input w-full border mt-2 @error('precio_venta') border-theme-6 @enderror"
                    placeholder="Ingrese el precio unitario en el que se venderá el producto" min="1"
                    value="{{ $producto->Precio_Venta }}">
                @error('precio_venta')
                    <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

        </div>
        <div class="flex justify-between">
            <a href="/producto" class="button  border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
            <button type="submit" class="button bg-theme-1 text-white mt-5 ">Guardar</button>
        </div>
    </form>
</div>
@endsection

@section('script')
    {{-- <script>
    $(document).ready(function() {

        $('#form').validate({ // initialize the plugin
            rules: {
                categoria_id: {
                    required: true,
                    number: true
                },
            },
            messages: {
                categoria_id: "Seleccione una opción",
            },
            errorElement: 'span'


        });
    });
</script> --}}
@endsection
