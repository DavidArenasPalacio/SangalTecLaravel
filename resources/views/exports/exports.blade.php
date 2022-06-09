<table>
    <thead>
    <tr>
        <th>Cliente</th>
        <th>Usuario</th>
        <th>Precio Total Venta</th>
        <th>Fecha y Hora de Venta</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ventas as $venta)
        <tr>
            <td>{{ $venta->cliente_id }}</td>
            <td>{{ $venta->usuario_id }}</td>
            <td>{{ $venta->Precio_total }}</td>
            <td>{{ $venta->created_at }}</td>

        </tr>
    @endforeach
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th>Usuario</th>
        <th>Proveedor</th>
        <th>Precio Total Compra</th>
        <th>Fecha y Hora de Compra</th>
        
    </tr>
    </thead>
    <tbody>
    @foreach($compra as $compra)
        <tr>
            <td>{{ $compra->usuario_id }}</td>
            <td>{{ $compra->proveedor_id }}</td>
            <td>{{ $compra->Precio_total }}</td>
            <td>{{ $compra->created_at }}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>