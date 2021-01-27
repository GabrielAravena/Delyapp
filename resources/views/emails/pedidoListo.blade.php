<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Listo</title>
</head>

<body>
    <div>
        <div style="width: 100%;">
            <div style="margin-top: 30px;">
                <div style="width: 80%">
                    <div style="margin-top: 30px; display: flex; flex-flow: row wrap; align-items: center;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Commons-emblem-success.svg/1024px-Commons-emblem-success.svg.png" alt="Producto" width="80" height="80">
                        <h1>¡Tu pedido ya está listo!</h1>
                    </div>
                    @if($registro_venta->delivery)
                    <h3 style="margin-top: 30px;">Tu pedido ya está listo y se encuentra en camino.</h3>
                    <h4 style="margin-top: 10px;">LLegará en aproximadamente <strong>{{ $duracion }}</strong> minutos.</h4>
                    <h3 style="margin-top: 30px;">Información de envío</h3>
                    <ul>
                        @if($usuario->name)
                        <li>Nombre cliente: {{ $usuario->name }}</li>
                        @else
                        <li>Nombre cliente: {{ $usuario->nombre }}</li>
                        @endif
                        <li>Dirección: {{ $usuario->direccion }}</li>
                        <li>Teléfono: {{ $usuario->telefono }}</li>
                    </ul>
                    <h3 style="margin-top: 30px;">Información del Local</h3>
                    <ul>
                        <li>Nombre: {{ $local->nombre }}</li>
                        <li>Dirección: {{ $local->direccion }}</li>
                        <li>Teléfono: {{ $local->telefono }}</li>
                    </ul>
                    @else
                    <h3 style="margin-top: 30px;">Tu pedido ya está listo para ser retirado en el local.</h3>
                    <h3 style="margin-top: 30px;">Información del Local</h3>
                    <ul>
                        <li>Nombre: {{ $local->nombre }}</li>
                        <li>Dirección: {{ $local->direccion }}</li>
                        <li>Teléfono: {{ $local->telefono }}</li>
                    </ul>
                    @endif
                    <h2 style="margin-top: 30px;">¡Gracias por preferirnos!</h2>
                    <p>Saludos, Delyapp.</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>