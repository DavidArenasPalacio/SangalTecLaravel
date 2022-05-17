@extends('layouts.app')


@section('content')
<div class="box p-5">
    <div class="border-b border-gray-200">
        <h1 class="text-center text-4xl font-medium">Editar un cliente</h1>
    </div>
    <form action="{{ route('clientes.actualizar',$clientes->id) }}" method="POST" id="form">
        @csrf
        <input type="hidden" name="id" value="{{$clientes->id}}">
        <div class="flex flex-col sm:flex-row items-center">

            <div class="w-full mr-2">
                <label for="">Nombre:</label>

                <input type="text" name="nombre"
                    class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror"
                    placeholder="Ingrese el nombre del cliente" maxlength="125" value="{{$clientes->Nombre_Cliente}}">
                @error('nombre')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="w-full">
                <label for="Correo_Proveedor">Documento:</label>

                <input type="text" id="documento" name="documento"
                    class="input w-full border mt-2 @error('documento') border-theme-6 @enderror"
                    placeholder="Ingrese el correo del cliente" maxlength="225"
                    value="{{$clientes->Documento_Cliente}}">
                @error('documento')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center sm:mt-2">
            <div class="w-full mr-2">
                <label for="Telefono_Proveedor">Teléfono:</label>

                <input type="text" id="Telefono_Proveedor" name="telefono"
                    class="input w-full border mt-2 @error('telefono') border-theme-6 @enderror"
                    placeholder="Ingrese el teléfono del cliente" value="{{$clientes->Telefono_Cliente}}">
                @error('telefono')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="w-full ">
                <label for="Direccion_Proveedor">Dirección:</label>

                <input type="text" id="Direccion_Proveedor" name="direccion"
                    class="input w-full border mt-2 @error('direccion') border-theme-6 @enderror"
                    placeholder="Ingrese la dirección del cliente" value="{{$clientes->Direccion_Cliente}}">
                @error('direccion')
                <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
                @enderror
            </div>


        </div>
        <div class="flex justify-between">
            <a href="/clientes" class="button  border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
            <button type="submit" class="button bg-theme-1 text-white mt-5 ">Guardar</button>
        </div>
    </form>
</div>
@endsection

@section('script')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection