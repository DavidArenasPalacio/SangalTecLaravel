{{-- para las valudaciones ejecuto este comando: php artisan make:request StorePostRequest
                                                    (nombre del metodo que guarda y de que tabla)
dentro de ese archivo escribo las validaciones que iran en el formulario
luego en el controlador en el metodo de guardar cambio el Request por el nombre que le asigne(nombre del metodo que guarda y de que tabla) 
y por ultimo importo el: use App\Http\Requests\(Nombre del metodo que guarda)--}}


<form id="formVe" action="{{ route('ventas.store') }}" method="POST">
    @csrf 

    {{-- @foreach ($ventasdetalle as $value) --}}
    <div class="row">
        <div class="col-6">
            <div class="row card">
                <div class="card-header">
                    <h4 class="text-center">Informacion Del Proveedor</h4>
                </div>
                <div class="row text-center card-body d-flex justify-content-center ">
                    <div class="form-group col-6">
                        <label for="">Nombre Del Proveedor</label>

                        <select  id="proveedor" class="js-example-basic-single form-control">
                            <option value="">Seleccionar Proveedor</option>
                            @foreach($proveedor as $value)
                        <option nombre="{{$value->Nombre_Proveedor}}" value="{{ $value->id }} " {{old('proveedor_id')==$value->id ? 'selected' : ''}}>{{ $value->Nombre_Proveedor }}</option>
                        @endforeach
                        </select>
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
                    <h4 class="text-center">Informacion De La Compra</h4>
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






<form action="/compra/guardar" method="post" id="form">
    @csrf
    <div class="row">
        <div class="col-4">
            <h2>Proveedor:</h2>
            <div class="mb-3">
                <label for="">proveedor:</label>
                {{-- <select class="form-control @error('proveedor_id') is-invalid @enderror" id="proveedor">
                    <option value="">------Seleccione-----</option>
                    @foreach($proveedor as $value)
                    <option value="{{ $value->id }}">{{ $value->Nombre_Proveedor }}</option>
                    @endforeach
                </select> --}}
                <select name="proveedor_id"  id="proveedor" class="js-example-basic-single form-control">
                    <option value="">Seleccionar Proveedor</option>
                    @foreach($proveedor as $value)
                <option nombre="{{$value->Nombre_Proveedor}}" value="{{ $value->id }} " {{old('proveedor_id')==$value->id ? 'selected' : ''}}>{{ $value->Nombre_Proveedor }}</option>
                @endforeach
                </select>
                @error('proveedor_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <h2>Producto:</h2>
            <div class="mb3">
                <label for="">Producto: </label>
                {{-- <select class="form-control @error('idProducto') is-invalid @enderror" id="nombreProducto" onchange="precioProducto()">
                    <option value="">------Seleccione-----</option>
                    @foreach($productos as $value)
                    <option value="{{ $value->id }}"  precio="{{ $value->Precio }}" >{{ $value->Nombre_Producto }}</option>
                    @endforeach
                </select> --}}
                <select name="nombreProducto" id="nombreProducto" class="form-control" onchange="precioProducto()" style=""> 
                    <option value="">Seleccionar Producto</option>
                    @foreach($productos as $value)
                <option precio="{{$value->Precio}}" value="{{ $value->id }} " {{old('nombreProducto')==$value->id  ? 'selected' : ''}}>{{ $value->Nombre_Producto }}</option>
                @endforeach
                </select>
                @error('idProducto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">

                <input type="hidden" name="total" id="precioTotalDb">

                <label for="">Precio: </label>
                <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio"  value="{{old('precio')}}" readonly>
                @error('cantidad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Cantidad: </label>
                <input type="number" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad">
                @error('cantidad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="button" class="btn btn-primary w-100" onclick="agregarCompra()" >Agregar</button>
        </div>
        <div class="col-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Proveedor</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Sub Total</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tbody id="tblCompra">

                </tbody>

            </table>
            <h2 class="text-center">Total: $<strong id="precioTotal">0</strong></h2>

            <button type="button" class="btn btn-success w-100" id="btnGuardar">Guardar</button>
        </div>
    </div>
</form>





<section class="container">
    <div class="p-5 bg-white">
        <h2 class="text-center">Editar Cliente</h2>
        <form id="formECL" action="{{ route('clientes.actualizar',$clientes->id) }}" method="POST"  enctype="multipart/form-data" autocomplete="on">
            @csrf
            <input type="hidden" name="id" value="{{$clientes->id}}">
            <div class="mb-3">
                <label for="">Nombre</label>
                <input type="text" name="nombre" placeholder="Ingrese el nombre del cliente" class="form-control @error('nombre') is-invalid @enderror" value="{{$clientes->Nombre_Cliente}}">
        @error('nombre')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class=" mb-3">
                <label for="">Documento: </label>
                <input type="text" name="documento" class="form-control @error('documento') is-invalid @enderror" value="{{$clientes->Documento_Cliente}}">
                @error('documento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Teléfono: </label>
                <input type="tel" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{$clientes->Telefono_Cliente}}">
                @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Dirección: </label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{$clientes->Direccion_Cliente}}">
                @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-2">
                    <a href="/clientes" class="btn btn-danger">Cancelar</a>
                </div>
            
            <div class="col-2">
                <button type="submit" class="btn btn-success">Editar Cliente</button>
            </div>
        </div>
        </form>
    </div>
</section>