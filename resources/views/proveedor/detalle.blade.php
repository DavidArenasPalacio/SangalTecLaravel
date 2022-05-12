@extends('layouts.app')

@section('content')

<div>
    <table class="table table-report table-report--bordered display  ">
        <thead>
            <tr>                        
                <th class="border-b-2 whitespace-no-wrap">Nombre</th>
                <th class="border-b-2 whitespace-no-wrap">Correo</th>
                <th class="border-b-2 whitespace-no-wrap">Teléfono</th>
                <th class="border-b-2 whitespace-no-wrap">Dirección</th>
            </tr>
        </thead>
        <tbody>                     
            <tr>        
                <td>{{$proveedor->Nombre_Proveedor}}</td>
                <td>{{$proveedor->Correo_Proveedor}}</td>
                <td>{{$proveedor->Telefono_Proveedor}}</td>
                <td>{{$proveedor->Direccion_Proveedor}}</td>  
            </tr> 
                          
        </tbody>                
        </table>
</div>
    
<div class="flex justify-between">
    <a href="/proveedor" class="button border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
</div>
</div>
@endsection