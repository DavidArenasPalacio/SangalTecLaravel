@extends('layouts.app')


        {{-- {{auth()->user()->name}} --}}


@section('content')


@if ($errors->any())
    <div style=" margin-left: 30%; width: 40%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

{{-- @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif --}}


<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Gestión Venta
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="/ventas/crear" class="button text-white bg-theme-1 shadow-md mr-2"> Crear Venta</a>
    </div>
</div>               
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="ventas" class="table table-report table-report--bordered display  ">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">Nombre Del Cliente</th>
                    <th class="border-b-2 whitespace-no-wrap">Usuario Que Realizo La Venta</th>
                    <th class="border-b-2 whitespace-no-wrap">Precio Total</th>
                    <th class="border-b-2 whitespace-no-wrap">Fecha De La Venta</th>
                    <th class="border-b-2 whitespace-no-wrap">Anular Venta</th>
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

        $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
    </script>
    <script>
        

    //     $(document).ready(function(){
    //         $('#ventas').DataTable({
    //             processing: true,
    //             serverSide: true,
    //             ajax: "/ventas/listar",
    //         columns: [
    //             {data: 'id', name: 'id'},               
    //             {data: 'NombreCliente', name: 'NombreCliente'}, 
    //             {data: 'NombreUsuario', name: 'NombreUsuario'}, 
    //             {data: 'Precio_total', name: 'Precio_total'}, 
    //             {data: 'created_at', name: 'created_at'},                              
    //             {data: 'cambiar', name: 'cambiar', orderable: true, searchable: false},
    //             {data: 'detalle', name: 'detalle', orderable: false, searchable: false},
    //     ],
    //     "language": idioma_español
    // });
    //     });



        $('#ventas').DataTable({
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
        ajax: '/ventas/listar',
        columns: [{
                data: 'NombreUsuario',
                name: 'NombreUsuario'
            },
            {
                data: 'NombreCliente',
                name: 'NombreCliente'
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
                name: 'acciones'
            }
        ]
    });
        


</script>


{{-- Sweetalert2 --}}

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

$('#formVe').submit(function(e){

e.preventDefault();
const swalWithBootstrapButtons = Swal.mixin({
customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
},
buttonsStyling: true
})

swalWithBootstrapButtons.fire({
title: '¿Desea Registrar La Venta?',
text: "",
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'Aceptar',
cancelButtonText: 'Cancelar',
reverseButtons: false
}).then((result) => {
if (result.isConfirmed) {
    swalWithBootstrapButtons.fire(
    'Se Registró La Venta Correctamente',
    '',
    'success'
    )
    this.submit();
} else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
) {
    swalWithBootstrapButtons.fire(
    'La Venta No Fue Registrada',
    '',
    'error'
    )
}
})

});
    </script>
@endsection 