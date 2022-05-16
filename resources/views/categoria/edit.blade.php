@extends('layouts.app')


@section('content')
<div class="mt-20 flex   justify-center">

    <div class="w-64 m-auto  intro-y box p-5">
        <div class="border-b border-gray-200">
            <h1 class="text-center text-3xl font-medium">Modificar Categoría</h1>
        </div>
        <form action="/categoria/actualizar" method="POST" id="form" class="mt-5">
            @csrf
            <input type="hidden" name="id" value="{{$categoria->id}}">
            <div>
                <label for="nombre">Nombre de la categoría:</label>
                <input type="text" id="nombre" name="nombre" class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror" value="{{$categoria->Nombre_Categoria}}">


                @error('nombre')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="flex justify-between">
                <a href="/rol" class="button  border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
                <button type="submit" class="button bg-theme-1 text-white mt-5">Modificar categoría</button>
            </div>
        </form>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function() {
        $.validator.addMethod("formAlphanumeric", function(value, element) {
            var pattern = /^[a-z áãâäàéêëèíîïìóõôöòúûüùçñ]+$/i;
            return this.optional(element) || pattern.test(value);
        }, "El campo debe tener un valor alfanumérico (azAZ09)");

        $('#form').validate({ // initialize the plugin
            rules: {
                nombre: {
                    required: true,
                    formAlphanumeric: true
                }
            },
            errorElement: 'span',
        });
    });
</script>
@endsection