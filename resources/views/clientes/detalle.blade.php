@extends('layouts.app')

@section('titulo')
    Detalles Del Cliente
@endsection

@section('content')
    <div>
        <table class="table table-report table-report--bordered display  ">
            <thead>
                <tr class="bg-gray-700 text-white">
                    <th>Nombre Del Cliente</th>
                    <th>Documento</th>
                    <th>Telefono Del Cliente</th>
                    <th>Direccion Del Cliente</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-b-2 whitespace-no-wrap">{{ $cliente->Nombre_Cliente }}</td>
                    <td class="border-b-2 whitespace-no-wrap">{{ $cliente->Documento_Cliente }}</td>
                    <td class="border-b-2 whitespace-no-wrap">{{ $cliente->Telefono_Cliente }}</td>
                    <td class="border-b-2 whitespace-no-wrap">{{ $cliente->Direccion_Cliente }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="flex justify-between">
        <a href="/clientes" class="button border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
    </div>
@endsection
