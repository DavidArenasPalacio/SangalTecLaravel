@extends('layouts.app')

@section('titulo')
    Detalles Del Cliente
@endsection 

@section('content')

<div class=" row card">

    <div class="card-body">

        <br>
            <table id="clientes" class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        
                        <th>Nombre Del Cliente</th>
                        <th>Documento</th>
                        <th>Telefono Del Cliente</th>
                        <th>Direccion Del Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    
                                       
                    <tr>
                        
                        <td>{{$cliente->Nombre_Cliente}}</td>
                       <td>{{$cliente->Documento_Cliente}}</td>
                       <td>{{$cliente->Telefono_Cliente}}</td>
                       <td>{{$cliente->Direccion_Cliente}}</td>
                   </tr> 
                          
                </tbody>                
            </table>
    </div>
    
        <a href="/clientes" class="btn btn-primary col-12">Volver</a>
    
</div>
@endsection