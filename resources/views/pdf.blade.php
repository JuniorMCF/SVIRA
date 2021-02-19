<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>SVIRA FICHA DE VACUNACIÓN</title>

    <style>
        .row{
            position: relative;
            align-content: center;
        }
        .form{
            position: relative;
            width: 100%;
        }
        .col-6{
            display: inline;   
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <strong>SVIRA FICHA DE VACUNACIÓN</strong>
        </div>
        <br>
        <div class="form">
            <strong class="col-6">Paciente:</strong>
            <p class="col-6">{{Auth::user()->name}}</p>
        </div>
        <div class="form">
            <strong class="col-6">Edad:</strong>
            <p class="col-6">{{$profile->age}}</p>
        </div>
        <div class="form">
            <strong class="col-6">Peso:</strong>
            <p class="col-6">{{$profile->weight}}</p>
        </div>
        <div class="form">
            <strong class="col-6">Altura:</strong>
            <p class="col-6">{{$profile->height}}</p>
        </div>
        <br>
        <div class="row">
            <strong>HISTORIAL DE VACUNAS</strong>
        </div>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Vacuna</th>
                    <th>Farmacéutica</th>
                    <th>Dosis recibidas</th>
                    <!--<th>Médico</th>-->
                    <!--<th>Especialidad</th>-->
                    <th>Fecha ultima dosis recibida</th>
                    <th>Hospital</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($vaccineprofile as $item)
                    <tr>
                        <td> {{$item->vacuna}}</td>
                        <td> {{$item->farmaceutica}}</td>
                        <td> {{$item->dosis}}</td>
                        <!--<td> {{$item->doctorname}}</td>-->
                        <td> {{$item->fec_inmun}}</td>
                        <td> {{$item->hospital}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>
        <div class="row">
            <strong>VACUNAS SVIRA</strong>
        </div>
        <br>

            <table>
                <thead>
                    <tr>
                        <th>Vacuna</th>
                        <th>Farmacéutica</th>
                        <th>Dosis recibidas</th>
                        <!--<th>Médico</th>-->
                        <!--<th>Especialidad</th>-->
                        <th>Fecha ultima dosis recibida</th>
                        <th>Hospital</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($sviravaccine as $item)
                        <tr>
                            
                            <td> {{$item->vacuna}}</td>
                            <td> {{$item->farmaceutica}}</td>
                            <td> {{$item->dosis_actual}}</td>
                            <!--<td> {{$item->doctorname}}</td>-->
                            <!--<td> {{$item->especialidad}}</td>-->
                            <td> {{$item->fecha_ultima_dosis}}</td>
                            <td> {{$item->hospital}}</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
    </div>    

</body>

