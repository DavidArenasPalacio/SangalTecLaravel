@extends('layouts.app')


@section('content')

<form action="/producto/guardar">
    <div class="mb-3">
        <label for="">Nombre</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror">
        @error('nombre')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb3">
        <label for="">Categoría: </label>
        <select name="categoria_id" class="form-selected @error('categoria_id') is-invalid @enderror" id="">
            <option value="">------Seleccione-----</option>
            @foreach($categorias as $key => $value) 
                                <option value="{{$value->id}}">{{$value->Nombre_Categria}}</option>
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
        <input type="number" name="precio" class="form-control @error('precio') is-invalid @enderror">
        @error('precio')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Cantidad: </label>
        <input type="number" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror">
        @error('cantidad')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</form>
@endsection