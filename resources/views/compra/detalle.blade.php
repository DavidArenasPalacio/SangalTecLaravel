@extends('layouts.app')


@section('content')

<div>
    <table  class="table table-report table-report--bordered display  ">
        <thead>
            <tr class="bg-gray-700 text-white">
                <th class="border-b-2 whitespace-no-wrap">Nombre Del Producto</th>  
                <th class="border-b-2 whitespace-no-wrap">Precio Unitario</th>                              
                <th class="border-b-2 whitespace-no-wrap">Cantidad</th>
                <th class="border-b-2 whitespace-no-wrap">Sub Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach($detal as $value)
            <tr>
                <td>{{$value->producto}}</td>
                <td>{{$value->Precio_unitario}}</td>
                <td>{{$value->Cantidad}}</td>
                <td>{{$value->Sub_total}}</td>        
            </tr>

        @endforeach
        </tbody>
        </table>
</div>

<div class="flex justify-between">
    <a href="/compra" class="button border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
</div>

@endsection