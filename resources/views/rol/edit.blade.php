@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Modificar Rol</h1>
<form action="/rol/actualizar" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$rol->id}}">
    <div>
        <label for="">Nombre del rol:</label>
        <input type="text" name="rol" class="input w-full border mt-2 @error('rol') is-invalid @enderror" value="{{$rol->Nombre_Rol}}">
        @error('rol')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="flex justify-between">
        <a href="/rol" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>

        <button type="submit" class="button bg-theme-1 text-white mt-5">Modificar Rol</button>
    </div>

</form>
@endsection