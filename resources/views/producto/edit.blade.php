@extends('layouts.app')


@section('content')
<section class="container">
<div class="p-5 bg-white">
    <h2 class="text-center">Modificar Producto</h2>
<form action="/producto/actualizar" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$producto->id}}">
    <div class="mb-3">
        <label for="">Nombre</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{$producto->Nombre_Producto}}">
        @error('nombre')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb3">
        <label for="">Categoría: </label>
        <select name="categoria_id" class="form-control " id="">
            @foreach($categorias as $key => $value)
            <option {{$value->id == $producto->categoria_id ? 'selected' : ''}}  value="{{ $value->id }}">{{ $value->Nombre_Categoria }}</option>
            @endforeach
        </select>
        @error('categoria_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Precio: </label>
        <input type="number" name="precio" class="form-control @error('precio') is-invalid @enderror" value="{{$producto->Precio}}">
        @error('precio')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="d-flex justify-content-between">
    <a href="/producto" class="btn btn-primary">Cancelar</a>
    <button type="submit" class="btn btn-success">Modificar producto</button>
   
    </div>
</form>
</div>
</section>
@endsection