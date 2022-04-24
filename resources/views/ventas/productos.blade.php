@extends('layouts.app')

@section('titulo')
    Productos Vendidos
@endsection 

@section('content')

<div class=" row card">

    <div class="card-body">

        <br>
            <table id="productos" class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <!-- <th>Id</th>  --> 
                        <th>Id Venta</th>
                        <th>Nombre Del Producto</th>                                       
                        <th>Cantidad</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($ventasdetalle as $value)                   
                    <tr>
                        <!-- <td>{{$value->id}}</td> -->
                        <td>{{$value->Ventas}}</td>
                        <td>{{$value->Productos}}</td>
                        <td>{{$value->Cantidad}}</td>
                        <td>{{$value->SubTotal}}</td>
                    </tr> 
                    @endforeach      
                </tbody>                
            </table>
    </div>
    
        <a href="/ventas" class="btn btn-primary col-12">Volver</a>
    
</div>
@endsection
