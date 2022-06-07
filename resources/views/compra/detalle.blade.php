@extends('layouts.app')


@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h1 class="text-lg font-medium mr-auto">
        Detalle de la compra
    </h1>   
</div>
<div class="box p-5 mt-10"> 
<div class="overflow-x-auto">
    <table  class="table table-report table-report--bordered display table--sm">
        <thead>
            <tr class="bg-gray-700 text-white">
                <th class="border-b-2 whitespace-no-wrap">Nombre del producto</th>  
                <th class="border-b-2 whitespace-no-wrap">Precio unitario</th>                              
                <th class="border-b-2 whitespace-no-wrap">Cantidad</th>
                <th class="border-b-2 whitespace-no-wrap">Subtotal</th>
            </tr>
        </thead>
        <tbody>
        @foreach($detal as $value)
            <tr>
                <td class="border-b ">{{$value->producto}}</td>
                <td class="border-b formatoPeso">{{$value->Precio_unitario}}</td>
                <td class="border-b ">{{$value->Cantidad}}</td>
                <td class="border-b formatoPeso">{{$value->Sub_total}}</td>        
            </tr>

        @endforeach
        </tbody>
        </table>
</div>

    <div class="flex justify-between">
        <a href="/compra" class="button border bg-gray-600 text-white mr-2 mt-5 ">Volver</a>
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


</script>