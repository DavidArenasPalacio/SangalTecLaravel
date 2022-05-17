@extends('layouts.app')


@section('content')
<div class="box p-5">
<div class="border-b border-gray-200">
<h1 class="text-center text-4xl font-medium">Registrar un usuario</h1>
</div>
<form action="/usuario/guardar" method="POST" id="form" class="mt-5">
    @csrf
    <div class="flex flex-col sm:flex-row items-center">

        <div class="w-full mr-2">
            <label for="nombre_usuario">Nombre:</label>

            <input type="text" id="nombre_usuario" name="nombre_usuario" class="input w-full border mt-2 @error('nombre_usuario') border-theme-6 @enderror" placeholder="Ingrese el nombre del usuario" maxlength="125" value="{{old('nombre_usuario')}}" >
            @error('nombre_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="rol_usuario">Rol: </label>
            <select id="rol_usuario" name="rol_usuario" class="input w-full sm:mt-2 border mr-2 @error('rol_usuario') border-theme-6  @enderror" id="rol">
                <option>------ Seleccione -----</option>
                @foreach($roles as $value)
                <option value="{{ $value->id }}" {{old('rol_usuario') == $value->id ? 'selected' : ''}}>{{ $value->Nombre_Rol }}</option>
                @endforeach
            </select>
            @error('rol_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

    </div>

    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="documento_usuario">Documento:</label>

            <input type="text" id="documento_usuario" name="documento_usuario" class="input w-full border mt-2 @error('documento_usuario') border-theme-6 @enderror" placeholder="Ingrese el documento del usuario" value="{{old('documento_usuario')}}">
            @error('documento_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="telefono_usuario">Teléfono:</label>

            <input type="text" id="telefono_usuario" name="telefono_usuario" class="input w-full border mt-2 @error('telefono_usuario') border-theme-6 @enderror" placeholder="Ingrese el teléfono" maxlength="50" value="{{old('telefono_usuario')}}" >
            @error('telefono_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="direccion_usuario">Dirección:</label>

            <input type="text" id="direccion_usuario" name="direccion_usuario" class="input w-full border mt-2 @error('direccion_usuario') border-theme-6 @enderror" placeholder="Ingrese la dirección" value="{{old('direccion_usuario')}}">
            @error('direccion_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="email_usuario">Correo:</label>

            <input type="email" id="email_usuario" name="email_usuario" class="input w-full border mt-2 @error('email_usuario') border-theme-6 @enderror" placeholder="Ingrese el teléfono" maxlength="225" value="{{old('email_usuario')}}">
            @error('email_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="password">Contraseña:</label>

            <input type="password" id="password_usuario" name="password_usuario" class="input w-full border mt-2 @error('password_usuario') border-theme-6 @enderror" placeholder="Ingrese la contraseña">
            @error('password_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
            <input class="input border-theme-6 mt-5" type="button" onclick="mostrar()" value="Mostrar/Ocultar">
        </div>
    </div>


    <!--  <div class="flex justify-between ">
        <a href="/usuario" class="button  border bg-theme-9 text-white mr-2 mt-5 w-full">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 w-full">Crear Usuario</button>
    </div> -->
    <div class="flex justify-between">
        <a href="/usuario" class="button  border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 ">Guardar</button>
    </div>
</form>
</div>
@endsection

@section('script')
<script>

    function mostrar(){

        var tipo = document.getElementById("password_usuario");

        if(tipo.type == "password"){
            tipo.type = "text";

        }else{
            tipo.type = "password";
        }
    }

    $(document).ready(function() {
        $.validator.addMethod("formAlphanumeric", function(value, element) {
            var pattern = /^[a-z áãâäàéêëèíîïìóõôöòúûüùçñ]+$/i;
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
                nombre_usuario: {
                    required: true,
                    formAlphanumeric: true,
                    minlength: 2,
                
                },
                rol_usuario: {
                    required: true,
                    number: true
                },
                documento_usuario: {
                    required: true,
                    number:true,
                },
                telefono_usuario: {
                    required: true,
                    number: true,
                    minlength: 2,
                    maxlength: 15,
                
                },
                direccion_usuario: {
                    required: true
                },
                email_usuario: {
                    required: true,
                    formEmail: true,
/*                     normalizer: function(value) {
                        return $.trim(value);
                    } */
                },
                password_usuario: {
                    required: true
                }
            },
            messages: {
                rol_id: "Seleccione una opción"
            },
            errorElement: 'span',
        });
    });

</script>
@endsection
