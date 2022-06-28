@extends('layouts.app')

@section('titulo')
    Productos Vendidos
@endsection

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h1 class="text-lg font-medium mr-auto">
        Detalle de la venta
    </h1>
</div>
<div class="box p-5 mt-10">
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
                    <td class="border-b formatoPeso">{{$value->Precio_unitario}}</td>
                    <td class="border-b ">{{$value->Cantidad}}</td>
                    <td class="border-b formatoPeso">{{$value->SubTotal}}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="border-b"><b>Precio total de la venta:</b> </td>

                @foreach($venta as $value)
                    <td class="border-b formatoPeso">{{$value->precio}}</td>
                
                @endforeach
                <td class="border-b"></td>
                <td class="border-b"></td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="flex justify-between">
        <a href="/ventas" class="button border bg-gray-600 text-white mr-2 mt-5 tooltip" title="Presione el boton izquierdo del mouse aqui para volver a la lista de las ventas">Volver</a>
    </div>
</div>
@endsection

@section("script")
<script>
let formatoPeso = document.querySelectorAll(".formatoPeso");
const formatterPeso = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 0
})


formatoPeso.forEach(e => {
    e.textContent = formatterPeso.format(e.textContent)
})


</script>
@endsection
