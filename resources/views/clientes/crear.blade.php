@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Registrar Un Cliente</h1>
<form id="formCl" action="{{ route('clientes.store') }}" method="POST" id="form">
    @csrf
    <div class="flex flex-col sm:flex-row items-center">

        <div class="w-full mr-2">
            <label for="nombre">Nombre:</label>

            <input type="text"  name="nombre" class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror" placeholder="Ingrese el nombre del cliente" maxlength="125" value="{{old('nombre')}}" >
            @error('nombre')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>

    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="documento">Documento:</label>

            <input type="text" id="documento" name="documento" class="input w-full border mt-2 @error('documento') border-theme-6 @enderror" placeholder="Ingrese el documento del cliente" value="{{old('documento')}}">
            @error('documento')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="telefono">Teléfono:</label>

            <input type="text" id="telefono" name="telefono" class="input w-full border mt-2 @error('telefono') border-theme-6 @enderror" placeholder="Ingrese el teléfono del cliente" maxlength="50" value="{{old('telefono')}}" >
            @error('telefono')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="direccion">Dirección:</label>

            <input type="text" id="direccion" name="direccion" class="input w-full border mt-2 @error('direccion') border-theme-6 @enderror" placeholder="Ingrese la dirección del cliente" value="{{old('direccion')}}">
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
        <a href="/clientes" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 ">Registrar Cliente</button>
    </div>
</form>
@endsection

@section('script')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection