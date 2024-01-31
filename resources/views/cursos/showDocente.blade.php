<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Detalles del Curso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            width: 80%;
            margin: 3rem auto;
            background-color: #fff;
            padding: 3.5rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #446688;
        }

        p {
            margin: 0.5rem 0;
        }

        strong {
            color: #446688;
        }

        .buttons-container {
            margin-top: 1.5rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .button {
            margin-right: 1rem;
            padding: 0.5rem 1rem;
            border: 2px solid #4CAF50;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            background-color: #4CAF50;
            align-items: center;
            justify-content: center;        }

        .button[disabled] {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .sidebar {
            background-color: #f4f4f4;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            width: 20%;
        }

        .progress-container {
            margin-top: 1.5rem;
        }

        .progress-bar {
            height: 20px;
            background-color: #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-value {
            height: 100%;
            width: 60%; /* Aquí irá el porcentaje dinámico */
            background-color: #446688;
            color: #fff;
            text-align: center;
            line-height: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <h1>Detalles del Curso</h1>

            <p><strong>Código del Curso:</strong> {{ $curso->CodigoCurso }}</p>
            <p><strong>Nombre del Curso:</strong> {{ $curso->NombreCurso }}</p>
            <p><strong>Créditos:</strong> {{ $curso->Creditos }}</p>
            <p><strong>Tipo:</strong> {{$curso->TipoClase}}</p>
            <!-- Agrega más detalles según tus necesidades -->
      
        </div>

        <div class="sidebar">
            <h2>Estadísticas</h2>
        
            @if ($presentacionPortafolio && $contenido && $evaluaciones)
                @php
                    $totalAspectos = count(['Caratula', 'CargaAcademica', 'FilosofiaDocente', 'CV', 'Silabo', 'Avance', 'Asistencia', 'EvaluacionEntrada', 'PrimeraParcial', 'SegundaParcial', 'TerceraParcial', 'Sustitutorio']);
                    $conteoCeros = 0;
                    $conteoUnos = 0;
                    $conteoDoses = 0;

                    foreach(['Caratula', 'CargaAcademica', 'FilosofiaDocente', 'CV', 'Silabo', 'Avance', 'Asistencia', 'EvaluacionEntrada', 'PrimeraParcial', 'SegundaParcial', 'TerceraParcial', 'Sustitutorio'] as $aspecto) {
                        switch ($aspecto) {
                            case 'Caratula':
                            case 'CargaAcademica':
                            case 'FilosofiaDocente':
                            case 'CV':
                                $valor = $presentacionPortafolio->$aspecto;
                                break;
                            case 'Silabo':
                            case 'Avance':
                            case 'Asistencia':
                                $valor = $contenido->$aspecto;
                                break;
                            case 'EvaluacionEntrada':
                            case 'PrimeraParcial':
                            case 'SegundaParcial':
                            case 'TerceraParcial':
                            case 'Sustitutorio':
                                $valor = $evaluaciones->$aspecto;
                                break;
                        }

                        switch ($valor) {
                            case '0':
                                $conteoCeros++;
                                break;
                            case '1':
                                $conteoUnos++;
                                break;
                            case '2':
                                $conteoDoses++;
                                break;
                        }
                    }

                    // Calcula porcentajes
                    $porcentajeCeros = round(($conteoCeros / $totalAspectos) * 100);
                    $porcentajeUnos = round(($conteoUnos / $totalAspectos) * 100);
                    $porcentajeDoses = round(($conteoDoses / $totalAspectos) * 100);
                @endphp
               

                <p>No:</p>
                <div class="progress-bar" style="width: {{ $porcentajeCeros }}%; background-color: red;">
                    <span class="progress-label">{{ $porcentajeCeros }}%</span>
                </div>

                <p>Parcialmente:</p>
                <div class="progress-bar" style="width: {{ $porcentajeUnos }}%; background-color: yellow;">
                    <span class="progress-label">{{ $porcentajeUnos }}%</span>
                </div>

                <p>Totalmente:</p>
                <div class="progress-bar" style="width: {{ $porcentajeDoses }}%; background-color: green;">
                    <span class="progress-label">{{ $porcentajeDoses }}%</span>
                </div>
            @else
                <p>No hay datos suficientes para calcular estadísticas.</p>
            @endif
      
        </div>
    </div>
      
   
        <div class="buttons-container">
            <a href="#" class="button" >Presentación de Portafolio</a>
            <a href="#" class="button" >Contenido</a>
            <a href="#" class="button" >Evaluaciones</a>
        </div>
    

</body>
</html>
