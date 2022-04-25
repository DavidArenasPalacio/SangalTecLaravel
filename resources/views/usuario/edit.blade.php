@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Modificar Usuario</h1>
<form action="/usuario/actualizar method="POST" id="form">
    @csrf
    <input type="hidden" name="id" value="{{$usuario->id}}">
    <div class="flex flex-col sm:flex-row items-center">

        <div class="w-full mr-2">
            <label for="nombre">Nombre:</label>

            <input type="text" id="nombre" name="nombre" class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror" placeholder="Ingrese el nombre" maxlength="125" value="{{$usuario->name}}">
            @error('nombre')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="">Rol: </label>
            <select name="rol_id" class="input w-full sm:mt-2 border mr-2 @error('rol_id') border-theme-6  @enderror" id="">
                <option>------ Seleccione -----</option>
                @foreach($roles as $value)
                <option {{$value->id == $usuario->rol_id ? 'selected' : ''}}  value="{{ $value->id }}">{{ $value->Nombre_Rol }}</option>
                @endforeach
            </select>
            @error('rol_id')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

    </div>

    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="documento">Documento:</label>

            <input type="text" id="documento" name="documento" class="input w-full border mt-2 @error('documento') border-theme-6 @enderror" placeholder="Ingrese el documento" value="{{$usuario->documento}}">
            @error('documento')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="telefono">Teléfono:</label>

            <input type="text" id="telefono" name="telefono" class="input w-full border mt-2 @error('telefono') border-theme-6 @enderror" placeholder="Ingrese el teléfono" maxlength="50" value="{{$usuario->telefono}}">
            @error('telefono')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="direccion">Dirección:</label>

            <input type="text" id="direccion" name="direccion" class="input w-full border mt-2 @error('direccion') border-theme-6 @enderror" placeholder="Ingrese la dirección" value="{{$usuario->direccion}}">
            @error('direccion')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="email">Correo:</label>

            <input type="email" id="email" name="email" class="input w-full border mt-2 @error('email') border-theme-6 @enderror" placeholder="Ingrese el teléfono" maxlength="225" value="{{$usuario->email}}">
            @error('email')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>


    <!--  <div class="flex justify-between ">
        <a href="/usuario" class="button  border bg-theme-9 text-white mr-2 mt-5 w-full">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 w-full">Crear Usuario</button>
    </div> -->
    <div class="flex justify-between">
        <a href="/usuario" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 ">Modificar usuario</button>
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

        $.validator.addMethod("formEmail", function(value, element) {
            var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
            return this.optional(element) || pattern.test(value);
        }, "Formato del email incorrecto");

        /* $.validator.addMethod("espacios", function(value, element) {
            return value.trim().length > 0
        }, "No debe tener espacios"); */

        $('#form').validate({ // initialize the plugin
            rules: {
                nombre: {
                    required: true,
                    minlength: 2,
                  
                },
                rol_id: {
                    required: true,
                    number: true
                },
                documento: {
                    required: true,
                    number:true,
                },
                telefono: {
                    required: true,
                    number: true,
                    minlength: 2,
                    maxlength: 15,
                   
                },
                direccion: {
                    required: true
                },
                email: {
                    required: true,
                    formEmail: true,
/*                     normalizer: function(value) {
                        return $.trim(value);
                    } */
                },
                password: {
                    required: true
                }
            },
            messages: {
                
                rol_id: "Seleccione una opción",
                documemto: "El campo es obligatorio",
                telefono: "El campo Teléfono no contiene un formato correcto."
            },
            errorElement: 'span'


        });
    });
</script>
@endsection