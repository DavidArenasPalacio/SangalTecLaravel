@extends('layouts.app')


@section('content')
<h1 class="text-center text-4xl font-medium">Crear Usuario</h1>
<form action="/usuario/guardar" method="POST" id="form">
    @csrf
    <div class="flex flex-col sm:flex-row items-center">

        <div class="w-full mr-2">
            <label for="nombre">Nombre:</label>

            <input type="text" id="name" name="nombre_usuario" class="input w-full border mt-2 @error('nombre_usuario') border-theme-6 @enderror" placeholder="Ingrese el nombre del usuario" maxlength="125" value="{{old('nombre_usuario')}}" >
            @error('nombre_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="">Rol: </label>
            <select name="rol_usuario" class="input w-full sm:mt-2 border mr-2 @error('rol_usuario') border-theme-6  @enderror" id="rol">
                <option>------ Seleccione -----</option>
                @foreach($roles as $value)
                <option value="{{ $value->id }}" {{old('rol_usuario') == $value->id ? 'selected' : ''}}>{{ $value->Nombre_Rol }}</option>
                @endforeach
            </select>
            @error('rol_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

    </div>

    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="documento">Documento:</label>

            <input type="text" id="documento" name="documento_usuario" class="input w-full border mt-2 @error('documento_usuario') border-theme-6 @enderror" placeholder="Ingrese el documento del usuario" value="{{old('documento_usuario')}}">
            @error('documento_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="telefono">Teléfono:</label>

            <input type="text" id="telefono" name="telefono_usuario" class="input w-full border mt-2 @error('telefono_usuario') border-theme-6 @enderror" placeholder="Ingrese el teléfono" maxlength="50" value="{{old('telefono_usuario')}}" >
            @error('telefono_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="direccion">Dirección:</label>

            <input type="text" id="direccion" name="direccion_usuario" class="input w-full border mt-2 @error('direccion_usuario') border-theme-6 @enderror" placeholder="Ingrese la dirección" value="{{old('direccion_usuario')}}">
            @error('direccion_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="w-full">
            <label for="email">Correo:</label>

            <input type="email" id="email" name="email_usuario" class="input w-full border mt-2 @error('email_usuario') border-theme-6 @enderror" placeholder="Ingrese el teléfono" maxlength="225" value="{{old('email_usuario')}}">
            @error('email_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:mt-2">
        <div class="w-full mr-2">
            <label for="password">Contraseña:</label>

            <input type="password" id="password" name="password_usuario" class="input w-full border mt-2 @error('password_usuario') border-theme-6 @enderror" placeholder="Ingrese la contraseña">
            @error('password_usuario')
            <div class="text-theme-6 mt-2"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>


    <!--  <div class="flex justify-between ">
        <a href="/usuario" class="button  border bg-theme-9 text-white mr-2 mt-5 w-full">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 w-full">Crear Usuario</button>
    </div> -->
    <div class="flex justify-between">
        <a href="/usuario" class="button  border bg-theme-9 text-white mr-2 mt-5 ">Volver</a>
        <button type="submit" class="button bg-theme-1 text-white mt-5 ">Crear Usuario</button>
    </div>
</form>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        $('#form').validate({ // initialize the plugin
            rules: {
                rol_usuario: {
                    required: true,
                    number: true
                },

            },
            messages: {
                
                rol_usuario: "Seleccione una opción",
            
            },
            errorElement: 'span'


        });
    });
</script>
@endsection




@extends('layouts.app')

@section('titulo')
    <h1 style="margin-top: 10%; text-align: center">Crear Cliente</h1>
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
<form id="formCl" action="{{ route('clientes.store') }}" method="POST"  enctype="multipart/form-data" autocomplete="on">
    @csrf
    <div class="form-group">        
        <input  class="form-control" placeholder="Ingrese el nombre del cliente" name="nombre_cliente" value="{{old('nombre_cliente')}}"/>
        {{-- @error('nombre_cliente')    
            <small>{{ $message }}</small>            
        @enderror  --}}
    </div>
    <br>
    <div class="form-group">        
        <input class="form-control" placeholder="Ingrese el numero de documento del cliente" name="documento" value="{{old('documento')}}"/>
        {{-- @error('documento')    
            <small>{{ $message }}</small>            
        @enderror  --}}
    </div>
    <br>
    <div class="form-group">        
        <input  class="form-control" placeholder="Ingrese el numero de telefono del cliente" name="telefono_cliente" value="{{old('telefono_cliente')}}"/>
        {{-- @error('telefono_cliente')    
            <small>{{ $message }}</small>            
        @enderror  --}}
    </div>
    <br>
    <div class="form-group">        
        <input  class="form-control" placeholder="Ingrese la direccion del cliente" name="direccion_cliente" value="{{old('direccion_cliente')}}"/>
        {{-- @error('direccion_cliente')    
            <small>{{ $message }}</small>            
        @enderror  --}}
    </div>
    <div class="form-group ">
        <div class="row">
            <div class="col-6">
                <button type="submit" class="btn btn-success form-control"> Crear</button>
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