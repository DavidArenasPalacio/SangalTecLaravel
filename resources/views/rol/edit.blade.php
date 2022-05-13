@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Modificar Rol</h1>
<form action="/rol/actualizar" method="POST" id="form">
    @csrf
    <input type="hidden" name="id" value="{{$rol->id}}">

    {{-- <div>
        <label for="">Nombre del rol:</label>
        <input type="text" name="Nombre_Rol" class="input w-full border mt-2 @error('Nombre_Rol') border-theme-6 @enderror" value="{{$rol->Nombre_Rol}}">
        @error('Nombre_Rol')
        <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
        @enderror
    </div> --}}

    <div>
        <label for="">Nombre Del Rol:</label>
        <input type="text" name="nombre" placeholder="Ingrese el nombre del rol" class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror" value="{{$rol->Nombre_Rol}}">
        @error('nombre')
        <span class="text-theme-6 mt-2" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="flex justify-between">
        <a href="/rol" class="button  border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5">Modificar Rol</button>
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
                Nombre_Rol: {
                    required: true,
                    formAlphanumeric: true
                }
            },
            errorElement: 'span',
        });
    });
</script>
@endsection