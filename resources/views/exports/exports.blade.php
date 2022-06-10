<table border="1">
    <thead>
    <tr>
        <th>#compra</th>
        <th>Usuario</th>
        <th>Proveedor</th>
        <th>Precio Total Compra</th>
        <th>Productos Y Cantidad</th>  
        <th>Fecha y Hora de Compra</th>
        
    </tr>
    </thead>
    <tbody>
    @foreach($compra as $compra)
        <tr>
            <td>{{$compra->id}}</td>
            <td>{{ $compra->name }}</td>
            <td>{{ $compra->Nombre_proveedor }}</td>
            <td>{{ $compra->Precio_total }}</td>
            <td>
                <?php 
                    foreach ($productos as $key => $value) {
                        if($compra->id == $value->id){
                            echo $value->Nombre_Producto. ' '. $value->Cantidad.'<br>';
                            echo  '<br>';
                        }
                    }    
                ?>
            </td>
            <td>{{ $compra->created_at }}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>

<table border="1">
    <thead>
    <tr>
        <th>#venta</th>
        <th>Usuario</th>
        <th>Cliente</th>
        <th>Precio Total Venta</th>
        <th>Productos Y Cantidad</th>  
        <th>Fecha y Hora de Venta</th>
        
    </tr>
    </thead>
    <tbody>
    @foreach($ventas as $ventas)
        <tr>
            <td>{{$ventas->id}}</td>
            <td>{{ $ventas->name }}</td>
            <td>{{ $ventas->Nombre_Cliente }}</td>
            <td>{{ $ventas->Precio_total }}</td>
            <td>
                <?php 
                    foreach ($productos1 as $key => $value) {
                        if($ventas->id == $value->id){
                            echo $value->Nombre_Producto. ' ' .$value->Cantidad. '<br>';
                         
                        
                        }
                    }    
                ?>
            </td>
            <td>{{ $ventas->created_at }}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>