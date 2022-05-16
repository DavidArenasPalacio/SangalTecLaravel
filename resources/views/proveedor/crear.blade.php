@extends('layouts.app')


@section('content')
<div class="box p-5">
    <div class="border-b border-gray-200">
        <h1 class="text-center text-4xl font-medium">Registrar un Proveedor</h1>
    </div>
    <form action="/proveedor/guardar" method="POST" id="form" class="mt-5">
        @csrf
        <div class="flex flex-col sm:flex-row items-center">

            <div class="w-full mr-2">
                <label for="nombre">Nombre Proveedor:</label>

                <input type="text" id="nombre" name="nombre" class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror" placeholder="Ingrese el nombre del proveedor" maxlength="125" value="{{old('nombre')}}">
                @error('nombre')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="w-full">
                <label for="correo">Correo Proveedor:</label>

                <input type="email" id="correo" name="correo" class="input w-full border mt-2 @error('correo') border-theme-6 @enderror" placeholder="Ingrese el correo del proveedor" maxlength="225" value="{{old('correo')}}">
                @error('correo')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center sm:mt-2">
            <div class="w-full mr-2">
                <label for="telefono">Telefono Proveedor:</label>

                <input type="text" id="telefono" name="telefono" class="input w-full border mt-2 @error('telefono') border-theme-6 @enderror" placeholder="Ingrese el teléfono del proveedor" value="{{old('telefono')}}">
                @error('telefono')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="w-full ">
                <label for="direccion">Dirección Proveedor:</label>

                <input type="text" id="direccion" name="direccion" class="input w-full border mt-2 @error('direccion') border-theme-6 @enderror" placeholder="Ingrese la dirección" value="{{old('direccion')}}">
                @error('direccion')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>


        </div>




        <!--  <div class="flex justify-between ">
        <a href="/proveedor" class="button  border bg-gray-600 text-white mr-2 mt-5 w-full">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 w-full">Crear Proveedor</button>
    </div> -->
        <div class="flex justify-between">
            <a href="/proveedor" class="button  border  bg-gray-600  text-white mr-2 mt-5 ">Volver</a>
            <button type="submit" class="button bg-theme-1 text-white mt-5 ">Registrar Proveedor</button>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        $.validator.addMethod("formAlphanumeric", function(value, element) {
            var pattern = /^[a-z áãâäàéêëèíîïìóõôöòúûüùçñ]+$/i;
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
                nombre: {
                    required: true,
                    minlength: 2,
                    formAlphanumeric:true,
                    espacios: true
                },
                correo: {
                    required: true,
                    formEmail: true,
                    espacios: true
/*                     normalizer: function(value) {
                        return $.trim(value);
                    } */
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