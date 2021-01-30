<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio en precio sugerido</title>
</head>

<body>
    <div>
        <div style="width: 100%;">
            <div style="margin-top: 30px;">
                <div style="width: 80%">
                    <div style="margin-top: 30px; display: flex; flex-flow: row wrap; align-items: center;">
                        <h1>Cambio en precio sugerido</h1>
                    </div>

                    <h3 style="margin-top: 30px;">Con la compra de un ingrediente se ha modificado el precio sugerido de algunos productos.</h3>
                    <h4 style="margin-top: 10px; width: 70%; text-align: justify;">
                        El precio sugerido de estos productos difiere en más de un 20% del valor al que tienes publicado el producto,
                        por lo que te recomendamos subir o bajar el precio, según corresponda y si lo estimas conveniente.
                    </h4>
                    <h3 style="margin-top: 30px;">Productos</h3>
                    <ul>
                        @foreach($productos as $producto)
                        <li style="margin-top: 10px;">Nombre: {{ $producto->nombre }}
                            <ul>
                                <li>Precio actual: {{ number_format($producto->precio, 0, ",", ".") }}</li>
                                <li>Precio sugerido: {{ number_format($producto->precio_sugerido, 0, ",", ".") }}</li>
                            </ul>
                        </li>
                        @endforeach
                    </ul>

                    <h4 style="margin-top: 30px; width: 70%; text-align: justify;">
                        El cambio en el precio de tus productos es opcional, por lo que no cambiaremos el precio de forma automática.
                    </h4>
                    <h2 style="margin-top: 30px;">¡Gracias por preferirnos!</h2>
                    <p>Saludos, Delyapp.</p>
                    <img src="{{ asset('/images/logo_mail.jpeg') }}" width="120" height="50" alt="Delyapp">
                </div>
            </div>
        </div>
    </div>

</body>

</html>