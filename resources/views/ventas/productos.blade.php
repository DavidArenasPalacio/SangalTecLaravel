@extends('layouts.app')

@section('titulo')
Productos Vendidos
@endsection

@section('content')

<div class="box p-5 ">
<div class="overflow-x-auto">
    <table class="table table-report table-report--bordered display  table--sm">
        <thead>
            <tr class="bg-gray-700 text-white">
                <th class="border-b-2 whitespace-no-wrap">Nombre Del Producto</th>
                <th class="border-b-2 whitespace-no-wrap">Precio Unitario</th>
                <th class="border-b-2 whitespace-no-wrap">Cantidad</th>
                <th class="border-b-2 whitespace-no-wrap">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventasdetalle as $value)
            <tr>
                <td class="border-b ">{{$value->Productos}}</td>
                <td class="border-b ">{{$value->Precio_unitario}}</td>
                <td class="border-b ">{{$value->Cantidad}}</td>
                <td class="border-b "> {{$value->SubTotal}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


    <div class="flex justify-between">
        <a href="/ventas" class="button border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
    </div>
</div>
@endsection