@extends('layouts.app')
@section('content')



<h1 class="text-center text-4xl font-medium">Crear un rol</h1>
<form action="/rol/guardar" method="POST">
    @csrf
    <div>
        <label for="">Nombre del rol:</label>
        <input type="text" name="rol" class="input w-full border mt-2 @error('rol') is-invalid @enderror">
        @error('rol')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="text-right">

        <button type="submit" class="button bg-theme-1 text-white mt-5">Crear Rol</button>
    </div>

</form>


@endsection