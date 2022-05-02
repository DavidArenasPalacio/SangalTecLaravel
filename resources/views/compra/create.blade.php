@extends('layouts.app')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Gestión Compras
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="/compra/crear" class="button text-white bg-theme-1 shadow-md mr-2"> Crear Compra</a>
    </div>

</div>
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="tbl_usuarios" class="table table-report table-report--bordered display  ">
        <table id="tbl_productos" class="table table-report table-report--bordered display">
            <thead>
                <tr>
                   
                    <th class="border-b-2 whitespace-no-wrap">Usuario Que Realizo La Compra</th>
                    <th class="border-b-2 whitespace-no-wrap">Nombre Del Proveedor</th> 
                    <th class="border-b-2 whitespace-no-wrap">Precio Total</th>                      
                    <th class="border-b-2 whitespace-no-wrap">Fecha De La Compra</th>
                    <th class="border-b-2 whitespace-no-wrap">Anular Compra</th>
                    <th class="border-b-2 whitespace-no-wrap">Detalle</th>>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
</div>
@endsection