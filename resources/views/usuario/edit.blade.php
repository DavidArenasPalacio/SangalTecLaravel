@extends('layouts.app')


@section('content')
<section class="container">
    <div class="p-5 bg-white">
        <h2 class="text-center">Modificar Usuario</h2>
        <form action="/usuario/actualizar" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$usuario->id}}">
            <div class="mb-3">
                <label for="">Nombre:</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{$usuario->name}}">
                @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb3">
                <label for="">Rol: </label>
                <select name="rol_id" class="form-control @error('rol_id') is-invalid @enderror" id="">
                    <option value="">------Seleccione-----</option>
                    @foreach($roles as $value)
                    <option {{$value->id == $usuario->rol_id ? 'selected' : ''}}  value="{{ $value->id }}">{{ $value->Nombre_Rol }}</option>
                    @endforeach
                </select>
                @error('rol_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Documento: </label>
                <input type="text" name="documento" class="form-control @error('documento') is-invalid @enderror" value="{{$usuario->documento}}">
                @error('documento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Teléfono: </label>
                <input type="tel" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{$usuario->telefono}}">
                @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Dirección: </label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{$usuario->direccion}}">
                @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Email: </label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$usuario->email}}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="/usuario" class="btn btn-primary">Cancelar</a>
                <button type="submit" class="btn btn-success">Modificar usuario</button>

            </div>
        </form>
    </div>
</section>
@endsection