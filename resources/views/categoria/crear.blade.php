@extends('layouts.app')
@section('content')
<h1 class="text-center text-4xl font-medium">Registrar Una Categoría</h1>
<form action="/categoria/guardar" method="POST" id="form">
    @csrf
    {{-- <div>
        <label for="Nombre_Categoria">Nombre de la categoría:</label>
        <input type="text" id="Nombre_Categoria" name="Nombre_Categoria" class="input w-full border mt-2 @error('Nombre_Categoria') border-theme-6 @enderror">

    
        @error('Nombre_Categoria')
        <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
        @enderror
    </div> --}}
    <div>
        <label for="rol">Nombre De La Categoría:</label>
        <input type="text" name="nombre" placeholder="Ingrese el nombre de la categoría" class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror">
        @error('nombre')
        <span class="text-theme-6 mt-2" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="flex justify-between">
        <a href="/categoria" class="button  border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5">Registrar Categoría</button>
    </div>
</form>
@endsection


@section('script')
{{-- <script>
    $(document).ready(function() {
        $.validator.addMethod("formAlphanumeric", function(value, element) {
            var pattern = /^[\w]+$/i;
            return this.optional(element) || pattern.test(value);
        }, "El campo debe tener un valor alfanumérico (azAZ09)");

        $('#form').validate({ // initialize the plugin
            rules: {
                Nombre_Categoria: {
                    required: true,
                
                }
            },
            errorElement: 'span',


        });
    });
</script> --}}
@endsection