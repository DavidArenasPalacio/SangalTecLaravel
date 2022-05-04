@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Crear Usuario</h1>
<form action="/usuario/guardar" method="POST" id="form">
    @csrf
    <div class="flex flex-col sm:flex-row items-center">

        <div class="w-full mr-2">
            <label for="nombre">Nombre:</label>

            <input type="text" id="name" name="name" class="input w-full border mt-2 @error('name') border-theme-6 @enderror" placeholder="Ingrese el nombre del usuario" maxlength="125" value="{{old('name')}}" >
            @error('name')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="">Rol: </label>
            <select name="rol_id" class="input w-full sm:mt-2 border mr-2 @error('rol_id') border-theme-6  @enderror" id="rol_id">
                <option>------ Seleccione -----</option>
                @foreach($roles as $value)
                <option value="{{ $value->id }}" {{old('rol_id') == $value->id ? 'selected' : ''}}>>{{ $value->Nombre_Rol }}</option>
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

            <input type="text" id="documento" name="documento" class="input w-full border mt-2 @error('documento') border-theme-6 @enderror" placeholder="Ingrese el documento del usuario" value="{{old('documento')}}">
            @error('documento')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="telefono">Teléfono:</label>

            <input type="text" id="telefono" name="telefono" class="input w-full border mt-2 @error('telefono') border-theme-6 @enderror" placeholder="Ingrese el teléfono" maxlength="50" value="{{old('telefono')}}" >
            @error('telefono')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="direccion">Dirección:</label>

            <input type="text" id="direccion" name="direccion" class="input w-full border mt-2 @error('direccion') border-theme-6 @enderror" placeholder="Ingrese la dirección" value="{{old('direccion')}}">
            @error('direccion')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="email">Correo:</label>

            <input type="email" id="email" name="email" class="input w-full border mt-2 @error('email') border-theme-6 @enderror" placeholder="Ingrese el teléfono" maxlength="225" value="{{old('email')}}">
            @error('email')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="password">Contraseña:</label>

            <input type="password" id="password" name="password" class="input w-full border mt-2 @error('password') border-theme-6 @enderror" placeholder="Ingrese la contraseña">
            @error('password')
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
        <button type="submit" class="button bg-theme-1 text-white mt-5 ">Crear Usuario</button>
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


        $.validator.addMethod("espacios", function(value, element) {
            return value.trim().length > 0
        }, "El campo no debe tener espacios"); 

        $('#form').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    espacios: true
                },
                rol_id: {
                    required: true,
                    number: true
                },
                documento: {
                    required: true,
                    number:true,
                    espacios: true
                },
                telefono: {
                    required: true,
                    number: true,
                    espacios: true,
                    minlength: 2,
                    maxlength: 15,
                   
                },
                direccion: {
                    required: true,
                    espacios: true,
                },
                email: {
                    required: true,
                    formEmail: true,
                    espacios: true
/*                     normalizer: function(value) {
                        return $.trim(value);
                    } */
                },
                password: {
                    required: true,
                    espacios: true
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