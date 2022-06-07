@extends('layouts.app')


@section('content')
    <div class="box p-5">
        <div class="border-b border-gray-200">
            <h1 class="text-center text-4xl font-medium">Editar un proveedor</h1>
        </div>
        <form action="{{ route('proveedor.actualizar', $proveedor->id) }}" method="POST" id="form" class="mt-5">
            @csrf
            <input type="hidden" name="id" value="{{ $proveedor->id }}">
            <div class="flex flex-col sm:flex-row items-center">

                <div class="w-full mr-2">
                    <label for="Nombre_Proveedor">Nombre:</label>

                    <input type="text" id="Nombre_Proveedor" name="nombre"
                        class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror"
                        placeholder="Ingrese el nombre del proveedor" maxlength="125"
                        value="{{ $proveedor->Nombre_Proveedor }}">
                    @error('nombre')
                        <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <div class="w-full">
                    <label for="Correo_Proveedor">Correo:</label>

                    <input type="email" id="Correo_Proveedor" name="correo"
                        class="input w-full border mt-2 @error('correo') border-theme-6 @enderror"
                        placeholder="Ingrese el correo del proveedor" maxlength="225"
                        value="{{ $proveedor->Correo_Proveedor }}">
                    @error('correo')
                        <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:mt-2">
                <div class="w-full mr-2">
                    <label for="Telefono_Proveedor">Teléfono:</label>

                    <input type="text" id="Telefono_Proveedor" name="telefono"
                        class="input w-full border mt-2 @error('telefono') border-theme-6 @enderror"
                        placeholder="Ingrese el teléfono del proveedor" value="{{ $proveedor->Telefono_Proveedor }}">
                    @error('telefono')
                        <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <div class="w-full ">
                    <label for="Direccion_Proveedor">Dirección:</label>

                    <input type="text" id="Direccion_Proveedor" name="direccion"
                        class="input w-full border mt-2 @error('direccion') border-theme-6 @enderror"
                        placeholder="Ingrese la dirección del proveedor" value="{{ $proveedor->Direccion_Proveedor }}">
                    @error('direccion')
                        <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>


            </div>


            <!--  <div class="flex justify-between ">
                        <a href="/usuario" class="button  border bg-theme-9 text-white mr-2 mt-5 w-full">Volver</a>
                        <button type="submit" class="button bg-theme-1 text-white mt-5 w-full">Crear Usuario</button>
                    </div> -->
            <div class="flex justify-between">
                <a href="/proveedor" class="button  border bg-gray-600 text-white mr-2 mt-5 tooltip"
                    title="Click aqui para volver a la lista de los proveedores">Volver</a>
                <button type="submit" class="button bg-theme-1 text-white mt-5 tooltip"
                    title="Click aqui para guardar los datos editados del proveedor">Guardar</button>
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
                        formAlphanumeric: true,
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
