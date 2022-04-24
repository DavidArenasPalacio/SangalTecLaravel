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

<div class="card">

    <div class="card-header">
        {{-- <div >
        <!-- Button trigger modal -->
            <button style="position: relative; left: 87%;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                Registrar Venta
            </button>
        </div> --}}
            
        <div class="d-flex justify-content-between p-2">
            <h3>Gestión De Ventas</h3>
                <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                Registrar Venta
            </button>
        </div>
    </div>                
    <div class="card-body">
                            
        {{-- <div>
            <a href="/ventas/detalle/" class="btn btn-secondary"> Tabla Detalle</a>'
        </div> --}}
        <br>
            <table id="ventas" class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Nombre Del Cliente</th> 
                        <th>Usuario Que Realizo La Venta</th>
                        <th>Precio Total</th>                      
                        <th>Fecha De La Venta</th>
                        <th>Anular Venta</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
    </div>
</div>
{{-- modal de registrar venta --}}
<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 200% !important;">
                <div class="modal-header">
    
                    <h4 class="modal-title">Registrar Una Venta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
    
                </div>
                        
                <div class="modal-body"> 
                        <form id="formVe" action="{{ route('ventas.store') }}" method="POST">
                            @csrf 
                        
                            {{-- @foreach ($ventasdetalle as $value) --}}
                            <div class="row">
                                <div class="col-6">
                                    <div class="row card">
                                        <div class="card-header">
                                            <h4 class="text-center">Informacion Del Cliente</h4>
                                        </div>
                                        <div class="row text-center card-body d-flex justify-content-center ">
                                            <div class="form-group col-6">
                                                <label for="">Documento Del Cliente</label>
                
                                                <select name="DocumentoC"  id="DocumentoC" class="js-example-basic-single form-control" onchange="colocar_nombre()" style="display:block;width:100%;height:calc(1.5em + .75rem + 2px);padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out}@media (prefers-reduced-motion:reduce){.form-control{transition:none}">
                                                    <option value="">Seleccionar Documento</option>
                                                    @foreach($clientes as $value)
                                                <option nombre="{{$value->Nombre_Cliente}}" value="{{ $value->id }} " {{old('DocumentoC')==$value->id ? 'selected' : ''}}>{{ $value->Documento_Cliente }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Nombre Del Cliente</label>
                                                <input type="text" name="nombreC" id="nombre" value="{{old('nombreC')}}" readonly />
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Precio Total De La Venta</label>
                                                <input id="precio_venta" type="number" name="precio_venta" value="{{old('precio_venta')}}" readonly>
                                            </div>   
                                            <div style="margin-top: 4%" class="form-group col-6">
                                                <button type="submit" class="btn btn-success">Registrar Venta</button>
                                                
                                                <a href="/ventas" class="btn btn-danger float-right"  >Volver</a>
                                                
                                            </div>                                           
                                        </div>                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="text-center">Informacion De La Venta</h4>
                                        </div>
                                        <div class="row text-center card-body d-flex justify-content-center">
                                            <div class="form-group col-6">
                                                <label for="">Nombre Del Producto</label>
                                                {{-- <input style="width: 80%" type="text" name="" value="{{$value->NombreP}}" disabled> --}}
                                                <select name="ProductoN" id="ProductoN" class="form-control" onchange="colocar_precio()" style=""> 
                                                    <option value="">Seleccionar Producto</option>
                                                    @foreach($productos as $value)
                                                <option precio="{{$value->Precio}}" value="{{ $value->id }} " {{old('ProductoN')==$value->id  ? 'selected' : ''}}>{{ $value->Nombre_Producto }}</option>
                                                @endforeach
                                                </select>
                                                @error('ProductoN')
                                                <small>
                                                    <strong>{{$message}}</strong>
                                                </small>
                                                @enderror
                                                
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="">Cantidad</label>
                                                <input id="cantidad" style="width: 80%" type="number" name="cantidad" value="{{old('cantidad')}}" />
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="">Precio</label>
                                                <input id="precio" style="width: 80%" type="text" name="precio" value="{{old('precio')}}" readonly>
                                            </div>
                                            <div class="col-12">
                                                <button type="button" class="btn btn-success float-right" onclick="agregar_producto()" >Agregar Producto</button>
                                            </div>
                                        </div>    
                                            <table id="table" class="table table-bordered" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>                      
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                        <th>Sub Total</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_productos">
                                                    
                                                </tbody>
                                            </table>    
                                    </div>
                                </div>
                            </div>
                    
                            {{-- @endforeach --}}
                        </form>
                </div>
            </div>
        </div>
    </div>
{{-- fin modal registrar venta     --}}
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
                data: 'cambiar',
                name: 'cambiar'
            },
            {
                data: 'detalle',
                name: 'detalle'
            }
        ]
    });
        

        function colocar_precio(e){

let precio = $("#ProductoN option:selected").attr("precio");           
$("#precio").val(precio);
}

function colocar_nombre(e){

let nombre = $("#DocumentoC option:selected").attr("nombre");           
$("#nombre").val(nombre);
}

// let cont = 1; 
let id = 0;
let can = 0;

function agregar_producto(){

let producto_id = $("#ProductoN option:selected").val();
let producto_text = $("#ProductoN option:selected").text();
let cantidad =  $("#cantidad").val();
let precio = $("#precio").val();

// console.log(producto_id);
// console.log(producto_text);
// console.log(cantidad);
// console.log(precio);

if (cantidad > 0 && precio >0) {

if (producto_id == id) {


    $(".trp-"+producto_id).remove();
        // $("#precio_venta").val(parseInt(precio_venta)-precio);
        $("#cantidad").val(1);

    can = parseInt(can)+parseInt(cantidad);
        
        console.log("cas",id,cantidad);
         $('#tbl_productos').append(`
        <tr class="trp-${producto_id}">
            <td>
                <input type="hidden" name="ProductoN[]" value="${producto_id}" />
                <input type="hidden" name="cantidades[]" value="${can}" />
                <input type="hidden" name="precios[]" value="${precio}" /> 
            
                ${producto_text}
            </td>
            <td  id="td-${producto_id}" value="">${parseInt(can)}</td>
            <td>${precio}</td>
            <td>${parseInt(can) * parseInt(precio)}</td>
            <td>
                <button type="button" class="btn btn-danger" onclick="cancelar_producto(${producto_id}, ${parseInt(can) * parseInt(precio)})">Eliminar</button>    
            </td>
        </tr>
    
        `);

// console.log($("#nombreProducto-"+cont).text().trim())
let precio_venta = $("#precio_venta").val() || 0;
$("#precio_venta").val(parseInt(precio_venta) + parseInt(cantidad) * parseInt(precio));
// cont++;

}

else{
        
    $("#tbl_productos").append(` 

<tr class="trp-${producto_id}">      
    <input type="hidden" name="ProductoN[]" value="${producto_id}" />
        <input type="hidden" name="cantidades[]" value="${cantidad}" />
        <input type="hidden" name="precios[]" value="${precio}" />                  
    <td>
        ${producto_text}
    </td>
    <td>${cantidad}</td>
    <td>${precio}</td>
    <td>${parseInt(cantidad) * parseInt(precio)}</td>
    <td>
        <button type="button" class="btn btn-danger" onclick="cancelar_producto(${producto_id}, ${parseInt(cantidad) * parseInt(precio)})">Eliminar</button>    
    </td>
</tr>
` );
        id = producto_id;
        can = cantidad;
        
        let precio_venta = $("#precio_venta").val() || 0;
$("#precio_venta").val(parseInt(precio_venta) + parseInt(cantidad) * parseInt(precio));
        
}
   


}else
alert("Ingrese la cantidad");


}

function cancelar_producto(id, subtotal){
    $(".trp-"+id).remove();
    // $("#tr-" + producto_id).remove();

    let precio_venta = $("#precio_venta").val();
    $("#precio_venta").val(parseInt(precio_venta) - subtotal);

    can = 0;
    console.log(id);
    
}




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