<table border="1">
    <thead>
    <tr>
        <th>id compra</th>
        <th>Usuario</th>
        <th>Proveedor</th>
        <th>Precio Total Compra</th>
        <th>Productos</th>  
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
                            echo $value->Nombre_Producto. '<br>';
                        }
                    }    
                ?>
            </td>
            <td>{{ $compra->created_at }}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>