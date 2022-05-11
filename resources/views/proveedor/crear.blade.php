@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Crear Proveedor</h1>
<form action="/proveedor/guardar" method="POST" id="form">
    @csrf
    <div class="flex flex-col sm:flex-row items-center">

        <div class="w-full mr-2">
            <label for="Nombre_Proveedor">Nombre Proveedor:</label>

            <input type="text" id="Nombre_Proveedor" name="nombre" class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror" placeholder="Ingrese el nombre del proveedor" maxlength="125" value="{{old('nombre')}}" >
            @error('nombre')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="Correo_Proveedor">Correo Proveedor:</label>

            <input type="email" id="Correo_Proveedor" name="correo" class="input w-full border mt-2 @error('correo') border-theme-6 @enderror" placeholder="Ingrese el correo del proveedor" maxlength="225" value="{{old('correo')}}">
            @error('correo')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>

    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="Telefono_Proveedor">Telefono Proveedor:</label>

            <input type="text" id="Telefono_Proveedor" name="telefono" class="input w-full border mt-2 @error('telefono') border-theme-6 @enderror" placeholder="Ingrese el teléfono del proveedor" value="{{old('telefono')}}">
            @error('telefono')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full ">
            <label for="Direccion_Proveedor">Dirección Proveedor:</label>

            <input type="text" id="Direccion_Proveedor" name="direccion" class="input w-full border mt-2 @error('direccion') border-theme-6 @enderror" placeholder="Ingrese la dirección" value="{{old('direccion')}}">
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
        <button type="submit" class="button bg-theme-1 text-white mt-5 ">Crear Proveedor</button>
    </div>
</form>
@endsection

@section('script')
{{-- <script>
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
</script> --}}
@endsection