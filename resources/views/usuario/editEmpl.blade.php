@extends('layouts.app')


@section('content')
<div class="box p-5">
    <div class="border-b border-gray-200">
        <h1 class="text-center text-4xl font-medium">Editar un usuario</h1>
    </div>
    <form action="/usuario/actualizarEmpleado" method="POST" id="form" class="mt-5">
        @csrf
        <input type="hidden" name="id" value="{{$usuario->id}}">

        <div class="flex flex-col sm:flex-row items-center sm:mt-2">

            <div class="w-full mr-4">
                <label for="telefono">Teléfono:</label>

                <input type="text" id="telefono" name="telefono_usuario"
                    class="input w-full border mt-2 @error('telefono_usuario') border-theme-6 @enderror"
                    placeholder="Ingrese el teléfono" maxlength="50" value="{{$usuario->telefono}}">
                @error('telefono_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

            <div class="w-full mr-2">
                <label for="direccion">Dirección:</label>

                <input type="text" id="direccion" name="direccion_usuario"
                    class="input w-full border mt-2 @error('direccion_usuario') border-theme-6 @enderror"
                    placeholder="Ingrese la dirección" value="{{$usuario->direccion}}">
                @error('direccion_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-center sm:mt-2">
            <div class="w-full mr-4">
                <label for="email">Correo:</label>

                <input type="email" id="email" name="correo_usuario"
                    class="input w-full border mt-2 @error('correo_usuario') border-theme-6 @enderror"
                    placeholder="Ingrese el teléfono" maxlength="225" value="{{$usuario->email}}">
                @error('correo_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

            <div class="w-full mr-2" style="position: relative;">
                <label for="password">Contraseña:</label>

                <span class="icon-eye" style="position: absolute; right: 1%; top: 55%;">
                    <i class="fas fa-eye" onclick="mostrar()"></i>
                </span>
                <input type="password" id="contraseña_usuario" name="contraseña_usuario"
                    class="input w-full border mt-2 @error('contraseña_usuario') border-theme-6 @enderror"
                    placeholder="Ingrese la contraseña">
                @error('contraseña_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
                {{-- <input class="input border-theme-6 mt-3" type="button" onclick="mostrar()" value="Mostrar/Ocultar"> --}}
            </div>
            <div class="w-full ">
                <label for="confirm_password">Confirmar contraseña:</label>
                <input type="password" id="contrasenaconfirmar" name="contrasenaconfirmar"
                    class="input w-full border mt-2" placeholder="Confirmar contraseña">
            </div>
        </div>

        <!--  <div class="flex justify-between ">
        <a href="/usuario" class="button  border bg-theme-9 text-white mr-2 mt-5 w-full">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 w-full">Crear Usuario</button>
    </div> -->
        <div class="flex justify-between">
            <a href="/usuario" class="button  border bg-gray-600 text-white mr-2 mt-5 tooltip" title="Presione el boton izquierdo del mouse aqui para volver a la lista de los usuarios">Volver</a>
            <button type="submit" class="button bg-theme-1 text-white mt-5 tooltip" title="Presione el boton izquierdo del mouse aqui para guardar los datos editados del usuario">Guardar</button>
        </div>
    </form>
</div>
@endsection


@section('script')
<script>
    
    function mostrar(){

        const iconEye = document.querySelector(".icon-eye");

        iconEye.addEventListener('click', function(){
        
            const icon = this.querySelector("i");
            

            if (this.nextElementSibling.type === "password") {
                
                this.nextElementSibling.type = "text";

                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');

            } else {
                this.nextElementSibling.type = "password";

                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
            
        })

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

                telefono_usuario: {
                    required: true,
                    number: true,
                    minlength: 2,
                    maxlength: 15,
                
                },
                direccion_usuario: {
                    required: true
                },
                correo_usuario: {
                    required: true,
                    formEmail: true,
/*                     normalizer: function(value) {
                        return $.trim(value);
                    } */
                },
                contraseña_usuario: {
                    required: true
                },
                contrasenaconfirmar: {required:true,equalTo:"#contraseña_usuario"}
            },
            errorElement: 'span',
        });
    });

        
</script>

@endsection