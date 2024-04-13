<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Efficient Absence Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .feature-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 4rem;
            height: 4rem;
            border-radius: 50%;
            margin: 0 auto; /* Center the icon */
        }

        h1, h3 {
            font-weight: 600; /* Make headers bold */
        }

        p {
            font-weight: 400; /* Regular font weight for paragraph */
        }

        .text-primary {
            color: #007bff; /* Bootstrap primary color, adjust as needed */
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover, .btn-outline-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: #ffffff;
        }

        .btn-outline-primary:hover {
            background-color: transparent;
            color: #0056b3;
        }

        .feature-item {
            text-align: center; /* Center align the feature items */
        }
        /* img{
            width: 50%;
            height: 50%;
        } */
    </style>
</head>
<body>
    <?php if (Session::has('id')): ?>
    @extends('layouts.Navbar')

    @section('contenu')
   
    <div class="container " >
        <div class="text-center">
            <h3 class="display-4 font-weight-bold" style="font-weight: bold">Votre plateforme pour une <br><span class="text-primary">gestion efficace des absences</span>.</h3>
            <p  style="font-weight: bold">Bienvenue dans votre Système de Gestion des Absences.</p>
        </div>
    </div>

    @php
    $endDate = now()->format('Y-m-d');
    $startDate = now()->subDays(7)->format('Y-m-d');
@endphp

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <a href="/graph?start_date={{ $startDate }}&end_date={{ $endDate }}&groupe=" class="card text-decoration-none">
                <div class="card-body text-center">
                    <h3 class="card-title">Graphique des absences de la dernière semaine</h3>
                    <img style="width: 400px;height:300px" src="/images/Line-Graph.png" alt="Graphique" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="/Imprimer?start_date={{ $startDate }}&end_date={{ $endDate }}&groupe=" class="card text-decoration-none">
                <div class="card-body text-center">
                    <h3 class="card-title">Imprimer les absences de la dernière semaine</h3><br>
                    <img style="width: 400px;height:309.9px" src="/images/imprimer.jpg" alt="Imprimer" class="img-fluid">
                </div>
            </a>
        </div>
    </div>
</div>
    @endsection

    <?php else: ?>
        <center><h1 style="color: rgb(236, 103, 103);font-size: 28px; margin-top: 300px">PAGE EXPIRED</h1></center>
    <?php endif; ?>
</body>
</html>
