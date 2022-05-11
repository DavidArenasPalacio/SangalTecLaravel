@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Crear Categoría</h1>
<form action="/categoria/actualizar" method="POST" id="form">
    @csrf
    <input type="hidden" name="id" value="{{$categoria->id}}">
    <div>
        <label for="Nombre_Categoria">Nombre de la categoría:</label>
        <input type="text" id="nombre" name="nombre" class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror" value="{{$categoria->Nombre_Categoria}}">


        @error('nombre')
        <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
        @enderror
    </div>
    <div class="flex justify-between">
        <a href="/rol" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5">Modificar categoría</button>
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

        $('#form').validate({ // initialize the plugin
            rules: {
                Nombre_Categoria: {
                    required: true,
                
                }
            },
            errorElement: 'span',


        });
    });
</script>
@endsection