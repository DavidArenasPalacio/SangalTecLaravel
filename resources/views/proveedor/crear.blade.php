@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Crear Proveedor</h1>
<form action="/proveedor/guardar" method="POST" id="form">
    @csrf
    <div class="flex flex-col sm:flex-row items-center">

        <div class="w-full mr-2">
            <label for="Nombre_Proveedor">Nombre:</label>

            <input type="text" id="Nombre_Proveedor" name="Nombre_Proveedor" class="input w-full border mt-2 @error('Nombre_Proveedor') border-theme-6 @enderror" placeholder="Ingrese el nombre del proveedor" maxlength="125" value="{{old('name')}}" >
            @error('Nombre_Proveedor')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="Correo_Proveedor">Correo:</label>

            <input type="email" id="Correo_Proveedor" name="Correo_Proveedor" class="input w-full border mt-2 @error('Correo_Proveedor') border-theme-6 @enderror" placeholder="Ingrese el correo del proveedor" maxlength="225" value="{{old('Correo_Proveedor')}}">
            @error('Correo_Proveedor')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>

    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="Telefono_Proveedor">Documento:</label>

            <input type="text" id="Telefono_Proveedor" name="Telefono_Proveedor" class="input w-full border mt-2 @error('Telefono_Proveedor') border-theme-6 @enderror" placeholder="Ingrese el teléfono del proveedor" value="{{old('Telefono_Proveedor')}}">
            @error('documento')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full ">
            <label for="Direccion_Proveedor">Dirección:</label>

            <input type="text" id="Direccion_Proveedor" name="Direccion_Proveedor" class="input w-full border mt-2 @error('Direccion_Proveedor') border-theme-6 @enderror" placeholder="Ingrese la dirección" value="{{old('Direccion_Proveedor')}}">
            @error('Direccion_Proveedor')
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
        <button type="submit" class="button bg-theme-1 text-white mt-5 ">Crear Proveedor</button>
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
                Nombre_Proveedor: {
                    required: true,
                    minlength: 2,
                    espacios: true
                },
                Correo_Proveedor: {
                    required: true,
                    formEmail: true,
                    espacios: true
/*                     normalizer: function(value) {
                        return $.trim(value);
                    } */
                },
                Telefono_Proveedor: {
                    required: true,
                    number: true,
                    espacios: true,
                    minlength: 2,
                    maxlength: 15,
                   
                },
                Direccion_Proveedor: {
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