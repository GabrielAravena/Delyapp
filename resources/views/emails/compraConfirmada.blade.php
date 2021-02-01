<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra confirmada</title>
</head>

<body>
    <div>
        <div style="width: 100%;">
            <div style="margin-top: 30px;">
                <div style="width: 80%">
                    <div style="margin-top: 30px; display: flex; flex-flow: row wrap; align-items: center;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Commons-emblem-success.svg/1024px-Commons-emblem-success.svg.png" width="80" height="80">
                        <h1>¡Compra exitosa!</h1>
                    </div>
                    <h3 style="margin-top: 30px;">Detalle de la compra</h3>
                    <table class="table table-sm" style="width: 100%; align-items: center;">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th style="margin-left: 50px;">Cantidad</th>
                                <th style="margin-left: 50px;">Precio unitario</th>
                                <th style="margin-left: 50px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos_user as $producto)
                            <tr>
                                <td>{{ $producto->nombre }}</td>
                                <td style="text-align: center;">{{ $producto->cantidad }}</td>
                                <td style="text-align: center;">{{ number_format($producto->precio, 0, ",", ".") }}</td>
                                <td style="text-align: center;">{{ number_format($producto->precio * $producto->cantidad, 0, ",", ".") }}</td>
                            </tr>
                            @endforeach
                            @if($venta->delivery)
                            <tr>
                                <td>Delivery</td>
                                <td style="text-align: center;">1</td>
                                <td style="text-align: center;">{{ number_format($local->valor_delivery, 0, ",", ".") }}</td>
                                <td style="text-align: center;">{{ number_format($local->valor_delivery, 0, ",", ".") }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div style="display: flex; flex-flow: row wrap;">
                        <h4><strong></strong>Precio total: ${{ number_format($venta->valor, 0, ",", ".") }}</h4>
                    </div>
                    <h3 style="margin-top: 30px;">Información del Local</h3>
                    <ul>
                        <li>Nombre: {{ $local->nombre }}</li>
                        <li>Dirección: {{ $local->direccion }}</li>
                        <li>Teléfono: {{ $local->telefono }}</li>
                    </ul>
                    @if($venta->delivery)
                    <h4 style="margin-top: 30px;">Te avisaremos cuando tu pedido esté listo y se encuentre en camino.</h4>
                    @else
                    <h4 style="margin-top: 30px;">Te avisaremos cuando tu pedido esté listo para ser retirado en el local.</h4>
                    @endif
                    <h2 style="margin-top: 30px;">¡Gracias por preferirnos!</h2>
                    <p>Saludos, Delyapp.</p>
                    <img src="{{ asset('/images/logo_mail.jpeg') }}" width="120" height="50" alt="Delyapp">
                </div>
            </div>
        </div>
    </div>
</body>

</html>