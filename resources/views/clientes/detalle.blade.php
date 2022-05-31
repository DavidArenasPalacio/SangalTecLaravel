@extends('layouts.app')

@section('titulo')
    Detalles Del Cliente
@endsection

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h1 class="text-lg font-medium mr-auto">
        Detalle del cliente
    </h1>   
</div>
<div class="box p-5 mt-10">
<div class="overflow-x-auto">
    <table class="table table-report table-report--bordered display  ">
        <thead>
            <tr class="bg-gray-700 text-white">
                <th class="border-b-2 whitespace-no-wrap">Nombre</th>
                <th class="border-b-2 whitespace-no-wrap">Documento</th>
                <th class="border-b-2 whitespace-no-wrap">Teléfono</th>
                <th class="border-b-2 whitespace-no-wrap">Dirección</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border-b ">{{ $cliente->Nombre_Cliente }}</td>
                <td class="border-b ">{{ $cliente->Documento_Cliente }}</td>
                <td class="border-b ">{{ $cliente->Telefono_Cliente }}</td>
                <td class="border-b ">{{ $cliente->Direccion_Cliente }}</td>
            </tr>
        </tbody>
    </table>
</div>        
    

    <div class="flex justify-between">
        <a href="/clientes" class="button border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
    </div>

</div>
    
@endsection
