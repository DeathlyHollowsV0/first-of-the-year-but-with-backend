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
    </style>
</head>
<body>
    @extends('layouts.Navbar')

    @section('contenu')
    <div class="container py-5">
        <div class="text-center">
            <h1 class="display-4 font-weight-bold">Your Platform for <br><span class="text-primary">Efficient Absence Management</span>.</h1>
            <p class="mt-3">Welcome to our Absence Management System.<br> Every request is processed efficiently to ensure the highest satisfaction.</p>
            <div class="mt-4">
                <a href="/submit-absence" class="btn btn-primary">Report Absence</a>
                <a href="/about" class="btn btn-outline-primary">Learn More</a>
            </div>
        </div>
    </div>
    
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4">
                <div class="col">
                    <div class="feature-item h-100 p-5">
                        <div class="feature-icon bg-primary bg-gradient mb-3">
                            <i class="bi bi-arrow-down-circle-fill text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h3>Instant Processing</h3>
                        <p>Submit your absence reports and get them processed in no time.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="feature-item h-100 p-5">
                        <div class="feature-icon bg-primary bg-gradient mb-3">
                            <i class="bi bi-check-circle-fill text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h3>Guaranteed Accuracy</h3>
                        <p>All absence records are thoroughly verified to ensure accuracy. Not satisfied? We offer a rectification service.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
</body>
</html>
