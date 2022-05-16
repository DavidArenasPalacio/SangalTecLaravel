@extends('layouts.app')


@section('content')
<div class="box p-5">
    <div class="border-b border-gray-200">
        <h1 class="text-center text-4xl font-medium">Modificar Usuario</h1>
    </div>
    <form action="/usuario/actualizar" method="POST" id="form" class="mt-5">
        @csrf
        <input type="hidden" name="id" value="{{$usuario->id}}">
        <div class="flex flex-col sm:flex-row items-center">

            <div class="w-full mr-2">
                <label for="nombre">Nombre:</label>

                <input type="text" id="nombre" name="nombre_usuario"
                    class="input w-full border mt-2 @error('nombre_usuario') border-theme-6 @enderror"
                    placeholder="Ingrese el nombre" maxlength="125" value="{{$usuario->name}}">
                @error('nombre_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="w-full">
                <label for="">Rol: </label>
                <select name="rol_usuario"
                    class="input w-full sm:mt-2 border mr-2 @error('rol_usuario') border-theme-6  @enderror" id="">
                    <option>------ Seleccione -----</option>
                    @foreach($roles as $value)
                    <option {{$value->id == $usuario->rol_id ? 'selected' : ''}} value="{{ $value->id }}">
                        {{ $value->Nombre_Rol }}</option>
                    @endforeach
                </select>
                @error('rol_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

        </div>

        <div class="flex flex-col sm:flex-row items-center sm:mt-2">
            <div class="w-full mr-2">
                <label for="documento">Documento:</label>

                <input type="text" id="documento" name="documento_usuario"
                    class="input w-full border mt-2 @error('documento_usuario') border-theme-6 @enderror"
                    placeholder="Ingrese el documento" value="{{$usuario->documento}}">
                @error('documento_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="w-full">
                <label for="telefono">Teléfono:</label>

                <input type="text" id="telefono" name="telefono_usuario"
                    class="input w-full border mt-2 @error('telefono_usuario') border-theme-6 @enderror"
                    placeholder="Ingrese el teléfono" maxlength="50" value="{{$usuario->telefono}}">
                @error('telefono_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-center sm:mt-2">
            <div class="w-full mr-2">
                <label for="direccion">Dirección:</label>

                <input type="text" id="direccion" name="direccion_usuario"
                    class="input w-full border mt-2 @error('direccion_usuario') border-theme-6 @enderror"
                    placeholder="Ingrese la dirección" value="{{$usuario->direccion}}">
                @error('direccion_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="w-full">
                <label for="email">Correo:</label>

                <input type="email" id="email" name="email_usuario"
                    class="input w-full border mt-2 @error('email_usuario') border-theme-6 @enderror"
                    placeholder="Ingrese el teléfono" maxlength="225" value="{{$usuario->email}}">
                @error('email_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center sm:mt-2">
            <div class="w-full mr-2">
                <label for="password">Contraseña:</label>

                <input type="password" id="password" name="password_usuario"
                    class="input w-full border mt-2 @error('password_usuario') border-theme-6 @enderror"
                    placeholder="Ingrese la contraseña">
                @error('password_usuario')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </div>


        <!--  <div class="flex justify-between ">
        <a href="/usuario" class="button  border bg-theme-9 text-white mr-2 mt-5 w-full">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 w-full">Crear Usuario</button>
    </div> -->
        <div class="flex justify-between">
            <a href="/usuario" class="button  border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
            <button type="submit" class="button bg-theme-1 text-white mt-5 ">Editar usuario</button>
        </div>
    </form>
</div>
@endsection


@section('script')
<script>
$(document).ready(function() {
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
                            number: true,
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


{{--
@extends('layouts.app')


@section('content')
<section class="container">
    <div class="p-5 bg-white">
        <h2 class="text-center">Modificar Proveedor</h2>
        <form action="/proveedor/actualizar" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$proveedor->id}}">
<div class="mb-3">
    <label for="">Nombre</label>
    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
        value="{{$proveedor->Nombre_Proveedor}}">
    @error('nombre')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class=" mb-3">
    <label for="">Correo: </label>
    <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror"
        value="{{$proveedor->Correo_Proveedor}}">
    @error('correo')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="mb-3">
    <label for="">Teléfono: </label>
    <input type="tel" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
        value="{{$proveedor->Telefono_Proveedor}}">
    @error('telefono')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="mb-3">
    <label for="">Dirección: </label>
    <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror"
        value="{{$proveedor->Direccion_Proveedor}}">
    @error('direccion')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="d-flex justify-content-between">
    <a href="/proveedor" class="btn btn-primary">Cancelar</a>
    <button type="submit" class="btn btn-success">Modificar proveedor</button>

</div>
</form>
</div>
</section>
@endsection --}}