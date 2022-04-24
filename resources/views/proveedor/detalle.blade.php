@extends('layouts.app')

@section('titulo')
    Detalles Del Proveedor
@endsection 

@section('content')

<div class=" row card">

    <div class="card-body">

        <br>
            <table id="clientes" class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
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
    
        <a href="/proveedor" class="btn btn-primary col-12">Volver</a>
    
</div>
@endsection