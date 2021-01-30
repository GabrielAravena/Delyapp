<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertencia de inventario</title>
</head>

<body>
    <div>
        <div style="width: 100%;">
            <div style="margin-top: 30px;">
                <div style="width: 80%">
                    <div style="margin-top: 30px; display: flex; flex-flow: row wrap; align-items: center;">
                        <h1>Advertencia de inventario</h1>
                    </div>

                    <h3 style="margin-top: 30px;">Hemos detectado que algunos de tus ingredientes se están acabando.</h3>

                    <h3 style="margin-top: 30px;">Ingredientes</h3>
                    <ul>
                        @foreach($ingredientes as $ingrediente)
                        <li>Nombre: {{ $ingrediente->nombre }}, Cantidad: {{ $ingrediente->cantidad }} {{ $ingrediente->unidad_medida }}</li>
                        @endforeach
                    </ul>

                    <h4 style="margin-top: 30px; width: 70%; text-align: justify;">
                        Cuando la cantidad de un ingrediente llegue a cero, los productos que requieren ese ingrediente se desactivarán.
                        Por lo que es muy importante que registres todas las compras de ingredientes que realices y mantengas tu inventario actualizado.
                    </h4>

                    <p>Saludos, Delyapp.</p>
                    <img src="{{ asset('/images/logo_mail.jpeg') }}" width="120" height="50" alt="Delyapp">
                </div>
            </div>
        </div>
    </div>

</body>

</html>