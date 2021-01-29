<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de local</title>
</head>

<body>
    <div>
        <div style="width: 100%;">
            <div style="margin-top: 30px;">
                <div style="width: 80%">
                    <div style="margin-top: 30px; display: flex; flex-flow: row wrap; align-items: center;">
                        <h1>Registro de local</h1>
                    </div>

                    <h3 style="margin-top: 30px;">Han solicitado un registro de local.</h3>

                    <h3 style="margin-top: 30px;">Datos</h3>
                    <ul>
                        <li>Nombre dueño: {{ $request->nombre_dueno }}</li>
                        <li>Teléfono: {{ $request->telefono }}</li>
                        <li>Correo electrónico: {{ $request->email }}</li>
                        <li>Nombre Local: {{ $request->nombre_local }}</li>
                    </ul>
                    <img src="{{ asset('/images/logo_mail.jpeg') }}" style="margin-top: 50px;" width="120" height="50" alt="Delyapp">
                </div>
            </div>
        </div>
    </div>

</body>

</html>