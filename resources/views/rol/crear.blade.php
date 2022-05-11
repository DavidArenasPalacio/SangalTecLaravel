@extends('layouts.app')
@section('content')



<h1 class="text-center text-4xl font-medium">Crear Rol</h1>
<form action="/rol/guardar" method="POST" id="form">
    @csrf
    {{-- <div>
        <label for="rol">Nombre del rol:</label>
        <input type="text" id="rol" name="Nombre_Rol" class="input w-full border mt-2 @error('Nombre_Rol') border-theme-6 @enderror" required>

    
        @error('Nombre_Rol')
        <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
        @enderror
    </div> --}}
    <div>
        <label for="rol">Nombre Del Rol:</label>
        <input type="text" name="nombre" placeholder="Ingrese el nombre del rol" class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror">
        @error('nombre')
        <span class="text-theme-6 mt-2" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="flex justify-between">
        <a href="/rol" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5">Crear Rol</button>
    </div>

</form>


@endsection

