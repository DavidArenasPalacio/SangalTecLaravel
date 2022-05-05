@extends('layouts.app')

@section('content')

<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Gestión Compra
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="/compra/create" class="button text-white bg-theme-1 shadow-md mr-2"> Crear Compra</a>
    </div>
</div>
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="tbl_compras" class="table table-report table-report--bordered display  ">

        <thead>
            <tr>
                <th class="border-b-2 whitespace-no-wrap">Usuario Que Realizo La Compra</th>
                <th class="border-b-2 whitespace-no-wrap">Nombre Del Proveedo</th>
                <th class="border-b-2 whitespace-no-wrap"> Precio Total</th>
                <th class="border-b-2 whitespace-no-wrap">Fecha De La Compra</th>
                <th class="border-b-2 whitespace-no-wrap">Anular Compra</th>
                <th class="border-b-2 whitespace-no-wrap">Detalle</th>

            </tr>
        </thead>
        <tbody>
        </tbody>
        <thead>
</div>



@endsection


@section('script')

<script>
    $('#tbl_compras').DataTable({
        processing: true,
        serverSide: true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        ajax: '/compra/listar',
        columns: [{
                data: 'users',
                name: 'users'
            },
            {
                data: 'proveedor',
                name: 'proveedor'
            },
            {
                data: 'Precio_total',
                name: 'Precio_total'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'estado',
                name: 'estado'
            },
            {
                data: 'acciones',
                name: 'acciones',
                orderable: false,
                serachable: false,
                sClass: 'text-center'
            }
        ]
    });

    $('#btnGuardar').click((e) => {
        let form = $('#form');
        e.preventDefault();
        Swal.fire({
            title: '¿Desea crear la compra?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });


    function precioProducto(){
        let precio = $("#nombreProducto option:selected").attr("precio");
        console.log(precio);
        $("#precio").val(precio);
    }


    function agregarCompra() {

        let proveedor = $("#proveedor option:selected").val();
        let proveedorNombre = $("#proveedor option:selected").text();
        let nombreProducto = $("#nombreProducto option:selected").text()
        let precio = $("#precio").val();
        let cantidad = $("#cantidad").val();

        let cont = 0;
        if (cantidad >= 0 && precio >= 0) {


           
                $("#tblCompra").append(`
                <tr id="tr-${cont}">
                <input type="hidden" name="proveedor_id" value="${proveedor}">
                <input type="hidden" name="nombreProducto[]" value="${nombreProducto}">
                <input type="hidden" name="precio[]" value="${precio}">
                <input type="hidden" name="cantidad[]" value="${cantidad}">
                
                <td >${proveedorNombre}</td>

                <td class="nombreProducto">${nombreProducto}</td>
                <td>${precio}</td>
                <td id="cantidad-${cont}">${cantidad}</td>
                <td id="subtotal-${cont}">${cantidad * precio}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="eliminarCompra(${cont}, ${parseInt(cantidad) * parseInt(precio)})">Eliminar</button>
                </td>
                </tr>
            `);
            
            /* let subtotal = parseInt($("#subtotal-"+cont).text()); */

            cont++;




            let precioTotal = $("#precioTotal").text() || "0";
           
         
            $("#precioTotal").text(parseInt(precioTotal) + parseInt(cantidad) * parseInt(precio));
            $("#precioTotalDb").val(parseInt(precioTotal) + parseInt(cantidad) * parseInt(precio));

        } else {
            swal.fire('La cantidad y el producto no deben ser menor o igaual a cero');
        }
        $('#form')[0].reset();
        console.log($(".nombreProducto").text());
    }

    function eliminarCompra(proveedor, subtotal) {
        $('#tr-' + proveedor).remove();
        let precioTotal = $("#precioTotal").text() || "0";

        $("#precioTotal").text(parseInt(precioTotal) - subtotal);
    }

   /*  function actualizarCantidad(id, cantidad) {
        let cantidadTable = $("#cantidad-" + id).text(parseInt(cantidad) + parseInt($("#cantidad-" + id).text()));
        let subtotal = $("#subtotal-"+id).text();
        $("#subtotal-"+id).text(parseInt(subtotal)*parseInt(cantidad) + parseInt($("#cantidad-" + id).text()));
        let precioTotal = $("#precioTotal").text() || "0";
        $("#precioTotal").text(parseInt(precioTotal) +  parseInt(subtotal)*parseInt(cantidad) + parseInt($("#cantidad-" + id).text()));
        console.log(cantidadTable);
      
    } */
</script>
@endsection