@extends('layouts.app')


@section('content')

<section class="cotainer">
    <div class="p-3 m-auto bg-white">
        <h2>Productos:</h2>


        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detal as $value)
                <tr>
                    <td>{{$value->producto}}</td>
                   <td>{{$value->Cantidad}}</td>
                    <td>{{$value->Sub_total}}</td>
                    
                </tr>

                @endforeach
            </tbody>
        </table>



        <a href="/compra" class="btn btn-success">Volver</a>
    </div>
</section>

@endsection