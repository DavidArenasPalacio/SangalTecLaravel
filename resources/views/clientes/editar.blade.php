@extends('layouts.app')

@section('titulo')
<h1 style="margin-top: 10%; text-align: center">Editar Cliente</h1>
@endsection   

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

<div class="row justify-content-center">
    <div class="col-md-5">
        <form id="formECL" action="{{ route('clientes.actualizar',$clientes->id) }}" method="POST"  enctype="multipart/form-data" autocomplete="on">
            @csrf
            <div class="form-group">        
                <input  class="form-control" placeholder="Ingrese el nombre del cliente" name="nombre_cliente" value="{{$clientes->Nombre_Cliente}}" />
                {{-- @error('nombre_cliente')    
                    <small>{{ $message }}</small>            
                @enderror  --}}
            </div>
            <br>
            <div class="form-group">        
                <input  class="form-control" placeholder="Ingrese el numero de documento del cliente" name="documento" value="{{$clientes->Documento_Cliente}}"/>
                {{-- @error('documento')    
                    <small>{{ $message }}</small>            
                @enderror  --}}
            </div>
            <br>
            <div class="form-group">        
                <input  class="form-control" placeholder="Ingrese el numero de telefono del cliente" name="telefono_cliente" value="{{$clientes->Telefono_Cliente}}"/>
                {{-- @error('documento')    
                    <small>{{ $message }}</small>            
                @enderror  --}}
            </div>
            <br>
            <div class="form-group">        
                <input  class="form-control" placeholder="Ingrese la direccion del cliente" name="direccion_cliente" value="{{$clientes->Direccion_Cliente}}"/>
                {{-- @error('documento')    
                    <small>{{ $message }}</small>            
                @enderror  --}}
            </div>
            <div class="form-group ">
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-success form-control"> Editar</button>
                    </div>
                    <div class="col-6">
                        <a href="/clientes" class="btn btn-primary form-control"> Volver</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
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