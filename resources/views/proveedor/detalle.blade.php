@extends('layouts.app')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h1 class="text-lg font-medium mr-auto">
            Detalle del proveedor
        </h1>
    </div>
    <div class="box  p-5 mt-10">
        <div class="overflow-x-auto">
            <table class="table table-report table-report--bordered display table--sm">
                <thead>
                    <tr class="bg-gray-700 text-white">
                        <th class="border-b-2 whitespace-no-wrap">Nombre</th>
                        <th class="border-b-2 whitespace-no-wrap">Correo</th>
                        <th class="border-b-2 whitespace-no-wrap">Teléfono</th>
                        <th class="border-b-2 whitespace-no-wrap">Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-b ">{{ $proveedor->Nombre_Proveedor }}</td>
                        <td class="border-b ">{{ $proveedor->Correo_Proveedor }}</td>
                        <td class="border-b ">{{ $proveedor->Telefono_Proveedor }}</td>
                        <td class="border-b ">{{ $proveedor->Direccion_Proveedor }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="flex justify-between">
            <a href="/proveedor" class="button  border bg-gray-600 text-white mr-2 mt-5 tooltip"
                title="Click aqui para volver a la lista de los proveedores">Volver</a>
        </div>
    </div>
@endsection
