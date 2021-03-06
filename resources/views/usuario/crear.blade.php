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
            <label for="telefono_usuario">Tel??fono:</label>

            <input type="text" id="telefono_usuario" name="telefono_usuario" class="input w-full border mt-2 @error('telefono_usuario') border-theme-6 @enderror" placeholder="Ingrese el tel??fono" maxlength="50" value="{{old('telefono_usuario')}}" >
            @error('telefono_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="direccion_usuario">Direcci??n:</label>

            <input type="text" id="direccion_usuario" name="direccion_usuario" class="input w-full border mt-2 @error('direccion_usuario') border-theme-6 @enderror" placeholder="Ingrese la direcci??n" value="{{old('direccion_usuario')}}">
            @error('direccion_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="correo_usuario">Correo:</label>

            <input type="email" id="correo_usuario" name="correo_usuario" class="input w-full border mt-2 @error('correo_usuario') border-theme-6 @enderror" placeholder="Ingrese el tel??fono" maxlength="225" value="{{old('correo_usuario')}}">
            @error('correo_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2" style="position: relative;">
            <label for="password">Contrase??a:</label>

            <span class="icon-eye" style="position: absolute; right: 1%; top: 55%;">
                <i class="fas fa-eye" onclick="mostrar()"></i>
            </span>
            <input type="password" id="contrase??a_usuario" name="contrase??a_usuario" class="input w-full border mt-2 @error('contrase??a_usuario') border-theme-6 @enderror" placeholder="Ingrese la contrase??a">
            @error('contrase??a_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
            {{-- <input class="input border-theme-6 mt-5" type="button"  value="Mostrar/Ocultar"> --}}
        </div>
        <div class="w-full ">
            <label for="confirm_password">Confirmar contrase??a:</label>
            <input type="password" id="contrasenaconfirmar" name="contrasenaconfirmar" class="input w-full border mt-2" placeholder="Confirmar contrase??a">
    
            {{-- <input class="input border-theme-6 mt-5" type="button"  value="Mostrar/Ocultar"> --}}
        </div>
    </div>


    <!--  <div class="flex justify-between ">
        <a href="/usuario" class="button  border bg-theme-9 text-white mr-2 mt-5 w-full">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 w-full">Crear Usuario</button>
    </div> -->
    <div class="flex justify-between">
        <a href="/usuario" class="button  border bg-gray-600 text-white mr-2 mt-5 tooltip" title="Presione el boton izquierdo del mouse aqui para volver a la lista de los usuarios">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 tooltip" title="Presione el boton izquierdo del mouse aqui para guardar el registro del usuario">Guardar</button>
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
            var pattern = /^[a-z ????????????????????????????????????????????????]+$/i;
            return this.optional(element) || pattern.test(value);
        }, "El campo debe tener un valor alfanum??rico (azAZ09)");
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
                correo_usuario: {
                    required: true,
                    formEmail: true,
/*                     normalizer: function(value) {
                        return $.trim(value);
                    } */
                },
                contrase??a_usuario: {
                    required: true
                },
                contrasenaconfirmar: {required:true,equalTo:"#contrase??a_usuario"}
            },
            messages: {
                rol_id: "Seleccione una opci??n"
            },
            errorElement: 'span',
        });
    });

</script>
@endsection
