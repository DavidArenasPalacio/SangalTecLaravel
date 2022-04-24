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

    <div class="text-right">

        <button type="submit" class="button bg-theme-1 text-white mt-5">Modificar Rol</button>
    </div>

</form>
<!-- <section class="container">
<div class="p-5 bg-white">
    <h2 class="text-center">Modificar Rol</h2>
<form action="/rol/actualizar" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$rol->id}}">
    <div class="mb-3">
        <label for="">Nombre</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{$rol->Nombre_Rol}}">
        @error('nombre')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
    <a href="/rol" class="btn btn-primary">Cancelar</a>
    <button type="submit" class="btn btn-success">Modificar rol</button>
   
    </div>
</form>
</div>
</section> -->
@endsection