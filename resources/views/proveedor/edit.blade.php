@extends('layouts.app')


@section('content')
<section class="container">
    <div class="p-5 bg-white">
        <h2 class="text-center">Modificar Proveedor</h2>
        <form action="/proveedor/actualizar" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$proveedor->id}}">
            <div class="mb-3">
                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{$proveedor->Nombre_Proveedor}}">
        @error('nombre')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class=" mb-3">
                <label for="">Correo: </label>
                <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{$proveedor->Correo_Proveedor}}">
                @error('correo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Teléfono: </label>
                <input type="tel" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{$proveedor->Telefono_Proveedor}}">
                @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Dirección: </label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{$proveedor->Direccion_Proveedor}}">
                @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a href="/proveedor" class="btn btn-primary">Cancelar</a>
                <button type="submit" class="btn btn-success">Modificar proveedor</button>

            </div>
        </form>
    </div>
</section>
@endsection