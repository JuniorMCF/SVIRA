<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Alerta SVIRA</title>
</head>
<body>
    <p>Hola! tienes una nueva Teleconsulta <strong>SVIRA</strong></p>

    <p>Información de la cita:</p>
    <ul>
        <li>Médico: {{ $cita_datos->name }}</li>
        <li>Especialidad: {{ $cita_datos->especialidad }}</li>

        <li>link meet: {{  $cita_datos->link_google }}</li>
        <li>Fecha programada: <strong> {{ $cita_datos->fecha_programada }}</strong></li>
    </ul>

    <p>Fecha de registro: <strong> {{ $cita->created_at }}</strong></p>
</body>
</html>