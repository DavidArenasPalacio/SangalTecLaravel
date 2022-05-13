@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Editar Un Cliente</h1>
<form action="{{ route('clientes.actualizar',$clientes->id) }}" method="POST" id="form">
    @csrf
    <input type="hidden" name="id" value="{{$clientes->id}}">
    <div class="flex flex-col sm:flex-row items-center">

        <div class="w-full mr-2">
            <label for="Nombre_Proveedor">Editar Cliente:</label>

            <input type="text" id="Nombre_Proveedor" name="nombre" class="input w-full border mt-2 @error('nombre') border-theme-6 @enderror" placeholder="Ingrese el nombre del cliente" maxlength="125" value="{{$clientes->Nombre_Cliente}}" >
            @error('nombre')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="Correo_Proveedor">Documento Cliente:</label>

            <input type="text" id="documento" name="documento" class="input w-full border mt-2 @error('documento') border-theme-6 @enderror" placeholder="Ingrese el correo del cliente" maxlength="225" value="{{$clientes->Documento_Cliente}}">
            @error('documento')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>

    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="Telefono_Proveedor">Telefono Cliente:</label>

            <input type="text" id="Telefono_Proveedor" name="telefono" class="input w-full border mt-2 @error('telefono') border-theme-6 @enderror" placeholder="Ingrese el teléfono del cliente" value="{{$clientes->Telefono_Cliente}}">
            @error('telefono')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full ">
            <label for="Direccion_Proveedor">Dirección Cliente:</label>

            <input type="text" id="Direccion_Proveedor" name="direccion" class="input w-full border mt-2 @error('direccion') border-theme-6 @enderror" placeholder="Ingrese la dirección del cliente" value="{{$clientes->Direccion_Cliente}}">
            @error('direccion')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        
    
    </div>
    <div class="flex justify-between">
        <a href="/clientes" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 ">Editar Cliente</button>
    </div>
</form>
@endsection

@section('script')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    $('#formECL').submit(function(e){
    
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        })
    
        swalWithBootstrapButtons.fire({
            title: '¿Desea Editar El Cliente?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                'Se Editó El Cliente Correctamente',
                '',
                'success'
                )
                this.submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'El Cliente No Fue Editado',
                '',
                'error'
                )
            }
        })
    
    });
    
    </script>

@endsection