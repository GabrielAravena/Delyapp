<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local creado</title>
</head>

<body>
    <div>
        <div style="width: 100%;">
            <div style="margin-top: 30px;">
                <div style="width: 80%">
                    <div style="margin-top: 30px; display: flex; flex-flow: row wrap; align-items: center;">
                        <img src="{{ asset('/images/logo_mail.jpeg') }}" width="120" height="50" alt="Delyapp">
                        <h1>¡Te tenemos una buena noticia!</h1>
                    </div>

                    <h3 style="margin-top: 30px;">Tu local ya ha sido creado en nuestra plataforma.</h3>

                    <h3 style="margin-top: 30px;">Información del Local</h3>
                    <ul>
                        <li>Nombre: {{ $local->nombre }}</li>
                        <li>Dirección: {{ $local->direccion }}</li>
                        <li>Teléfono: {{ $local->telefono }}</li>
                    </ul>

                    <h3 style="margin-top: 30px;">Datos de la cuenta</h3>
                    <ul>
                        <li>Correo electrónico: {{ $admin->email }}</li>
                        <li>Password: {{ $password }}</li>
                    </ul>

                    <h4 style="margin-top: 30px; width: 70%; text-align: justify;">
                        Ahora puedes ingresar a <a href="www.delyapp.cl" type="text">www.delyapp.cl</a> con los datos de la cuenta proporcionados. 
                        Cuando inicies sesión, podrás cambiar la contraseña en la sección "Administrador".
                        En la sección "Configuración" podrás modificar los datos de tu local, subir una foto y un logo. 
                        Antes de comenzar a vender, debes registrar los ingredientes que tienes en bodega y los gastos fijos de tu local,
                        para finalmente publicar tus productos. Esta información nos permite sugerirte un precio para tus productos, 
                        y un informe de las pérdidas de tu local. Para que tu local aparezca en nuestra página y tus clientes puedan comprar, 
                        debes activar el local presionando el botón "ACTIVAR LOCAL" en la sección "Inicio", 
                        esto solo se puede hacer una vez que hayas agregado productos a tu menú.
                    </h4>

                    <h2 style="margin-top: 30px;">¡Gracias por preferirnos!</h2>
                    <p>Saludos, Delyapp.</p>
                    
                </div>
            </div>
        </div>
    </div>

</body>

</html>